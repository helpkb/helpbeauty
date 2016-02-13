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
   * @var CategoryRepository
   */
  private $category;

  public function __construct(Category $category)
  {
    $this->category = $category;
  }

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
        $sl = $request->input('slug');
        $slug = str_slug($sl, "-");
        $category->slug = $slug;
        // send success message to index page
        try{
          $category->fill($request->except('slug'))->save();
     **/
    Category::create($request->all());
    return redirect()->route('admin.category.index')->withSuccess('New Category Successfully Created.');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Category $category
   * @return Response
   */
  public function edit($id)
  {
    $category = Category::findOrFail($id);

    return view('admin.category.edit')->withCategory($category);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Category              $category
   * @param  UpdateCategoryRequest $request
   * @return Response
   */
  public function update($id, UpdateCategoryRequest $request)
  {
    $category = Category::findOrFail($id);

    $input = $request->all();

    $category->fill($input)->save();

    return redirect()->route('admin.category.index')->withSuccess('Category saved.');
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
    return redirect()->route('admin.category.index')->withSuccess('Category deleted.');
  }
}
