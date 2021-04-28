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
Route::get('/', function () {

$locale = config('app.locale');
return redirect($locale);
});
Route::prefix('{locale}')->group(function ($locale)
{
$host=env("APP_DOMAIN", "membership.local");

Route::group(['domain' => $host], function($host)
  {
    Route::get('/', 'WebBlogController@index');
    Route::post('/login-member', 'ApiController@login')->name('login-member')->middleware('cors');
    Route::get('company', 'WebBlogController@index');
    Route::get('site/{slug}', 'WebBlogController@site')->name('site');
    Route::get('read/{slug}', 'WebBlogController@read')->name('read');
    Route::get('category/{slug}', 'WebBlogController@category')->name('category');
    Route::get('subscribed/{domain}', 'WebBlogController@subscribed')->name('subscribed');
    Route::get('reserved/{domain}/{invoice}', 'WebBlogController@reserved')->name('reserved');
  });
});

Route::get('/{locale}/islogin/{slug}/{domain}', 'CheckLoginController@index')->name('islogin');
Route::get('profile', function (){
})->middleware('verified');
Route::group(['middleware' => ['auth', 'domain']], function() {
Route::prefix('{locale}')->group(function ($locale)
{
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usersdata', 'UserController@anyData')->name('usersdata');
Route::get('/usersdelete/{id}', 'UserController@destroy')->name('usersdelete');

Route::resource('roles','RoleController');
Route::resource('menu','MenuController');
Route::resource('members','MasterMemberController');
Route::resource('member-periode','UserMemberPeriodeController');
Route::resource('benefit','BenefitController');
Route::resource('member-benefit','MemberBenefitController');
Route::resource('artist-category','ArtistCategoryController');
Route::resource('post-category','PostCategoryController');
Route::resource('post','PostController');
Route::resource('users','UserController');
Route::resource('payment','PaymentController');
Route::resource('setting','SettingController');
Route::resource('info','InfoController');
Route::resource('other','OtherController');
Route::resource('contact','ContactController');
Route::resource('slider','SliderController');
Route::resource('album','AlbumController');
Route::resource('media', 'MediaController');
Route::resource('artist-ngefans','ArtistNgefansController');
Route::resource('fitur','FiturController');
Route::resource('email','EmailController');
Route::resource('transaction','TransactionController');
Route::resource('data-member','DataMemberController');
#Route::resource('menu','MenuController');
//Route::get('/setting/{id}', 'UserController@setting')->name('setting');
  # code...
});

});


