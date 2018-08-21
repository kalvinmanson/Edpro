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


Auth::routes();

Route::get('/home', 'WebController@index')->name('home');
Route::get('/', 'WebController@index')->name('home');
