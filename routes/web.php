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

Route::resource('project', 'ProjectController');

Route::resource('task', 'TaskController');

Route::resource('subTask', 'SubTaskController');

Route::post('comment', 'CommentController@store');
