<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
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

Route::get('/', function() {
    // put return code here
    // put function with required code
    return view('landing.index');
})->name('home');
Route::view('/login', 'pages.login')
->name('login');
Route::view('/signup', 'pages.signup')
->name('signup');
Route::view('/dashboard', 'pages.accounts')
->name('dashboard');
Route::view('/bookmarks', 'pages.account_bookmarks')
->name('bookmarks');
Route::view('/profiles', 'pages.account_profile')
->name('profile');
Route::view('/catalogs', 'pages.catalogs')
->name('catalogs');
Route::view('/books', 'pages.books')
->name('books');

/* Route::resources([
    'home' => UserController::class,
    'account' => UserController::class,
    'home' => CatalogController::class,
    'catalogs' => CatalogController::class,
    'books' => CatalogController::class
]); */
