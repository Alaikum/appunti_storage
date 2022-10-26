<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


// genera rotte legate al login
Auth::routes();

// Route::middleware('auth')->get('/admin/home', 'Admin\HomeController@index')->name('admin.home');

// Route::middleware('auth')->get('/admin/posts', 'Admin\PostController@index')->name('admin.posts.index');

//è una ripetizione che possiamo evitare
Route::middleware('auth')
->prefix('admin') //per il /admin/home
->name('admin.')   //per il nome admin.home
->namespace('Admin')  //toglie Admin\
->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts','PostController');
});