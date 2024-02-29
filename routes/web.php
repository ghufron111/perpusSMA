<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Str;


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

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/buku', [BookController::class, 'index'])->name('admin.buku');
    Route::get('/buku/tambah/baru', [BookController::class, 'form_tambah'])->name('admin.tambahbuku');
    Route::get('/buku/tambah/genre', [BookController::class, 'form_genre'])->name('admin.genrebuku');
    Route::post('/buku/tambah/tambah_genre', [BookController::class, 'tambah_genre'])->name('tambah_genre');
    Route::post('/buku/tambah', [BookController::class, 'tambahBuku'])->middleware('auth');
    Route::get('/anggota', [UserController::class, 'anggota'])->name('anggota');
    Route::get('/buku/hapus/{id}', [BookController::class, 'hapus']);
    Route::get('/buku/ubah/{id}', [BookController::class, 'ubah']);
    Route::post('/buku/ubah/{id}', [BookController::class, 'edit'])->name('ubah.buku');

    Route::get('/anggota/active/{id}', [UserController::class, 'anggota_active']);
    Route::get('/anggota/inactive/{id}', [UserController::class, 'anggota_inactive']);
    Route::get('/anggota/hapus/{id}', [UserController::class, 'anggota_hapus']);
    Route::get('/anggota/ubah/{id}', [UserController::class, 'anggota_ubah']);
    Route::post('/anggota/ubah/{id}', [UserController::class, 'action_ubah']);
    Route::get('/anggota/tambah', [UserController::class, 'anggota_tambah']);
    Route::post('/anggota/tambah/baru', [UserController::class, 'anggota_tambah_baru']);

    Route::get('/pinjam', [RentController::class, 'pinjam_admin'])->name('admin.pinjam');
    Route::get('/pinjam/tambah', [RentController::class, 'pinjam_buku_tambah'])->name('admin.pinjam.buku');
    Route::post('/pinjam/tambah/baru', [RentController::class, 'pinjam_buku_tambah_baru'])->name('admin.pinjam.buku.baru');
    Route::get('/pinjam/kembali/{id}', [RentController::class, 'admin_kembali_buku'])->name('admin.pinjam.buku.kembali');
    Route::get('/pinjam/hapus/{id}', [RentController::class, 'admin_pinjam_hapus'])->name('admin.pinjam.buku.hapus');

    Route::get('/laporan',  [RentController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/cetak',  [RentController::class, 'laporan_cetak'])->name('laporan.cetak');
    Route::post('/laporan/filter',  [RentController::class, 'laporan_filter'])->name('laporan.filter');
    Route::get('/laporan/filter/cetak', [RentController::class, 'laporan_filter_cetak'])->name('laporan.filter.cetak');

    
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/siswa', [UserController::class, 'index'])->name('client.dashboard');

    Route::get('/buku/novel', [BookController::class, 'novel'])->name('client.novel');
    Route::get('/buku/majalah', [BookController::class, 'majalah'])->name('client.majalah');
    Route::get('/buku/paket', [BookController::class, 'paket'])->name('client.paket');
    Route::get('/buku/preview/{id}', [BookController::class, 'preview'])->name('client.preview');

    Route::get('/pinjambuku', [RentController::class, 'pinjambuku'])->name('client.pinjam');
    Route::post('/buku/pinjam/{id}', [RentController::class, 'pinjam_buku'])->name('client.pinjam.buku');
    Route::post('/pinjambuku/kembali/{id}', [RentController::class, 'kembali_buku'])->name('client.kembali.buku');
    Route::get('/pinjambuku/hapus', [RentController::class, 'hapus_histori_buku'])->name('client.hapus.buku');

    Route::get('{file_path}', [BookController::class, 'baca']);
});

Route::middleware('only_guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'tambahakun']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


