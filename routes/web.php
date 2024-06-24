<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RaksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\RentsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\Auth\SocialiteController;

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



Auth::routes();


Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/' , [HomeController::class, 'index'])->name('home')->middleware('except-admin');


Route::middleware(['auth', 'only-admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('categories', CategoriesController::class);
    Route::resource('users', UsersController::class);
    Route::get('users-activation', [UsersController::class, 'activation'])->name('user.activation');
    Route::get('activation/{id}', [UsersController::class, 'activate']);
    Route::resource('authors', AuthorsController::class);
    Route::resource('raks', RaksController::class);
    Route::resource('publishers', PublishersController::class);
    Route::resource('books', BooksController::class);
    Route::resource('denda', DendaController::class);
    Route::resource('website', WebController::class);

    
    Route::post('/books/search', [BooksController::class, 'search']);

    Route::get('/download-pdf', [BooksController::class, 'downloadPDF']);

    Route::resource('rents', RentsController::class);
    Route::get('/rents-waiting', [RentsController::class, 'waiting'])->name('rents.waiting');
    Route::get('/rents/{rent}/accept', [RentsController::class, 'accept'])->name('rents.accept');
    Route::get('/rents-return', [RentsController::class, 'returning'])->name('rents.returning');
    Route::post('/rents-back', [RentsController::class, 'back']);


    Route::post('/import-excel-user', [ExcelController::class, 'importExcelUser']);
    Route::post('/import-excel-book', [ExcelController::class, 'importExcelBook']);
    
});

Route::middleware(['auth'])->group(function () {

    Route::get('/book', [HomeController::class, 'listBook'])->middleware('except-admin');
    Route::get('/book/{id}', [HomeController::class, 'book'])->name('book');
    
    Route::get('/profile', [AccountController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [AccountController::class, 'edit'])->name('profile.edit')->middleware('only-active-user');
    Route::put('/profile', [AccountController::class, 'update'])->name('profile.update');
    Route::delete('/account/destroy', [AccountController::class, 'destroy']);

    Route::get('/pinjam/buku/{id}', [AccountController::class, 'pinjam'])->name('pinjam');
    Route::get('/pinjam/buku/{id}/sekarang', [AccountController::class, 'pinjamNow'])->name('pinjam.now');

    Route::get('/pinjamanku', [AccountController::class, 'rents'])->name('rents')->middleware('except-admin');

    Route::get('/pay-fine/{id}', [PaymentController::class, 'payFine'])->name('pay.fine');
    Route::post('/return-fine/{id}', [PaymentController::class, 'returnFine'])->name('return.fine');

    Route::get('/print-card', [AccountController::class, 'printCard']);
    

});

