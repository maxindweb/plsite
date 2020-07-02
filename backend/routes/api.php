<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Register and Login
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

//Upload Image
Route::post('/upload-image', 'ArticleController@uploadImage');

//User
Route::get('/users', 'UserController@index');
Route::get('/users/{user}', 'UserCotroller@show');
Route::post('/users/{user}', 'UserController@update');

//category 
Route::get('/category', 'CategoryController@index');
Route::get('/category/{slug}', 'CategoryController@show');
Route::get('/category/{slug}/guest', 'CategoryController@showGuest');
Route::post('/category', 'CategoryController@store');
Route::patch('/category/{slug}', 'CategoryController@update');

//Article API
Route::get('/article', 'ArticleController@index');
Route::get('/article/published', 'ArticleController@indexPublished');
Route::get('/article/archive', 'articleController@indexArchive');
Route::get('/article/{article}', 'ArticleController@show');
Route::post('/article', 'ArticleController@store');
Route::post('/article/1', 'ArticleController@update');
Route::post('/article/{article}/published', 'ArticleController@published');
Route::post('/article/{article}/archive', 'ArticleController@archive');
// Route::delete('article/{article}')
