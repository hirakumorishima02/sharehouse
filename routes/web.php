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

// Route::get('/', function () {
//     return view('welcome');
// });

// indexからstatesページへの遷移のためのルーティング
Route::get('/', 'ShowController@index');
Route::get('/state/nsw', 'ShowController@nsw');
Route::get('/state/vic', 'ShowController@vic');
Route::get('/state/qld', 'ShowController@qld');
Route::get('/state/sa', 'ShowController@sa');
Route::get('/state/wa', 'ShowController@wa');
Route::get('/state/tas', 'ShowController@tas');

// statesからtown、sharehouseページへの遷移のためのルーティング
Route::get('/state/nsw/nswTown', 'TownController@nswTown');
Route::get('/state/vic/vicTown', 'TownController@vicTown');
Route::get('/state/qld/qldTown', 'TownController@qldTown');
Route::get('/state/sa/saTown', 'TownController@saTown');
Route::get('/state/wa/waTown', 'TownController@waTown');
Route::get('/state/tas/tasTown', 'TownController@tasTown');
Route::post('/map','TownController@postHouse');
Route::get('/house/{id}','TownController@getHouse')->where('post', '[0-9]+');
Route::delete('houses/{house}','TownController@destroy')->where('post', '[0-9]+');

// sharehouseページのお問い合わせフォームのためのルーティング
Route::post('contact/confirm', 'ContactsController@confirm');
Route::post('contact/complete', 'ContactsController@complete');

// コメント操作のためのルーティング
Route::post('house/{house}/comments', 'CommentsController@store')->where('post', '[0-9]+');
Route::get('house/{house}/comments/{comment}', 'CommentsController@destroy')->where('post', '[0-9]+');
