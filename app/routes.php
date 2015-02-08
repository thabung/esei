<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});



Route::get('songs', 'HomeController@searchSongs');

Route::get('songs/{id}', array('as' => 'get-song', 'uses' => 'SongsController@showOne'));
Route::get('search/{query?}', array('as' => 'search-song', 'uses' => 'SongsController@search'));
//Route::delete('songs/{id}', array('as' => 'delete-song', 'uses' => 'SongsController@showe'));

