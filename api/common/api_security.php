<?php

function apiRespond($payload, $statusCode = 200)
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store, max-age=0');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($payload, JSON_UNESCAPED_SLASHES);
    exit;
}

function apiClientIp()
{
    return isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
}

function apiEnforceRateLimit($key, $limit = 8, $windowSeconds = 60)
{
    $now = time();
    $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'bm_rate_' . hash('sha256', $key . '|' . apiClientIp()) . '.json';
    $attempts = [];

    $handle = @fopen($file, 'c+');
    if ($handle === false) {
        return;
    }

    if (flock($handle, LOCK_EX)) {
        $contents = stream_get_contents($handle);
        $decoded = json_decode($contents ?: '[]', true);
        if (is_array($decoded)) {
            $attempts = array_values(array_filter($decoded, function ($timestamp) use ($now, $windowSeconds) {
                return is_int($timestamp) && $timestamp > ($now - $windowSeconds);
            }));
        }

        if (count($attempts) >= $limit) {
            flock($handle, LOCK_UN);
            fclose($handle);
            header('Retry-After: ' . $windowSeconds);
            apiRespond(['status' => 'error', 'success' => false, 'message' => 'Too many requests. Please try again shortly.'], 429);
        }

        $attempts[] = $now;
        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, json_encode($attempts));
        fflush($handle);
        flock($handle, LOCK_UN);
    }

    fclose($handle);
}

function apiBootstrap($rateKey, $limit = 8, $windowSeconds = 60)
{
    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        apiRespond(['status' => 'error', 'success' => false, 'message' => 'Method not allowed.'], 405);
    }

    $contentLength = isset($_SERVER['CONTENT_LENGTH']) ? (int) $_SERVER['CONTENT_LENGTH'] : 0;
    if ($contentLength > 65536) {
        apiRespond(['status' => 'error', 'success' => false, 'message' => 'Request is too large.'], 413);
    }

    apiEnforceRateLimit($rateKey, $limit, $windowSeconds);
}

function apiText($value, $maxLength)
{
    $value = trim((string) $value);
    return function_exists('mb_substr') ? mb_substr($value, 0, $maxLength) : substr($value, 0, $maxLength);
}

function apiValidDate($value, $allowPast = false)
{
    $date = DateTime::createFromFormat('Y-m-d', (string) $value);
    $valid = $date && $date->format('Y-m-d') === $value;
    if (!$valid) {
        return false;
    }

    return $allowPast || $date >= new DateTime('today');
}
