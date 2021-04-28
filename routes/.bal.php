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

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usersdata', 'UserController@anyData')->name('usersdata');
Route::get('/usersdelete/{id}', 'UserController@destroy')->name('usersdelete');
Route::get('profile', function (){
})->middleware('verified');

Route::group(['middleware' => ['auth']], function() {

Route::resource('roles','RoleController');
Route::resource('members','MasterMemberController');
Route::resource('artist-category','ArtistCategoryController');
Route::resource('users','UserController');
Route::resource('payment','PaymentController');
Route::resource('setting','SettingController');
//Route::get('/setting/{id}', 'UserController@setting')->name('setting');
});

Route::group(['domain' => '{username}.membership.local'], function()
{

  Route::get('/', 'WebArtistController@index');
  Route::get('/login', 'HomeController@index');
  Route::get('/membership', 'HomeController@index');

  Route::get('/about', 'WebArtistController@profile', function($username) {
    //return view('artist.pages.home', compact('username'));
  });

  Route::get('/artist/blog', function($username) {
    return 'Anda mengunjungi blog ' . $username;
  });

  Route::get('/artist/about', function($username) {
    return 'Anda mengunjungi about ' . $username;
  });
  Route::get('/artist/read/{id}', function($username, $id) {
    return 'Anda mengunjungi blog-details ' . $username . ' '. $id;
  });

});
