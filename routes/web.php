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
//
// Route::get('/', function () {
//     return view('website.index');
// });
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


// website route
Route::group(['namespace'=>'Website'],function(){
  // index route
  Route::get('/','WebsiteController@index')->name('index');
  Route::get('/page/{webpage}','WebsiteController@page')->name('page');
  Route::get('/search','WebsiteController@web_search')->name('search');
  Route::get('/all','WebsiteController@postAll')->name('all.posts');
  Route::get('/details/{post}','WebsiteController@show')->name('blog.show');
  Route::get('/category/{category}','WebsiteController@categoryByPost')->name('category.posts');
  Route::get('/tag/{tag}','WebsiteController@tagByPost')->name('tag.posts');
  Route::get('/user/{user}','WebsiteController@postByUser')->name('user.posts');
  Route::get('/monthly/posts','WebsiteController@monthlyposts')->name('monthly.posts');
  Route::get('/contact','WebsiteController@contact')->name('contact');
  Route::post('/contact','WebsiteController@contact_submit')->name('contact.submit');
  Route::post('/subscription','WebsiteController@subscription')->name('subscription');
  Route::post('/comment','WebsiteController@comment')->name('comment');
});


// Admin routs

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth','as'=>'admin.'],function(){
  Route::get('/','DashboardController@index')->name('index');
  // post other route
  Route::get('/post/recycle','PostController@recycle')->name('post.recycle');
  Route::get('/post/restore/{post}','PostController@restore')->name('post.restore');
  Route::delete('/post/delete/{post}','PostController@forceDelete')->name('post.forceDelete');
  Route::get('/post/approved/{post}','PostController@approved')->name('post.approved');

  // category other route
  Route::get('/category/restore/{category}','CateogryController@restore')->name('category.restore');
  Route::delete('/category/delete/{category}','CateogryController@forceDelete')->name('category.forceDelete');
  Route::get('/cateogry/status/{category}','CateogryController@status')->name('category.status');

  // User Other Route

  Route::get('/user/restore/{user}','UserController@restore')->name('user.restore');
  Route::delete('/user/delete/{user}','UserController@forceDelete')->name('user.forceDelete');
  Route::get('/user/status/{user}','UserController@status')->name('user.status');

  // Tag Other Route

  Route::get('/tag/restore/{tag}','TagController@restore')->name('tag.restore');
  Route::delete('/tag/delete/{tag}','TagController@forceDelete')->name('tag.forceDelete');

  // Settings------------

  Route::get('/settings/footercontent','SettingController@footerContent')->name('footerContent');
  Route::put('/settings/footercontent','SettingController@footerContent_submit')->name('footerContent.submit');

  Route::get('/settings/seo','SettingController@seo')->name('seo');
  Route::put('/settings/seo','SettingController@seo_submit')->name('seo.submit');


  Route::get('/settings/image','SettingController@image')->name('image');
  Route::put('/settings/image','SettingController@image_submit')->name('image.submit');
  // comment -------------

  Route::get('/comment/approve/{comment}','CommentController@approve')->name('comment.approve');


  Route::resources([
    'post' => 'PostController',
    'category' => 'CateogryController',
    'user' => 'UserController',
    'tag' => 'TagController',
    'contact' => 'ContactController',
    'page' => 'PageController',
    'subscription' => 'subscriptionController',
    'comment' => 'CommentController',
    'advertizement' => 'AdvertizementController',
  ]);



});
