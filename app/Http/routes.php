<?php


// Blog pages
get('/', function () {
  return redirect('/blog');
});


get('blog', 'BlogController@index');
get('blog/{slug}', 'BlogController@showPost');


$router->get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');


get('rss', 'BlogController@rss');
get('sitemap.xml', 'BlogController@siteMap');

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
	//get('admin/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
    /*
	get('roles', ['as' => 'admin.user.role.index', 'uses' => 'RolesController@index']);
    get('roles/create', ['as' => 'admin.user.role.create', 'uses' => 'RolesController@create']);
    post('roles', ['as' => 'admin.user.role.store', 'uses' => 'RolesController@store']);
    get('roles/{roles}/edit', ['as' => 'admin.user.role.edit', 'uses' => 'RolesController@edit']);
    put('roles/{roles}/edit', ['as' => 'admin.user.role.update', 'uses' => 'RolesController@update']);
	*/

    get('posts', ['as' => 'admin.post.index', 'uses' => 'PostController@index']);
    get('post/create', ['as' => 'admin.post.create', 'uses' => 'PostController@create']);
    post('posts', ['as' => 'admin.post.store', 'uses' => 'PostController@store']);
    get('post/{post}/edit', ['as' => 'admin.post.edit', 'uses' => 'PostController@edit']);
    put('posts/{post}', ['as' => 'admin.post.update', 'uses' => 'PostController@update']);
    delete('posts/{post}', ['as' => 'admin.post.destroy', 'uses' => 'PostController@destroy']);

    /*
	get('categories', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
    get('categories/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
    post('categories', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']);
    get('categories/{category}/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
    put('categories/{category}', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);
    delete('categories/{category}', ['as' => 'admin.category.destroy', 'uses' => 'CategoryController@destroy']);
	*/

    get('tags', ['as' => 'admin.tag.index', 'uses' => 'TagController@index']);
    get('tags/create', ['as' => 'admin.tag.create', 'uses' => 'TagController@create']);
    post('tags', ['as' => 'admin.tag.store', 'uses' => 'TagController@store']);
    get('tags/{tag}/edit', ['as' => 'admin.tag.edit', 'uses' => 'TagController@edit']);
    put('tags/{tag}', ['as' => 'admin.tag.update', 'uses' => 'TagController@update']);
    delete('tags/{tag}', ['as' => 'admin.tag.destroy', 'uses' => 'TagController@destroy']);

	//resource('admin/tag', 'TagController', ['except' => 'show']);

  get('admin/upload', ['as' => 'upload.index', 'uses' => 'UploadController@index']);
  post('admin/upload/file', ['as' => 'upload.file', 'uses' => 'UploadController@uploadFile']);
  delete('admin/upload/file', ['as' => 'upload.delete', 'uses' => 'UploadController@deleteFile']);
  post('admin/upload/folder', ['as' => 'upload.folder', 'uses' => 'UploadController@createFolder']);
  delete('admin/upload/folder', ['as' => 'upload.deletefolder', 'uses' => 'UploadController@deleteFolder']);
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

