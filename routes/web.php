<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'landing.index')
->name('home');
Route::view('/login', 'pages.login')
->name('login');
Route::view('/signup', 'pages.signup')
->name('signup');
Route::view('/account', 'pages.accounts')
->name('account');
Route::view('/bookmarks', 'pages.account_bookmarks')
->name('bookmarks');
Route::view('/edit', 'pages.account_profile')
->name('edit');
Route::view('/catalogs', 'pages.catalogs')
->name('catalogs');
Route::view('/books', 'pages.books')
->name('books');

