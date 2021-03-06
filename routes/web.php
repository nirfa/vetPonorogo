<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Select2SearchController;
use App\Http\Controllers\StokObatController;
use Illuminate\Http\Request;
use App\Models\Pemakaian_stok;
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

Route::view('/', 'index');

Route::middleware(['auth'])->group(function () {
    Route::view('/admin', 'dashboard');
    Route::get('/data-pasien', '\App\Http\Controllers\DataController@index');
    Route::get('/detailpasien/{id}', ['as' => 'detailpasien', 'uses' => '\App\Http\Controllers\DataController@detail']);
    Route::get('/tambah-status/{id}', '\App\Http\Controllers\DataController@viewAdd');
    Route::get('kode/obat/{id}', '\App\Http\Controllers\DataController@getObat');
    Route::get('/ajax-autocomplete-search', 'Select2SearchController@selectSearch');

    Route::get('/penyimpanan/c1', '\App\Http\Controllers\PenyimpananController@indexC1');
    Route::get('/penyimpanan/c2', '\App\Http\Controllers\PenyimpananController@indexC2');
    Route::get('/penyimpanan/c3', '\App\Http\Controllers\PenyimpananController@indexC3');

    Route::post('/submit/penyakit', '\App\Http\Controllers\DataController@store');

    Route::get('/edit/penyakit/{id}', '\App\Http\Controllers\DataController@viewDetail');
    Route::post('/submit/edit-penyakit/{id}', '\App\Http\Controllers\DataController@editPenyakit');
    Route::get('/hapus/penyakit/{id}', '\App\Http\Controllers\DataController@hapusPenyakit');
    Route::get('/detail/pemilik/{id}', '\App\Http\Controllers\PemilikController@detail');
    Route::post('/submit/edit-pemilik', '\App\Http\Controllers\PemilikController@editPemilik');


    Route::view('/penyakit', 'penyakit');
    Route::get('/tambah-pasien', '\App\Http\Controllers\HewanController@index');
    Route::get('/pemilik-search', '\App\Http\Controllers\HewanController@selectSearch');
    Route::post('/submit/pasien', '\App\Http\Controllers\HewanController@store');
    Route::get('/detail/pasien/{id}', '\App\Http\Controllers\HewanController@detail');
    Route::post('/submit/edit-pasien/{id}', '\App\Http\Controllers\HewanController@editPasien');
    Route::get('/kategori/breed/{id}', '\App\Http\Controllers\HewanController@getBreed');


    Route::get('/tambah-jenisH','\App\Http\Controllers\HewanController@viewTambahJenis');
    Route::post('/submit/breed','\App\Http\Controllers\HewanController@storeBreed');
    Route::post('/submit/kategori','\App\Http\Controllers\HewanController@storeKategori');

    Route::post('/submit/pemilik', '\App\Http\Controllers\PemilikController@store');
    Route::view('/tambah-pemilik', 'tambah-pemilik');

    Route::view('/tambah-penyakit', 'tambah-penyakit');

    Route::get('/stok-obat', '\App\Http\Controllers\StokObatController@index');
    Route::get('/tambah-stok', '\App\Http\Controllers\StokObatController@viewTambah');
    Route::get('kode/obat/{id}', '\App\Http\Controllers\StokObatController@getObat');
    Route::post('/tambah/obat', '\App\Http\Controllers\StokObatController@tambah');
    Route::get('/tambahan/obat/{id}', '\App\Http\Controllers\StokObatController@detailtambah');
    Route::post('/tambah/tambahan-obat', '\App\Http\Controllers\StokObatController@storeTambahan');
    Route::get('/tambahan-stok', '\App\Http\Controllers\StokObatController@viewTambahanStok');
    Route::get('/hapus/{id}', '\App\Http\Controllers\StokObatController@hapus');


    Route::get('/pemakaian-obat', '\App\Http\Controllers\PemakaianObatController@index');
    Route::post('/ah', '\App\Http\Controllers\PemakaianObatController@storePemakaianObat');
    Route::get('/tambah/pemakaian-obat/{id}', '\App\Http\Controllers\PemakaianObatController@view');

    Route::get('/keuangan','\App\Http\Controllers\KeuanganController@view');
    Route::post('/cek-keuangan','\App\Http\Controllers\KeuanganController@cek');

    Route::get('/riwayat-transaksi','\App\Http\Controllers\TransaksiController@riwayat');


    Route::get('/search', [Select2SearchController::class, 'index']);
    Route::get('/ajax-autocomplete-search', [Select2SearchController::class, 'selectSearch']);


    Route::get('/ah', function () {
        return view('welcome');
    })->name('task');

    Route::get('file-export/{id}', [DataController::class, 'fileExport'])->name('file-export');
    Route::get('download-pasien', [DataController::class, 'DPasien'])->name('download-pasien');
    Route::get('download-laporan-obat', [DataController::class, 'DLaporanObat'])->name('download-laporan-obat');
    Route::get('reset-stok', [StokObatController::class, 'resetStok'])->name('reset-stok');
    Route::get('download-pemakaian-obat', [DataController::class, 'DPemakaianObat'])->name('download-pemakaian-obat');
    Route::get('download-laporan-keuangan', [DataController::class, 'DKeuangan'])->name('download-laporan-keuangan');

    Route::post('/cek-pemakaian','\App\Http\Controllers\PemakaianObatController@cek');
    Route::post('/cek-tambahanStok','\App\Http\Controllers\StokObatController@cek');

    Route::get('/transaksi/{id}','\App\Http\Controllers\TransaksiController@view');
    Route::post('/submit/transaksi','\App\Http\Controllers\TransaksiController@tambahTransaksi');
    Route::post('/edit/transaksi/{id}','\App\Http\Controllers\TransaksiController@editTransaksi');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
