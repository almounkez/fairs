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

Route::get('/', function () {
return redirect('/home');
});
Route::get('/home','HomeController@index')->name('home');

// Route::resource('fairs', 'FairController');
Route::resource('fair', 'FairController');
Route::get('fair/{fair}/manage','FairController@manage')->name('fair.manage');
Route::get('fair/{fair}/suites','FairController@suites')->name('fair.suites');
Route::get('fair/{fair}/slides','FairController@slides')->name('fair.slides');
Route::get('fair/{fair}/categories', 'FairController@categories')->name('fair.categories');
Route::get('fair/{fair}/subcategories', 'FairController@subcategories')->name('fair.subcategories');

Route::resource('suite', 'SuiteController')->except(['create']);
Route::get('suite/{fair}/create','SuiteController@create')->name('suite.create');
Route::get('suite/{suiteId}/addSlide','SuiteController@addSlide')->name('suite.addSlide');

Route::resource('slide', 'SlideController')->except(['create']);
Route::get('slide/{fairId}/create','SlideController@create')->name('slide.create');

Route::resource('category','CategoryController')->except(['create']);
Route::get('category/{fairId}/create', 'CategoryController@create')->name('category.create');

Route::resource('subcategory','SubcategoryController')->except(['create']);
Route::get('subcategory/{fairId}/create', 'SubcategoryController@create')->name('subcategory.create');

Route::resource('article','ArticleController')->except(['create']);
Route::get('article/{suiteId}/create', 'ArticleController@create')->name('article.create');

Route::resource('advertise', 'AdvertiseController')->except(['create']);
Route::get('advertise/{fairId}/create', 'AdvertiseController@create')->name('advertise.create');

Route::resource('marquee', 'MarqueeController')->except(['create','index']);
Route::get('marquee/{fairId}/createForFair', 'MarqueeController@createforFair')->name('marquee.createForFair');
Route::get('marquee/{suiteId}/createForSuite', 'MarqueeController@createforSuite')->name('marquee.createForSuite');

Route::get('marquee/{fair}/fair', 'MarqueeController@indexFair')->name('marquee.indexFair');
Route::get('marquee/{suite}/suite', 'MarqueeController@indexSuite')->name('marquee.indexSuite');

Route::resource('product', 'ProductController');
// Route::get('product', 'Prodcut@index')->name('product.index');
// Route::get('product/{suite}/suite', 'product@indexSuite')->name('product.indexSuite');
