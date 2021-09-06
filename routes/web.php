<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\NewsletterController;


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

Route::post('sendnewsletter',  [NewsletterController::class, 'sendmail'])->name('sendnewsletter');
Route::resource('newsletter', 'App\Http\Controllers\Backend\NewsletterController');

Route::view('susbscribe/{path?}', 'react.app');
