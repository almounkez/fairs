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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
