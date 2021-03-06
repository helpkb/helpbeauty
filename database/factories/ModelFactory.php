<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $images = ['about-bg.jpg', 'contact-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'title' => $title,
        'slug' => $title,
        'content_raw' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'content_html' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'page_image' => $images[mt_rand(0, 3)],
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        'is_draft' => false,
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $images = ['about-bg.jpg', 'contact-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $word = str_random(5);
    return [
        'tag' => $word,
        'title' => ucfirst($word),
    ];
});
