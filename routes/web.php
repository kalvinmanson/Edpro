<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
  Route::get('/', 'CategoryController@index');
  Route::resource('categories', 'CategoryController');
  Route::resource('attachments', 'AttachmentController');
  Route::resource('pages', 'PageController');
  Route::resource('fields', 'FieldController');
  Route::resource('notifications', 'NotificationController');
  Route::resource('contacts', 'ContactController');
  Route::resource('blocks', 'BlockController');
  Route::resource('users', 'UserController');
  //store
  Route::resource('publishers', 'PublisherController');
  Route::resource('topics', 'TopicController');
  Route::resource('authors', 'AuthorController');
  Route::resource('books', 'BookController');
  Route::resource('orders', 'OrderController');
});
//Route::get('/migrate', 'WebController@migrate')->name('migrate');

Auth::routes();

Route::get('/home', 'WebController@index')->name('home');
Route::get('/', 'WebController@soon')->name('soon');
Route::post('/contact', 'ContactController@store')->name('contact');

/* STORE */
Route::get('/buscar', 'StoreController@search')->name('search');
Route::get('/tienda', 'StoreController@index')->name('store');
Route::get('/tienda/topic/{topic}', 'StoreController@index')->where('topic', '[a-z,0-9-]+')->name('storeTopic');
Route::get('/tienda/{slug}', 'StoreController@book')->where('slug', '[a-z,0-9-]+')->name('book');
Route::post('/tienda/{slug}/addcomment', 'StoreController@addcomment')->where('slug', '[a-z,0-9-]+')->middleware(['auth'])->name('addcomment');

//Cart
Route::get('/cart', 'CartController@index');
Route::get('/cart/json', 'CartController@json');
Route::get('/cart/add/{id}', 'CartController@store')->name('cartAdd');
Route::get('/cart/remove/{id}', 'CartController@remove')->name('cartRemove');
Route::post('/cart/update/{id}', 'CartController@update')->name('cartUpdate');

//Orders
Route::middleware(['auth'])->group(function () {
  Route::resource('orders', 'OrderController');
});

/* Blog */
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{slug}', 'BlogController@post')->where('slug', '[a-z,0-9-]+')->name('post');
