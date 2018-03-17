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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
    Route::get('/{id}/{title}', 'QuestionController@index')->name('index');
    Route::post('/create', 'QuestionController@create')->name('create')->middleware('auth');
    Route::post('/fav', 'QuestionController@makeFavorite')->name('fav')->middleware('auth');
    Route::post('/vote', 'QuestionController@vote')->name('vote')->middleware('auth');
    Route::post('/bestAnswer', 'QuestionController@bestAnswer')->name('bestAnswer')->middleware('auth');
});
Route::group(['prefix' => 'answer', 'as' => 'answer.'], function () {
    Route::post('post', 'AnswerController@create')->name('post');
});
Route::get('/category/{id}/{name}', 'CategoryController@index')->name('category.index');
Route::any('/search', 'HomeController@search')->name('search');
Route::get('/user/{id}/{username}', 'UserController@index')->name('user.index');

/*Route::get('/test', function ()
{
    dd(\App\User::find(1)->FavouriteQuestions);
});*/




Route::get('chats', 'ChatController@chats')->name('chats');

