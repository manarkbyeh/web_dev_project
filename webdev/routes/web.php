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



Route::resource('match', 'MatchesController');
Route::resource('/', 'HomeController');

Route::post('like', 'LikeController@like');


Route::get('Guest/facebook', ['uses'=>'GastController@redirectToProvider','as'=>'Guest.facebook']);
Route::get('Guest/fasebook/callback', 'GastController@handleProviderCallback');

Route::get('Guest/', 'GastController@index');
Route::get('Guest/create', 'GastController@create');

Route::post('/Guest', 'GastController@store')->name('Guest.store');

Route::delete('/Guest/{id}/restore', [
    'as' => 'Guest.restore',
    'uses' => 'GastController@restore'
    ]);

Route::delete('/match/{id}/restore', [
'as' => 'match.restore',
'uses' => 'MatchesController@restore'
]);
Route::resource('/image', 'ImageController')->only(['index','store','delete']);
Route::delete('image/{id}/delete', [
'as' => 'image.delete',
'uses' => 'ImageController@delete'
]);
Route::get('/image/upload','ImageController@upload' ); 
//Route::get('image/{id}/delete', ['uses'=>'ImageController@delete','as'=>'image.delete']);
//Route::post ("image/delete", 'ImageController@destroy');
Auth::routes();


