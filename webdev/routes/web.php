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
Route::group(['middleware'=>'Lang'],function(){
Route::resource('match', 'MatchesController');
});
Route::resource('match', 'MatchesController');
Route::resource('/', 'HomeController');

Route::get('/upload', function () {
    return view('images.upload');
}); 

Route::post('like', 'LikeController@like');
Route::resource('Guest', 'GastController');
/*Route::delete('/Guest/{id}/delete', [
'as' => 'Guest.delete',
'uses' => 'GastController@delete'
]);*/
Route::delete('/Guest/{id}/restore', [
'as' => 'Guest.restore',
'uses' => 'GastController@restore'
]);
Route::resource('/image', 'ImageController');
Route::delete('image/{id}/delete', [
'as' => 'image.delete',
'uses' => 'ImageController@delete'
]);

//Route::get('image/{id}/delete', ['uses'=>'ImageController@delete','as'=>'image.delete']);
//Route::post ("image/delete", 'ImageController@destroy');
Auth::routes();

