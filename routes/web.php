<?php

use Illuminate\Support\Facades\Route;

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
Route::get('locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    App::setLocale($locale);
    return redirect()->back();
});

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Route::resource('fairs', 'FairController');
Route::resource('fair', 'FairController');
Route::get('fair/{fair}/manage','FairController@manage')->name('fair.manage');

Route::resource('suite', 'SuiteController')->except(['create']);
Route::get('suite/{fair}/create','SuiteController@create')->name('suite.create');
Route::get('suite/{suiteId}/addSlide','SuiteController@addSlide')->name('suite.addSlide');

Route::resource('slide', 'SlideController')->except(['create']);
Route::get('slide/{fairId}/create','SlideController@create')->name('slide.create');

Route::resource('category','CategoryController')->except(['create']);
Route::get('category/{fairId}/create', 'CategoryController@create')->name('category.create');

