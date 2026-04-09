<?php

$routes = [
    "home"             => "index.php",       
    "mehendi"          => "mehendi_artists.php",
    "makeup"           => "makeup_artists.php",
    "mehendi_profile"  => "mehendi_profile.php",
    "makeup_profile"   => "makeup_profile.php",
    "banquet_list"     => "banquets_list.php",
    "banquet_details"  => "banquet_details.php",
    "testimonials"     => "client_testimonials.php",
    "menu_list"        => "menu_list.php",
];

$priceRanges = [
    [
        "label" => "₹2000 - ₹5000",
        "min" => 2000,
        "max" => 5000
    ],
    [
        "label" => "₹5000 - ₹10000",
        "min" => 5000,
        "max" => 10000
    ],
    [
        "label" => "₹10000 - ₹20000",
        "min" => 10000,
        "max" => 20000
    ],
    [
        "label" => "₹20000+",
        "min" => 20000,
        "max" => null
    ]
];