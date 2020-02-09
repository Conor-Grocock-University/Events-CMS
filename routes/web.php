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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

/** Events Routes */
Route::resource('events', 'EventController')->only([
    'create', 'store', 'edit', 'update', 'delete'
])->middleware('auth');
Route::resource('events', 'EventController')->except([
    'create', 'store', 'edit', 'update', 'delete'
]);

Route::post('events/{id}/interest', 'EventController@interest')
    ->name('events.interested')
    ->middleware('auth');
/** Events Routes */

/** User Routes */
Route::resource('users', 'UserController')->only([
    'show'
]);

Auth::routes();
/** User Routes */
