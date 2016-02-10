<?php

namespace App\Http\Controllers;

use App\Jobs\BlogIndexData;
use App\Http\Requests;
use App\Post;
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

  public function showPost($slug, Request $request)
  {
    $post = Post::with('tags')->whereSlug($slug)->firstOrFail();
    $tag = $request->get('tag');
    if ($tag) {
      $tag = Tag::whereTag($tag)->firstOrFail();
    }

    return view('blog.show', compact('post', 'tag'));
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
