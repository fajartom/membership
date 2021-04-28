<?php

Auth::routes(['verify' => true]);

Route::get('/', function () {
  $locale = config('app.locale');
  return redirect($locale);
});

Route::get('login-validate/{token?}', 'Auth\LoginController@validateCrossSiteToken')->name('login.validate');

Route::prefix('{locale}')->group(function ($locale){
  // Route::group(['domain' => '{username}.local'], function($username) {
  Route::get('/', 'WebArtistController@index')->name('home');
  Route::get('/shop', 'WebArtistController@shop')->name('store');
  Route::get('/login', 'HomeController@index');
  Route::get('/login-member', function ($locale) {
     return view('auth.login-member', ['locale' => $locale, 'domain' => request()->getHost()]);
  })->name('login-member');

  Route::get('/about', 'WebArtistController@profile')->name('about');
  Route::get('/detail/{slug}', 'WebArtistController@detail')->name('detail');
  Route::get('/category/{slug}', 'WebArtistController@category')->name('category');
  
  Route::group(['middleware' => ['auth', 'domain']], function (){
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
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
  });
//Route::get('/setting/{id}', 'UserController@setting')->name('setting');
  // });
});
