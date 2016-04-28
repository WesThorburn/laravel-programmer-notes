<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'NoteController@index');
Route::get('/notesDataTable/{selectedNote?}', 'NoteController@notesDataTable');

Route::resource('note', 'NoteController');

Route::auth();


