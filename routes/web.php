<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

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

Auth::routes();
 
  Route::get('/home', 'HomeController@index')->name('home');
 
  Route::middleware('auth')->group(function () {
      Route::post('/lessons/{lesson}/reserve', 'Lesson\ReserveController')->name('lessons.reserve');
      Route::get('/lessons/{lesson}', 'LessonController@show')->name('lessons.show');
  });
