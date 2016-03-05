<?php

namespace App\Http\Controllers;

use App\Jobs\BlogIndexData;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\CatPost;
use App\Services\RssFeed;
use App\Services\SiteMap;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
  /**
   * @var PostRepository
   */
  private $post;

  public function index(Request $request)
  {
    $tag = $request->get('tag');

    $posts = Post::where('is_draft', '0')->orderBy('created_at', 'desc')->paginate(25);
    /*
    $data = $this->dispatch(new BlogIndexData($tag));
    $layout = $tag ? Tag::layout($tag) : 'blog.layouts.index';
    */

    //return view('blog.layouts.index', compact($posts));
    return view('blog.index')->withPosts($posts);
  }


  public function categoryList(Post $post, Category $category, CatPost $relation)
  {
    //orderBy('name', 'asc')
    $categories = Category::roots()->get();
    return view('blog.categoryList', compact('categories'));

  }


  /**
   * Get excerpt from string
   *
   * @param String  $str       String to get an excerpt from
   * @param Integer $startPos  Position int string to start excerpt from
   * @param Integer $maxLength Maximum length the excerpt may be
   * @return String excerpt
   */
  static function getExcerpt($str, $startPos = 0, $maxLength = 50)
  {
    if (strlen($str) > $maxLength) {
      $excerpt = substr($str, $startPos, $maxLength - 3);
      $lastSpace = strrpos($excerpt, ' ');
      $excerpt = substr($excerpt, 0, $lastSpace);
      $excerpt .= '...';
    } else {
      $excerpt = $str;
    }

    return $excerpt;
  }


  public function showPost($slug, Request $request)
  {
    $post = Post::with('tags')->whereSlug($slug)->firstOrFail();


    $tag = $request->get('tag');
    if ($tag) {
      $tag = Tag::whereTag($tag)->firstOrFail();
    }

    return view('blog.show', compact('post', 'tag'));
  }


  public function showByTag($tag, Request $request)
  {
    $tag = $request->get('tag');
    print_r($tag);
    exit;

    $posts = Post::whereHas('tags', function ($q) use ($tag) {
      $q->where('tag', '=', $tag->tag);
    })
      ->orderBy('published_at', 'asc');
    $posts->addQuery('tag', $tag->tag);

    print_r($posts);
    exit;

    return view('blog.index', compact('posts', 'tag'));
  }


  public function rss(RssFeed $feed)
  {
    $rss = $feed->getRSS();

    return response($rss)
      ->header('Content-type', 'application/rss+xml');
  }

  public function siteMap(SiteMap $siteMap)
  {
    $map = $siteMap->getSiteMap();

    return response($map)
      ->header('Content-type', 'text/xml');
  }
}
