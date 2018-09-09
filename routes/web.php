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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'loggedIn'], function () {
    Route::resource('/bank', 'BankController');
    Route::resource('/account', 'AccountController');
    Route::resource('/transition', 'TransitionController');
    Route::get('/transition/create/withdraw', 'TransitionController@createWithdraw')->name('transition.createWithdraw');
    Route::get('/transition/create/deposit', 'TransitionController@createDeposit')->name('transition.createDeposit');
    Route::resource('/user', 'UserController');
});
