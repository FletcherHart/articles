<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\EmailListingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
  return Inertia::render('Admin');
})->name('admin');

Route::get('/error', function () {
    return Inertia::render('Error');
})->name('error');

Route::get('/articles/owned', [ArticleController::class, 'owned'])->name('articles.owned');

Route::resource('articles', ArticleController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::match(['get', 'post'], '/email-list', [EmailListingController::class, 'index'])->name('email-list');
Route::delete('/email-list/{address}', [EmailListingController::class, 'destroy'])->name('email-list.destroy');

Route::get('/email-campaign', [EmailListingController::class, 'send'])->name('email-campaign');
Route::post('/email-campaign', [EmailListingController::class, 'sendEMail'])->name('email-campaign');
Route::post('/subscribe-email', [EmailListingController::class, 'confirmEmail'])->name('subscribe-email');
Route::get('/confirm', [EmailListingController::class, 'store'])->name('confirm-email');

// Route::get('/ui', function() {
//     return Inertia::render('UITestPage');
// })->name('ui');
