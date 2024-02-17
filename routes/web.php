<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', 'App\Http\Controllers\RegistrationController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\RegistrationController@register')->name('register.submit');

Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login.submit');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('/post', 'App\Http\Controllers\HomeController@createPost')->name('post.create');

Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search');
Route::get('/profile', 'App\Http\Controllers\ProfileController@profile')->name('profile');
Route::get('/logout', 'App\Http\Controllers\LogoutController@logout')->name('logout');

Route::get('/api/fetch-posts', 'App\Http\Controllers\PostController@fetchPosts')->name('fetch.posts');
Route::post('/api/like-post', 'App\Http\Controllers\PostController@likePost')->name('post.like');
Route::post('/api/unlike-post', 'App\Http\Controllers\PostController@unlikePost')->name('post.unlike');
Route::post('/api/remove-post', 'App\Http\Controllers\PostController@removePost');
Route::post('/api/fetch-comments', 'App\Http\Controllers\PostController@fetchComments')->name('fetch.comments');
Route::post('/api/submit-comment', 'App\Http\Controllers\PostController@submitComment')->name('submit.comment');
Route::post('/api/check-like', 'App\Http\Controllers\PostController@checkLike')->name('check.like');
 










