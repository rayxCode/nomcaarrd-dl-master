<?php

use App\Http\Controllers\affiliationController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\bookmarkController;
use App\Http\Controllers\catalogTypeController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Route;
use App\Models\Catalog;
use App\Models\User;
use App\Models\CatalogType;


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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register/u/', [RegisterController::class, 'register'])->name('users.add');;
Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
Route::resource('/catalogs', CatalogController::class);
Route::post('/catalogs/c/comments', [CommentsController::class, 'store'])->name('comment');
Route::post('/profiles/upload', [UserController::class, 'upload']);
Route::put('account/{id}/update', [UserController::class, 'update'])->name('update');



Route::get('/', function () {
    $catalogs = Catalog::inRandomOrder()->take(4)->get();
    $rates = Catalog::orderBy('rating', 'desc')->get();
    $recents = Catalog::orderBy('created_at', 'desc')->get();
    $catalogTypes = CatalogType::all();
    // This is where elibrary fetch data from the database
    return view('landing.index', compact('catalogs', 'rates', 'recents', 'catalogTypes'));
})->name('home');

Route::view('/login', 'pages.login')
    ->name('login');

Route::view('/signup', 'pages.signup')
    ->name('signup');

Route::get('/catalogs', function () {

    return view('pages.catalogs');
})->name('catalogs');



Route::middleware(['auth'])->group(function () {

    Route::get('/u/profiles', function () {
        $aff = Affiliation::all();
        return view('pages.account_profile', compact('aff'));

    })->name('profiles');

    Route::view('/u/profiles/dashboard', 'pages.accounts')
    ->name('dashboard_profiles');

    Route::get('/u/profiles/addCatalog', function(){
        $types = CatalogType::all();
        return view('pages.account_addCatalog', compact('types'));})->name('addCatalog');

    Route::resource('/u/profiles/bookmarks', bookmarkController::class);
    Route::delete('/u/profiles/bookmarks/{id}/clear', [BookmarkController::class, 'clearAllBookmarks'])->name('bookmarks.clearAll');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['checkAccessLevel:admin'])->group(function () {
    // Your routes or controller actions here
    Route::put('/account/{id}/update', [UserController::class, 'updateAdmin'])->name('updateAd');
    Route::get('/users/u/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::delete('/users/u/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
    Route::resource('/index/affiliation', affiliationController::class);
    Route::resource('/index/catalog/types', catalogTypeController::class);
    Route::get('/index/review/search', [ReviewController::class, 'search'])->name('searchCatalog');


    //index dashboard page
    Route::get('/index/dashboard', [Controller::class, 'index'])->name('index');

    //edit profile setting route for admin
    Route::get('/u/edit/{id}', [UserController::class, 'edit'])->name('settings');

    //index review page
    Route::get('/index/review', [ReviewController::class, 'index'])->name('catalogs_review');

    //index users page
    Route::get('/index/users', [UserController::class, 'index'])->name('users');

    //index affiliations page
    Route::get('/index/affiliations', [affiliationController::class, 'index'])->name('affiliations');

    //index catalog page
    Route::get('/index/catalogs', [CatalogController::class, 'index'])->name('catalogs_index');

    //index types page
    Route::get('/index/types', [catalogTypeController::class, 'index'])->name('types_index');

});
