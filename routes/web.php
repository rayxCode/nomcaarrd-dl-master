<?php

use App\Http\Controllers\affiliationController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\bookmarkController;
use App\Http\Controllers\catalogTypeController;
use App\Http\Controllers\CommentsController;
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


Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/register/u/', [RegisterController::class, 'register'])->name('users.add');
//Route::post('/catalogs/{id}',[CatalogController::class, 'show']);
Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
Route::resource('/catalogs', CatalogController::class);

Route::resource('/bookmark', bookmarkController::class)->middleware('auth');
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

Route::view('/dashboard', 'pages.accounts')
    ->name('dashboard')->middleware('auth');

Route::get('/profiles', function () {
    $aff = Affiliation::all();
    return view('pages.account_profile', compact('aff'));
})->name('profiles')->middleware('auth');

Route::get('/catalogs', function () {

    return view('pages.catalogs');
})->name('catalogs');

Route::middleware(['checkAccessLevel:admin'])->group(function () {
    // Your routes or controller actions here
    Route::put('account/{id}/update', [UserController::class, 'updateAdmin'])->name('updateAd');
    Route::get('/users/u/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::delete('/users/u/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
    Route::resource('/index/affiliation', affiliationController::class);
    Route::resource('/index/catalog/types', catalogTypeController::class);
    Route::get('/index/review/search', [ReviewController::class, 'search']);
    Route::get('/index/catalogs/search', [CatalogController::class, 'searchCatalog']);


    Route::get('/index/review', function(){
        $catalogs = Catalog::orderBy('title')->with('types')->paginate(10);
        $types = CatalogType::all();
        return view('reviewer.review_catalogs', compact('catalogs', 'types'));
    })->name('catalogs_review');
    Route::get('/index', function () {
        $users = User::with('affiliation')->paginate(10);
        $affs = Affiliation::all();
        return view('admin.admin_users', compact('users', 'affs'));
    })->name('users');
    Route::get('/affiliations', function () {
    })->name('index');
    Route::get('/index/affiliations', function () {
        $affs = Affiliation::orderBy('name')->paginate(10);
        $affs->appends(['sort' => 'name']);
        return view('admin.admin_affiliations', compact('affs'));
    })->name('affiliations');
    Route::get('/index/catalogs', function () {
        $catalogs = Catalog::orderBy('title')->with('types')->paginate(10);
        $catalogs->appends(['sort' => 'title']);
        $types = CatalogType::all();
        return view('admin.admin_catalogs', compact('catalogs', 'types'));
    })->name('catalogs_index');
    Route::get('/index/types', function () {
        $types = CatalogType::paginate(10);
        $types->appends(['sort' => 'name']);
        return view('admin.admin_catalogsType', compact('types'));
    })->name('types_index');

});
