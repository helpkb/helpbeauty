<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CategoryFormFields;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories = Category::all();

    return view('admin.category.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $data = $this->dispatch(new CategoryFormFields());
    return view('admin.category.create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  StoreCategoryRequest $request
   * @return Response
   */
  public function store(StoreCategoryRequest $request)
  {
    /*
        //$post = Post::create($request->postFillData());
        Post::create($request->all());
        $post->syncTags($request->get('tags', []));

        return redirect()
          ->route('admin.post.index')
          ->withSuccess('New Post Successfully Created.');
     *
     **/


    Category::create($request->all());

    //flash('messages.category created');

    return redirect()->route('admin.category.index')->withSuccess('New Category Successfully Created.');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Category $category
   * @return Response
   */
  public function edit(Category $category)
  {
    return view('admin.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Category              $category
   * @param  UpdateCategoryRequest $request
   * @return Response
   */
  public function update(Category $category, UpdateCategoryRequest $request)
  {
    $this->category->update($category, $request->all());

    flash('messages.category updated');

    return redirect()->route('admin.category.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Category $category
   * @return Response
   */
  public function destroy(Category $category)
  {
    $this->category->destroy($category);

    flash('blog::messages.category deleted');

    return redirect()->route('admin.category.index');
  }
}
