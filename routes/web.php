<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Select2SearchController;
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
    Route::view('/admin','dashboard');
    Route::get('/data-pasien','\App\Http\Controllers\DataController@index');
    Route::get('/detailpasien/{id}', ['as' => 'detailpasien', 'uses' => '\App\Http\Controllers\DataController@detail']);
    Route::get('/tambah-status/{id}','\App\Http\Controllers\DataController@viewAdd');
    Route::get('kode/obat/{id}','\App\Http\Controllers\DataController@getObat');
    Route::get('/ajax-autocomplete-search', 'Select2SearchController@selectSearch');

    Route::get('/penyimpanan/c1','\App\Http\Controllers\PenyimpananController@indexC1');
    Route::get('/penyimpanan/c2','\App\Http\Controllers\PenyimpananController@indexC2');
    Route::get('/penyimpanan/c3','\App\Http\Controllers\PenyimpananController@indexC3');

    Route::post('/submit/penyakit','\App\Http\Controllers\DataController@store');
    
    Route::get('/edit/penyakit/{id}','\App\Http\Controllers\DataController@viewDetail');
    Route::post('/submit/edit-penyakit/{id}','\App\Http\Controllers\DataController@editPenyakit');
    Route::get('/hapus/penyakit/{id}','\App\Http\Controllers\DataController@hapusPenyakit');
    Route::get('/detail/pemilik/{id}','\App\Http\Controllers\PemilikController@detail');
    Route::post('/submit/edit-pemilik','\App\Http\Controllers\PemilikController@editPemilik');
    
    
    Route::view('/penyakit','penyakit');
    Route::get('/tambah-pasien','\App\Http\Controllers\HewanController@index');
    Route::get('/pemilik-search', '\App\Http\Controllers\HewanController@selectSearch');
    Route::post('/submit/pasien','\App\Http\Controllers\HewanController@store');
    Route::get('/detail/pasien/{id}','\App\Http\Controllers\HewanController@detail');
    Route::post('/submit/edit-pasien/{id}','\App\Http\Controllers\HewanController@editPasien');
    Route::get('/kategori/breed/{id}','\App\Http\Controllers\HewanController@getBreed');
    Route::post('/submit/pemilik','\App\Http\Controllers\PemilikController@store');
    Route::view('/tambah-pemilik','tambah-pemilik');
    
    Route::view('/tambah-penyakit','tambah-penyakit');

    Route::get('/stok-obat','\App\Http\Controllers\StokObatController@index');
    Route::get('/tambah-stok','\App\Http\Controllers\StokObatController@viewTambah');
    Route::get('kode/obat/{id}','\App\Http\Controllers\StokObatController@getObat');
    Route::post('/tambah/obat','\App\Http\Controllers\StokObatController@tambah');
    Route::get('/tambahan/obat/{id}','\App\Http\Controllers\StokObatController@detailtambah');
    Route::post('/tambah/tambahan-obat','\App\Http\Controllers\StokObatController@storeTambahan');
    Route::get('/tambahan-stok','\App\Http\Controllers\StokObatController@viewTambahanStok');
    Route::get('/hapus/{id}','\App\Http\Controllers\StokObatController@hapus');


    Route::get('/pemakaian-obat','\App\Http\Controllers\PemakaianObatController@index');
    Route::post('/ah','\App\Http\Controllers\PemakaianObatController@storePemakaianObat');
    Route::get('/tambah/pemakaian-obat/{id}','\App\Http\Controllers\PemakaianObatController@view');


    Route::get('/search', [Select2SearchController::class, 'index']);
    Route::get('/ajax-autocomplete-search', [Select2SearchController::class, 'selectSearch']);


    Route::get('/ah', function () {
        return view('welcome');
    })->name('task');
   


});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



