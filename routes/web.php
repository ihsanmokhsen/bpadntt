<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PpidDocumentController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpidController;
use App\Http\Controllers\PublicDataController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'public.index')->name('home');
Route::view('/profil', 'public.profil')->name('profil');
Route::view('/layanan', 'public.layanan')->name('layanan');
Route::get('/ppid', [PpidController::class, 'index'])->name('ppid');
Route::view('/berita', 'public.berita')->name('berita');
Route::view('/pengumuman', 'public.pengumuman')->name('pengumuman');
Route::view('/galeri', 'public.galeri')->name('galeri');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('posts.show');

Route::prefix('api/public')->name('api.public.')->group(function () {
    Route::get('/posts', [PublicDataController::class, 'posts'])->name('posts');
    Route::get('/settings', [PublicDataController::class, 'settings'])->name('settings');
    Route::get('/ppid-documents', [PublicDataController::class, 'ppidDocuments'])->name('ppid-documents');
});

Route::redirect('/index.html', '/', 301);
Route::redirect('/profil.html', '/profil', 301);
Route::redirect('/layanan.html', '/layanan', 301);
Route::redirect('/ppid.html', '/ppid', 301);
Route::redirect('/berita.html', '/berita', 301);
Route::redirect('/pengumuman.html', '/pengumuman', 301);
Route::redirect('/galeri.html', '/galeri', 301);
Route::redirect('/admin.html', '/admin/login', 301);

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('login.store');
});

Route::prefix('admin')->middleware(['auth', 'active-admin'])->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/pengaturan-web', [WebsiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/pengaturan-web', [WebsiteSettingController::class, 'update'])->name('settings.update');
    Route::get('/konten', [PostController::class, 'index'])->name('posts.index');
    Route::get('/konten/tambah', [PostController::class, 'create'])->name('posts.create');
    Route::post('/konten', [PostController::class, 'store'])->name('posts.store');
    Route::get('/konten/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/konten/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/konten/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/ppid-dokumen', [PpidDocumentController::class, 'index'])->name('ppid-documents.index');
    Route::get('/ppid-dokumen/tambah', [PpidDocumentController::class, 'create'])->name('ppid-documents.create');
    Route::post('/ppid-dokumen', [PpidDocumentController::class, 'store'])->name('ppid-documents.store');
    Route::get('/ppid-dokumen/{ppid_document}/edit', [PpidDocumentController::class, 'edit'])->name('ppid-documents.edit');
    Route::put('/ppid-dokumen/{ppid_document}', [PpidDocumentController::class, 'update'])->name('ppid-documents.update');
    Route::delete('/ppid-dokumen/{ppid_document}', [PpidDocumentController::class, 'destroy'])->name('ppid-documents.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
