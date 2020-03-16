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

Route::get('/', "HomeController@index");


Route::get('/home', 'HomeController@index')->name('home');

/** Events Routes */
// Additional routes must be declared before the resource
Route::get("events/interests", 'EventInterestContoller@index')
    ->name('events.interests')
    ->middleware('auth');

Route::post('/events/{id}/interest', 'EventInterestContoller@create')
    ->name('events.interested')
    ->middleware('auth');


Route::resource('events', 'EventController')->only([
    'create', 'store', 'edit', 'update', 'delete'
])->middleware('auth');

Route::resource('events', 'EventController')->except([
    'create', 'store', 'edit', 'update', 'delete'
]);

/** Events Routes */

/** User Routes */
Route::resource('users', 'UserController')->only([
    'show', 'edit', 'update'
]);

Auth::routes();
/** User Routes */

/** Tag Routes */

Route::get("tags/", 'TagController@index')->name('tags.index');
Route::get("tags/{id}/", 'TagController@show')->name('tags.show');

/** Tag Routes */

/** Testing */

