<?php
use DB; 
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

Route::get('periods/{id}',['as' => 'periods.index', 'uses' => 'PeriodsController@index']);
Route::post('periods/{id}', ['as' => 'periods.store', 'uses' => 'PeriodsController@store']);
Route::get('periods/{id}/edit', ['uses' => 'PeriodsController@edit', 'as' => 'periods.edit']);
Route::put('periods/{id}', ['uses' => 'PeriodsController@update', 'as' => 'periods.update']);

Route::delete('periods/{id}/delete', ['as' => 'periods.delete','uses' => 'PeriodsController@delete']);
Route::resource('/', 'HomeController');
Route::get('/test', 'HomeController@test');

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


// Auth::routes()->except(['showRegistrationForm ']);
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// send an email to "batman@batcave.io"
use App\Mail\KryptoniteFound;

Route::get('/sendmail', function () {
    // send an email to "batman@batcave.io"
    $send = Mail::to('mdke@ymail.com')->send(new KryptoniteFound);
dd($send);
    return 'hello' . time();
});

Route::get('/habibCron', function () {
        DB::table('users')
            ->where('id', 1)
            ->update(['name' => str_random(10)]);
});

Route::get('/sendExel', 'cronController@sendExcelSheet' );
Route::get('/peroidCron', 'cronController@habibCronner' );

