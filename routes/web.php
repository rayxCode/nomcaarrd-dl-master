<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\affiliationController;
use App\Http\Controllers\ApptController;
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
use App\Models\Category;
use App\Models\Document;


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
// Routes with no middleware accessible to public
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register/u/', [RegisterController::class, 'register'])->name('users.add');;
Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
Route::resource('/catalogs', CatalogController::class);
Route::post('/appointments', [ApptController::class, 'store'])->name('scheduled');

Route::get('/', function () {
    $views = Document::where('status', 1)->orderBy('view_count', 'desc')->take(5)->get();
    $catalogs = Document::where('status', 1)->inRandomOrder()->take(4)->get();
    $rates = Document::where('status', 1)->orderBy('nUserRated', 'desc')->orderBy('rating', 'desc')->take(5)->get();
    $recents = Document::where('status', 1)->latest('created_at')->take(5)->get();
    $catalogTypes = Category::all();
    // This is where elibrary fetch data from the database
    return view('landing.index', compact('catalogs', 'views', 'rates', 'recents', 'catalogTypes'));
})->name('home');

Route::view('/login', 'pages.login')
    ->name('login');

Route::view('/signup', 'pages.signup')
    ->name('signup');

Route::get('/catalogs', function () {

    return view('pages.catalogs');
})->name('catalogs');

// Routes for registered users with verified emails
Route::middleware(['auth', 'email_verified'])->group(function () {
    Route::get('/profiles/request', [UserController::class, 'requestVerify'])->name('requestEmail');
    Route::get('/profiles/verify', function () {
        return view('pages.account_verify');
    })->name('verify');
    Route::get('/u/submit', function () {
        $types = Category::all();
        return view('pages.account_addCatalog', compact('types'));
    })->name('addCatalog');
});


// Routes for registered users
Route::middleware(['auth'])->group(function () {

    Route::post('/catalogs/c/comments', [CommentsController::class, 'store'])->name('comment');
    Route::post('/profiles/upload', [UserController::class, 'upload']);
    Route::put('account/u/update/{id}', [UserController::class, 'update'])->name('update');
    Route::post('change', [UserController::class, 'changePassword'])->name('changePw');
    Route::post('/request', [Controller::class, 'requestAccess'])->name('req');
    Route::get('/download/{id}', [CatalogController::class, 'dlCounts'])->name('download');

    Route::get('/u/profiles', function () {
        $aff = Affiliation::orderBy('name', 'asc')->get();
        return view('pages.account_profile', compact('aff'));
    })->name('profiles');

    Route::get('/u/dashboard', [UserController::class, 'showDashboard'])
        ->name('dashboard_profiles');

    Route::get('/u/password', function () {
        return view('pages.account_chpass');
    })->name('password');

    Route::resource('/u/profiles/bookmarks', bookmarkController::class);
    Route::delete('/u/profiles/bookmarks/clear/{id}', [BookmarkController::class, 'clearAllBookmarks'])->name('bookmarks.clearAll');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});


// Routes for registered users with admin access
Route::middleware(['checkAccessLevel:2', 'auth'])->group(function () {

    //index dashboard page
    Route::get('/admin/dashboard', [Controller::class, 'index'])->name('index');

    Route::middleware(['checkAccessLevel:3'])->group(function () {
        // Routes accessible to users with access level 3
        // Your routes or controller actions here
        Route::put('/account/{id}/update', [UserController::class, 'updateAdmin'])->name('updateAd');
        Route::get('/users/u/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('/users/u/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/admin /users/search', [UserController::class, 'search'])->name('searchUsers');
        Route::resource('/admin/affiliation', affiliationController::class);
        Route::resource('/admin/catalog/types', catalogTypeController::class);
        Route::get('/admin/catalog/search', [CatalogController::class, 'searchCatalog'])->name('search');
        Route::get('documents/requests', [Controller::class, 'requestAccessIndex'])->name('requests_index');
        Route::put('documents/requests/udpated', [Controller::class, 'setRequests'])->name('setReq');
        Route::get('/emails/verification', [UserController::class, 'verifyIndex'])->name('emails');
        Route::post('/emails/verifying', [UserController::class, 'getVerify'])->name('getVerify');
        Route::get('/appointments', [ApptController::class, 'index'])->name('appointments');
        Route::put('/appointment/update/', [ApptController::class, 'completed'])->name('complete');
        Route::get('appointment/search', [ApptController::class, 'search'])->name('searchAppt');

        //edit profile setting route for admin
        /*  Route::get('/u/edit/{id}', [UserController::class, 'edit'])->name('settings'); */

        //index review page
        Route::get('/admin/review', [ReviewController::class, 'index'])->name('catalogs_review');

        //index users page
        Route::get('/admin/users', [UserController::class, 'index'])->name('users');

        //index affiliations page
        Route::get('/admin/affiliations', [affiliationController::class, 'index'])->name('affiliations');

        //index catalog page
        Route::get('/admin/catalogs', [CatalogController::class, 'index'])->name('catalogs_index');

        //index types page
        Route::get('/admin/types', [catalogTypeController::class, 'index'])->name('types_index');

        // ... other routes for access level 3

    });
    Route::post('/admin/review/g/{code}', [ReviewController::class, 'showPDF'])->name('openPDF');
    Route::put('/admin/review/remarks/{id}', [ReviewController::class, 'remarksAdded'])->name('remarks');
    Route::get('/admin/review', [ReviewController::class, 'index'])->name('catalogs_review');
    Route::get('/admin/review/approves', [ReviewController::class, 'approved'])->name('review_approved');
    Route::get('/admin/review/declines', [ReviewController::class, 'declined'])->name('review_declined');
    Route::get('/admin/review/search', [ReviewController::class, 'search'])->name('searchCatalog');
    Route::post('/admin/review/s/approved/{id}', [ReviewController::class, 'setStatusApproved'])->name('approved');
    Route::post('/admin/review/s/declined/{id}', [ReviewController::class, 'setStatusDeclined'])->name('declined');
});
