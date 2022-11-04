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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// creiamo rotta /api/posts collegata Api\PostController@index e poi la show /api/posts/{post}->Api\PostController@show
Route::resource('posts','Api\PostController')->only(['index','show'])->parameters([
    'posts'=>'slug'
]);

// ALTRO MODO PER CHIAMARE LA ROTTA
// Route::get('posts','Api\PostController@index');

Route::post('/lead', 'Api\LeadController@store');