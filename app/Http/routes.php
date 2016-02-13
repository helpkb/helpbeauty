<?php
// Blog pages

Route::get('/', function () {
  return redirect('/blog');
});

Route::get('blog', [
  'as' => 'blog.index', 'uses' => 'BlogController@index'
]);

Route::get('{slug}', [
  'as' => 'blog.slug', 'uses' => 'BlogController@showPost'
]);


$router->get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');


Route::get('rss', 'BlogController@rss');
Route::get('sitemap.xml', 'BlogController@siteMap');

// Admin area
/*
get('admin', function () {
  return redirect('/admin/post');
});
*/
Route::get('admin', function () {
  return view('admin/layouts/admin_template');
});


$router->group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
  Route::get('admin/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
  /*
get('roles', ['as' => 'admin.user.role.index', 'uses' => 'RolesController@index']);
  get('roles/create', ['as' => 'admin.user.role.create', 'uses' => 'RolesController@create']);
  post('roles', ['as' => 'admin.user.role.store', 'uses' => 'RolesController@store']);
  get('roles/{roles}/edit', ['as' => 'admin.user.role.edit', 'uses' => 'RolesController@edit']);
  put('roles/{roles}/edit', ['as' => 'admin.user.role.update', 'uses' => 'RolesController@update']);
*/

  Route::get('posts', ['as' => 'admin.post.index', 'uses' => 'PostController@index']);
  Route::get('post/create', ['as' => 'admin.post.create', 'uses' => 'PostController@create']);
  Route::post('posts', ['as' => 'admin.post.store', 'uses' => 'PostController@store']);
  Route::get('post/{post}/edit', ['as' => 'admin.post.edit', 'uses' => 'PostController@edit']);
  Route::put('posts/{post}', ['as' => 'admin.post.update', 'uses' => 'PostController@update']);
  Route::delete('posts/{post}', ['as' => 'admin.post.destroy', 'uses' => 'PostController@destroy']);


  Route::get('categories', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
  Route::get('category/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
  Route::post('category', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']);
  Route::get('category/{category}/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
  Route::put('category/{category}', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);
  Route::delete('category/{category}', ['as' => 'admin.category.destroy', 'uses' => 'CategoryController@destroy']);

  Route::get('tags', ['as' => 'admin.tag.index', 'uses' => 'TagController@index']);
  Route::get('tags/create', ['as' => 'admin.tag.create', 'uses' => 'TagController@create']);
  Route::post('tags', ['as' => 'admin.tag.store', 'uses' => 'TagController@store']);
  Route::get('tags/{tag}/edit', ['as' => 'admin.tag.edit', 'uses' => 'TagController@edit']);
  Route::put('tags/{tag}', ['as' => 'admin.tag.update', 'uses' => 'TagController@update']);
  Route::delete('tags/{tag}', ['as' => 'admin.tag.destroy', 'uses' => 'TagController@destroy']);

  //resource('admin/tag', 'TagController', ['except' => 'show']);

  Route::get('admin/upload', ['as' => 'upload.index', 'uses' => 'UploadController@index']);
  Route::post('admin/upload/file', ['as' => 'upload.file', 'uses' => 'UploadController@uploadFile']);
  Route::delete('admin/upload/file', ['as' => 'upload.delete', 'uses' => 'UploadController@deleteFile']);
  Route::post('admin/upload/folder', ['as' => 'upload.folder', 'uses' => 'UploadController@createFolder']);
  Route::delete('admin/upload/folder', ['as' => 'upload.deletefolder', 'uses' => 'UploadController@deleteFolder']);
});


/*
// Logging in and out
get('/auth/register', 'Auth\AuthController@getRegister');
post('/auth/register', 'Auth\AuthController@postRegister');
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
*/
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

