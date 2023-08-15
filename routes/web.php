<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Complaints\ComplaintController;
use App\Http\Controllers\Admin\Complaints\ResponseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RegulationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\ComplaintController as UserComplaintController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\NewsController as UserNewsController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\RegulationController as UserRegulationController;
use Illuminate\Support\Facades\Route;

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

// Route Admin

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Pengaduan

    Route::get('/profile/{slug}', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::resource('complaint', ComplaintController::class);
    Route::post('response', [ResponseController::class, 'store'])->name('response.store');

    // crud regulasi
    Route::resource('regulation', RegulationController::class);

    // crud Berita
    Route::resource('news', NewsController::class);

    // crud Galeri Kegiatan
    Route::resource('galery', GaleryController::class);

    // Akun
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
});


// Route User

Route::get('/', [UserDashboardController::class, 'index'])->name('home');

Route::get('/berita', [UserNewsController::class, 'index'])->name('berita');

Route::get('/berita/{news:slug}', [UserNewsController::class, 'show'])->name('berita.detail');

Route::get('/berita/judul', [UserNewsController::class, 'search'])->name('berita.cari');

Route::get('/profil/{profile}', [UserProfileController::class, 'index'])->name('profil');

Route::get('/regulasi', [UserRegulationController::class, 'index'])->name('regulasi');

Route::get('/bidang/{news:sector}', [UserNewsController::class, 'detailSector'])->name('bidang.detail');

// ROUTE DOWNLOAD PDF 
Route::get('/download/{slug}', [UserRegulationController::class, 'download']);

Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');

Route::get('/pengaduan', [UserComplaintController::class, 'index'])->name('pengaduan');

Route::post('/pengaduan', [UserComplaintController::class, 'store'])->name('pengaduan.store');

Route::get('/pengaduan/{complaint:slug}', [UserComplaintController::class, 'show'])->name('pengaduan.detail');

// ROUTE PEMPROV Gorontalo
Route::get('/gorontalo', function () {
    return redirect()->away('https://gorontaloprov.go.id');
})->name('gorontalo');

// ROUTE PEMKAB Bonebol
Route::get('/bonebol', function () {
    return redirect()->away('https://bonebolangokab.go.id/web');
})->name('bonebol');
