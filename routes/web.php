<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Models\Catalog;


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

// routes/web.php


Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');
Route::post('/signup', [RegisterController::class, 'register']);
Route::get('/catalogs/{id}',[CatalogController::class, 'show']);
Route::get('/search/search', [CatalogController::class, 'search'])->name('catalogs.search');




Route::get('/', function () {
    $catalog = Catalog::find(1);
    $ratedCatalog = Catalog::orderBy('rating', 'desc')->get();
    $recent = Catalog::orderBy('created_at', 'desc')->get();

 // This is where elibrary fetch data from the database
    return view('landing.index', ['catalogs' => $catalog, 'rates' => $ratedCatalog, 'recents' => $recent]);
})->name('home');

Route::view('/login', 'pages.login')
->name('login');

Route::view('/signup', 'pages.signup')
->name('signup');

Route::view('/dashboard', 'pages.accounts')
->name('dashboard')->middleware('auth');

Route::view('/bookmarks', 'pages.account_bookmarks')
->name('bookmarks')->middleware('auth');

Route::view('/profiles', 'pages.account_profile')
->name('profile')->middleware('auth');

Route::get('/search', function(){
    return view('pages.search');
})->name('search');

Route::get('/catalogs', function(){
    return view('pages.catalogs');
})->name('catalogs');
