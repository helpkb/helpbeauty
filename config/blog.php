<?php
return [
    'name' => "L5 Beauty",
    'title' => "Laravel 5.1 Beauty",
    'subtitle' => 'A clean blog written in Laravel 5.1',
    'description' => 'This is my meta description',
    'author' => '',
    'page_image' => 'home-bg.jpg',
    'posts_per_page' => 25,
    'rss_size' => 25,
    'contact_email' => env('MAIL_FROM'),
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/uploads/',
    ],
];

