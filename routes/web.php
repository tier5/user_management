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

Route::get('/','HomeController@index')->name('login_page');



Route::post('/signin','AuthController@login')->name('login');

Route::get('/userhome','HomeController@homepageuser')->name('home_page');

Route::get('/adminhome','HomeController@homepageadmin')->name('home_page_admin');

Route::get('/adminhome/adduser','UsersController@adduserview')->name('add_user_admin');

Route::get('/adminhome/viewusertable','UsersController@viewusertable')->name('view_table_user_admin');

Route::post('/adminhome/insertuser','UsersController@insertuser')->name('insert_user');

Route::post('/adminhome/viewuser','UsersController@viewuser')->name('view_users');

Route::get('/adminhome/edituser/{id}','UsersController@edituser')->name('edit_users');

Route::post('/adminhome/deleteuser','UsersController@deleteuser')->name('delete_users');

Route::post('/adminhome/updateuser','UsersController@updateuser')->name('update_user');

Route::post('/adminhome/blockuser','UsersController@blockuser')->name('block_users');

Route::post('/adminhome/unblockuser','UsersController@unblockuser')->name('unblock_users');

Route::post('/adminhome/searchuser','UsersController@searchuser')->name('search_user');

Route::get('/adminhome/logout','AuthController@logout')->name('logout');

