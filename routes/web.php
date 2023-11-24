<?php


use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\bookmarkController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Route;
use App\Models\Catalog;
use App\Models\Bookmark;
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
Route::post('/signup', [RegisterController::class, 'register']);
//Route::post('/catalogs/{id}',[CatalogController::class, 'show']);
Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
Route::resource('/catalogs', CatalogController::class);
Route::post('/bookmark/{id}', [bookmarkController::class, 'addBookmark']);
Route::post('/catalogs/{catalog_id}', [CommentsController::class, 'store']);
Route::post('/profiles/upload', [UserController::class, 'upload']);
Route::post('account/update/{id}', [UserController::class, 'update']);


Route::get('/', function () {
    $catalog = Catalog::inRandomOrder()->take(4)->get();
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

Route::get('/bookmarks', function(){
    $bookmarks = Bookmark::with('catalog')->where('users_id', Auth()->user()->id)->get();
    return view('pages.account_bookmarks', compact('bookmarks'));
})->name('bookmarks')->middleware('auth');

Route::get('/profiles', function () {
    $aff = Affiliation::all();
    return view('pages.account_profile', compact('aff'));
})->name('profiles')->middleware('auth');

Route::get('/catalogs', function () {

    return view('pages.catalogs');
})->name('catalogs');

Route::middleware(['checkAccessLevel:admin'])->group(function () {
    // Your routes or controller actions here
    Route::get('/index', function(){
        $users = User::with('affiliation')->get('*');
        $catalogs = Catalog::all();
        $types = CatalogType::all();
        $affs = Affiliation::all();
        return view('admin.admin_users', compact('users', 'catalogs', 'types', 'affs'));
    })->name('index');
    Route::get('/affiliations', function(){
        $affs = Affiliation::all();
        return view('admin.admin_affiliations', compact('affs'));
    })->name('affiliations');
    Route::get('/catalogs', function(){
        $catalogs = Catalog::with('type')->get('*');
        return view('admin.admin_catalogs', compact('catalogs'));
    })->name('catalog');
});


