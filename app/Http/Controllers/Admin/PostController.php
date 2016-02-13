<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\PostFormFields;
use App\Http\Requests;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use League\CommonMark\Converter;
use League\HTMLToMarkdown\HtmlConverter;

use App\Post;

class PostController extends Controller
{
  /**
   * Display a listing of the posts.
   */
  public function index()
  {
    return view('admin.post.index')
      ->withPosts(Post::all());
  }

  /**
   * Show the new post form
   */
  public function create()
  {
    $data = $this->dispatch(new PostFormFields());

    return view('admin.post.create', $data);
  }

  /**
   * Store a newly created Post
   *
   * @param PostCreateRequest $request
   */
  public function store(StorePostRequest $request)
  {
    //$post = Post::create($request->postFillData());
    /*
        $sl = $request->input('slug');
        $slug = str_slug($sl, "-");
        $category->slug = $slug;
        // send success message to index page
        try{
          $category->fill($request->except('slug'))->save();
     **/
    $post = Post::create($request->postFillData()->except('slug'));
    Post::syncTags($request->get('tags', []));

    return redirect()
      ->route('admin.post.index')
      ->withSuccess('New Post Successfully Created.');
  }

  /**
   * Show the post edit form
   *
   * @param  int $id
   * @return Response
   */
  public function edit($id, Converter $converter)
  {
    $data = $this->dispatch(new PostFormFields($id, $converter));

    return view('admin.post.edit', $data);
  }

  /**
   * Update the Post
   *
   * @param UpdatePostRequest $request
   * @param int               $id
   */
  public function update(UpdatePostRequest $request, $id)
  {
    $post = Post::findOrFail($id);
    /*
        $sl = $request->input('slug');
        $slug = str_slug($sl, "-");
        $category->slug = $slug;
        // send success message to index page
        try{
          $category->fill($request->except('slug'))->save();
     **/
    $post->fill($request->postFillData());
    $post->save();
    $post->syncTags($request->get('tags', []));

    return redirect()->route('admin.post.index')->withSuccess('Post saved.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return Response
   */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->tags()->detach();
    $post->delete();

    return redirect()->route('admin.post.index')->withSuccess('Post deleted.');
  }
}