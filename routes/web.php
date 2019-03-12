<?php

use App\Article;

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

Route::get('/', [
    'uses' => 'ArticleController@show_all'
]);

Route::get('/about', function(){
    return view('about');
});

Route::get('/contact', function(){
    return view('contact');
});

// Route::post('/contact', [
//     'uses' => 'ContactController@sendmail'
// ]);

Route::get('/news',[
    'as' => 'news',
    'uses' => 'ArticleController@show_all'
]);

Route::get('/news/create', [
    'as' => 'news_create',
    'uses' => 'ArticleController@showCreate'
])->middleware('auth');

Route::post('/news/create', [
    'uses' => 'ArticleController@create'
])->middleware('auth');

Route::get('/news/edit/{id}', [
    'as' => 'news_edit',
    'uses' => 'ArticleController@find'
])->middleware('auth');

Route::post('/news/edit/', [
    'uses' => 'ArticleController@update'
])->middleware('auth');

Route::post('/news/delete', [
    'uses' => 'ArticleController@delete'
])->middleware('auth');

Route::get('/collections/create', [
    'as' => 'collection_create',
    'uses' => 'CollectionController@show_create'
])->middleware('auth');

Route::get('/collections', [
    'as' => 'collections',
    'uses' => 'CollectionController@show_all_collections'
]);

Route::get('/collections/{id}', [
    'as' => 'collection_view',
    'uses' => 'CollectionController@show_one'
]);

Route::post('/collections/create', [
    'uses' => 'CollectionController@create'
])->middleware('auth');

Route::get('/collections/edit/{id}', [
    'as' => 'collection_edit',
    'uses' => 'CollectionController@edit'
])->middleware('auth');

Route::post('/collections/edit/', [
    'uses' => 'CollectionController@update'
])->middleware('auth');

Route::post('/collections/delete', [
    'uses' => 'CollectionController@delete'
])->middleware('auth');

Route::get('/products/create/{id}', [
    'as' => 'product_create',
    'uses' => 'ProductController@showCreate'
]);

Route::post('/products/create', [
    'uses' => 'ProductController@create'
]);

Route::get('/products/{id}', [
    'as' => 'product_view',
    'uses' => 'ProductController@showOne'
]);

Route::get('/products/edit/{id}', [
    'as' => 'product_edit',
    'uses' => 'ProductController@edit'
]);

Route::post('/products/edit/{id}', [
    'uses' => 'ProductController@update'
]);

Route::post('/products/delete/{id}', [
    'uses' => 'ProductController@delete'
]);

Route::post('/img-delete', [
    'as' => 'image_delete',
    'uses' => 'ProductController@delete_additional_image'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
