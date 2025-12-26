<?php
require 'template_header.php';
$mediaRes = getEventReviewMedias();
?>
<title>Client Reviews & Media</title>

<style>
    .review-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .review-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.12);
    }

    .review-header {
        background: linear-gradient(135deg, #f99583, #f76b6b);
        color: #fff;
        padding: 16px 20px;
    }

    .review-date {
        font-size: 0.85rem;
        opacity: 0.9;
    }

    .section-title {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 8px;
        color: #444;
    }

    .media-thumb {
        border-radius: 12px;
        height: 120px;
        object-fit: cover;
        width: 100%;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .media-thumb:hover {
        transform: scale(1.05);
    }

    .video-frame {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        border: none;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .star {
        color: #ffc107;
        font-size: 0.9rem;
    }

    .review-text {
        background: #fff7f5;
        border-left: 4px solid #f99583;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }
</style>
</head>

<body>

    <?= require 'navbar.php'; ?>
    <?php require 'quick_connect.php'; ?>

    <div class="container">

        <div class="row mb-4 text-center">
            <h3 class="fw-bold text-white">Client Testimonial's & Media</h3>
            <p class="text-white">Photos, videos & feedback from our clients</p>
        </div>

        <div class="row g-4">

            <?php if (!empty($mediaRes)) : ?>
                <?php foreach ($mediaRes as $event) : ?>

                    <?php
                    $images = $event['images'] ?? [];
                    $videos = $event['videos'] ?? [];

                    if (is_string($images)) {
                        $images = json_decode($images, true);
                    }

                    if (is_string($videos)) {
                        $videos = json_decode($videos, true);
                    }

                    /* Remove null entries coming from CASE WHEN */
                    $images = array_values(array_filter((array)$images));
                    $videos = array_values(array_filter((array)$videos));
                    ?>

                    <div class="col-lg-6">
                        <div class="card review-card h-100">

                            <!-- Header -->
                            <div class="review-header">
                                <h5 class="mb-1"><?= htmlspecialchars($event['_client_name']) ?></h5>
                                <div class="review-date">
                                    Event Date: <?= date('d M Y', strtotime($event['_event_date'])) ?>
                                </div>
                            </div>

                            <div class="card-body">

                                <!-- Ratings -->
                                <?php if (!empty($event['_review_text'])) : ?>
                                    <div class="mb-3">
                                        <div class="mb-1">
                                            ⭐ Food:
                                            <?= str_repeat('<span class="star">★</span>', (int)$event['_food_rating']) ?>
                                        </div>
                                        <div class="mb-1">
                                            ⭐ Arrangement:
                                            <?= str_repeat('<span class="star">★</span>', (int)$event['_arrangement_rating']) ?>
                                        </div>
                                        <div>
                                            ⭐ Behavior:
                                            <?= str_repeat('<span class="star">★</span>', (int)$event['_behavior_rating']) ?>
                                        </div>
                                    </div>

                                    <div class="review-text mb-4">
                                        <?= nl2br(htmlspecialchars($event['_review_text'])) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Images -->
                                <?php if (!empty($images)) : ?>
                                    <div class="mb-4">
                                        <div class="section-title">📸 Event Photos</div>
                                        <div class="row g-2">
                                            <?php foreach ($images as $img) : ?>
                                                <div class="col-4">
                                                    <img src="<?= htmlspecialchars($img['url']) ?>" class="media-thumb">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Videos -->
                                <?php if (!empty($videos)) : ?>
                                    <div>
                                        <div class="section-title">🎥 Event Videos</div>
                                        <div class="row g-3">
                                            <?php foreach ($videos as $video) : ?>
                                                <div class="col-md-6">
                                                    <iframe
                                                        class="video-frame"
                                                        src="<?= htmlspecialchars($video['url']) ?>?autoplay=1&mute=1"
                                                        allow="autoplay; encrypted-media"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (empty($images) && empty($videos)) : ?>
                                    <p class="text-muted">No media available.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <div class="col">
                    <div class="alert alert-warning text-center">
                        No client review media found.
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/common.js"></script>
</body>

</html>