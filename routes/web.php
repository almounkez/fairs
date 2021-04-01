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

})->middleware('admin');


Auth::routes();

Route::get('/', function () {
return redirect('/home');
});
Route::get('/home','HomeController@index')->name('home');

// Route::resource('fairs', 'FairController');

Route::resource('fair', 'FairController');

Route::get('fair/{fair}/suites','FairController@suites')->name('fair.suites');
Route::get('fair/{fair}/slides','FairController@slides')->name('fair.slides');
Route::get('fair/{fair}/categories', 'FairController@categories')->name('fair.categories');
Route::get('fair/{fair}/subcategories', 'FairController@subcategories')->name('fair.subcategories');
Route::get('fair/{fair}/advertises','FairController@advertises')->name('fair.advertises');
Route::get('fair/{fair}/marquees', 'FairController@marquees')->name('fair.marquees');
Route::get('fair/{fair}/mailLists', 'FairController@mailLists')->name('fair.mailLists');



Route::resource('suite', 'SuiteController')->except(['create']);
Route::get('suite/{fair}/create','SuiteController@create')->name('suite.create');

Route::get('suite/{suite}/products','SuiteController@products')->name('suite.products');
Route::get('suite/{suite}/slides','SuiteController@slides')->name('suite.slides');
Route::get('suite/{suite}/articles', 'SuiteController@articles')->name('suite.articles');
Route::get('suite/{suite}/marquees', 'SuiteController@marquees')->name('suite.marquees');
Route::get('suite/{suite}/mailLists', 'SuiteController@mailLists')->name('suite.mailLists');


// Route::get('suite/{suiteId}/addSlide','SuiteController@addSlide')->name('suite.addSlide');

Route::resource('slide', 'SlideController')->except(['create']);
Route::get('slide/{fair}/createForFair','SlideController@createforFair')->name('slide.createForFair');
Route::get('slide/{suite}/createForSuite', 'SlideController@createforSuite')->name('slide.createForSuite');
// Route::get('slide/{fair}/fair', 'SlideController@indexFair')->name('slide.indexFair');
// Route::get('slide/{suite}/suite', 'SlideController@indexSuite')->name('slide.indexSuite');

Route::resource('category','CategoryController')->except(['create']);
Route::get('category/{fairId}/create', 'CategoryController@create')->name('category.create');

Route::resource('subcategory','SubcategoryController')->except(['create']);
Route::get('subcategory/{fairId}/create', 'SubcategoryController@create')->name('subcategory.create');

Route::resource('advertise', 'AdvertiseController')->except(['create']);
Route::get('advertise/{fairId}/create', 'AdvertiseController@create')->name('advertise.create');

Route::resource('marquee', 'MarqueeController')->except(['create']);
Route::get('marquee/{fairId}/createForFair', 'MarqueeController@createforFair')->name('marquee.createForFair');
Route::get('marquee/{suiteId}/createForSuite', 'MarqueeController@createforSuite')->name('marquee.createForSuite');
// Route::get('marquee/{fair}/fair', 'MarqueeController@indexFair')->name('marquee.indexFair');
// Route::get('marquee/{suite}/suite', 'MarqueeController@indexSuite')->name('marquee.indexSuite');

Route::resource('product', 'ProductController')->except(['create','index']);
Route::get('product/{suite}/create', 'ProductController@create')->name('product.create');

Route::resource('article', 'ArticleController')->except(['create','index']);
Route::get('article/{suiteId}/create', 'ArticleController@create')->name('article.create');

Route::get('search/suites/{fair}/cat/{category}', 'SearchController@suitesByCat')->name('search.suites.cat');
Route::get('search/suites/{fair}/cat/{category}/subcat/{subcategory}', 'SearchController@suitesBySubCat')->name('search.suites.subcat');
Route::get('search/products/{suite}/cat/{category}', 'SearchController@productsByCat')->name('search.products.cat');
Route::get('search/products/{suite}/cat/{category}/subcat/{subcategory}', 'SearchController@productsBySubCat')->name('search.products.subcat');


Route::get('mailList/create','MailListController@create')->name('mailList.create');
Route::get('mailList/{fairId}/createForFair','MailListController@createForFair')->name('mailList.createForFair');
Route::get('mailList/{suiteId}/createForSuite', 'MailListController@createForSuite')->name('mailList.createForSuite');

// Route::post('mail/store','MailListController@store')->name('mailList.store');
Route::get('mailList/reload-captcha', 'MailListController@reloadCaptcha')->name('mailList.recap');

Route::resource('mailList','MailListController')->only(['index','store','destroy']);
