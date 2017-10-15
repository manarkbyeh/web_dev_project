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
    return view('index');
});

Route::get('/upload', function () {
    return view('images.upload');
});

Route::post('like', 'LikeController@like');
Route::resource('Guest', 'GastController');
Route::get('Guest/{id}/delete',['uses'=>'GastController@delete','as'=>'Guest.delete']);
Route::resource('/image', 'ImageController');
Route::get('image/{id}/delete',['uses'=>'ImageController@delete','as'=>'image.delete']);

?>