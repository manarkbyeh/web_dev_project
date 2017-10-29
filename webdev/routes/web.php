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


//Route::resource('/', 'MatchesController');
Route::group(['middleware'=>'Lang'], function () {
    Route::resource('match', 'MatchesController');
});
Route::resource('match', 'MatchesController');
// Route::delete('/match/{id}/restore', ['as' => 'match.restore','uses' => 'MatchesController@restore']);

Route::resource('/', 'HomeController');

Route::post('like', 'LikeController@like');


Route::get('/Guest/facebook', ['uses'=>'GastController@redirectToProvider','as'=>'Guest.facebook']);
Route::get('/Guest/fasebook/callback', 'GastController@handleProviderCallback');
Route::get('/Guest/', 'GastController@index');
Route::get('/Guest/create', 'GastController@create');
Route::post('/Guest', 'GastController@store')->name('Guest.store');
Route::delete('/Guest/{id}/delete', ['as' => 'Guest.delete','uses' => 'GastController@delete']);




Route::resource('/image', 'ImageController')->only(['index','store','delete']);
Route::delete('image/{id}/delete', ['as' => 'image.delete','uses' => 'ImageController@delete']);
Route::get('/image/upload', 'ImageController@upload' );
Route::get('/image/popular', 'ImageController@popular' );
Route::get('/image/last_image', 'ImageController@last_image' );
Route::post('/image/invite', 'ImageController@invite' );
Route::get('/image/win', 'ImageController@win' );
Route::get('/image/{id}', 'ImageController@index' );



Auth::routes();
