<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Seed the posts table
     */
    public function run()
    {
        // Pull all the tag names from the file
        $tags = Tag::all();

        //Post::truncate();

        // Don't forget to truncate the pivot table
        //DB::table('post_tag_pivot')->truncate();

        factory(Post::class, 2000)->create()->each(function ($post) use ($tags) {

            // 10% of the time don't assign a tag
            if (mt_rand(1, 100) <= 10) {
                return;
            }

            shuffle($tags);
            $postTags = [$tags[0]];

            // 90% of the time we're assigning tags, assign 2
            if (mt_rand(1, 100) <= 90) {
                $postTags[] = $tags[1];
            }

            $post->syncTags($postTags);
        });
    }
}
