<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\PageFormFields;
use App\Http\Requests;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Controllers\Controller;
use App\Page;
use App\Category;
use App\Tag;

class PageController extends Controller
{
  /**
   * Display a listing of the posts.
   */
  public function index()
  {
    return view('admin.page.index')->withPages(Page::all());
  }

  /**
   * Show the new post form
   */
  public function create()
  {
    $data = $this->dispatch(new PageFormFields());

    return view('admin.page.create', $data);
  }

  /**
   * Store a newly created Page
   *
   * @param PageCreateRequest $request
   */
  public function store(StorePageRequest $request)
  {
    /*
        $sl = $request->input('slug');
        $slug = str_slug($sl, "-");
        $category->slug = $slug;
        // send success message to index page
        try{
          $category->fill($request->except('slug'))->save();
     **/
    $page = Page::create($request->pageFillData()->except('slug'));
    $page->slug = $request->slug;
    dd($request->slug);
    $page->syncTags($request->get('tags', []));

    return redirect()->route('admin.page.index')->withSuccess('New Page Successfully Created.');
  }

  /**
   * Show the post edit form
   *
   * @param  int $id
   * @return Response
   */
  public function edit($id)
  {
    $data = $this->dispatch(new PageFormFields($id));
    return view('admin.page.edit', $data);
  }

  /**
   * Update the Page
   *
   * @param PageUpdateRequest $request
   * @param int               $id
   */
  public function update(PageUpdateRequest $request, $id)
  {
    /*
        $sl = $request->input('slug');
        $slug = str_slug($sl, "-");
        $category->slug = $slug;
        // send success message to index page
        try{
          $category->fill($request->except('slug'))->save();
     **/
    $page = Page::findOrFail($id);
    $page->fill($request->all());
    $page->save();
    $page->syncTags($request->get('tags', []));
    return redirect()->route('admin.page.index')->withSuccess('Page saved.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return Response
   */
  public function destroy($id)
  {
    $page = Page::findOrFail($id);
    $page->tags()->detach();
    $page->delete();

    return redirect()->route('admin.page.index')->withSuccess('Page deleted.');
  }
}