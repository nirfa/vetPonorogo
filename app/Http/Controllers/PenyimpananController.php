<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HewanModel;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use App\Models\Pemakaian_stok;
use DB;
use Redirect;

class PenyimpananController extends Controller
{
    //
    public function __construct()
    {
        $this->Hewan    = new HewanModel();
        $this->Penyakit = new PenyakitModel(); 
        $this->Obat     = new StokObatModel();
        $this->Pemakaian= new Pemakaian_stok();
    }

    public function indexC1(){
       
        $data = $this->Hewan->getData()
        ->join('pemilik','hewan.id_pemilik','=','pemilik.id')
        ->join('no_simpan','hewan.id_simpan','=','no_simpan.id')
        ->join('breed','hewan.id_breed','=','breed.id')
        ->join('kategori','breed.id_ktg','=','kategori.id')
        ->select('hewan.id AS id_hewan', DB::raw( 'hewan.*' ),
                 'pemilik.nama AS namaP', DB::raw( 'pemilik.*' ),
                 'no_simpan.nama AS namaS',
                 'breed.nama AS namaB',
                 'kategori.nama AS namaK')
        ->where('no_simpan.id',1)
        ->orderBy('hewan.id', 'DESC')
        ->paginate(10);

        return view ('data-pasien1',['data' => $data]);
    }

    public function indexC2(){
       
        $data = $this->Hewan->getData()
        ->join('pemilik','hewan.id_pemilik','=','pemilik.id')
        ->join('no_simpan','hewan.id_simpan','=','no_simpan.id')
        ->join('breed','hewan.id_breed','=','breed.id')
        ->join('kategori','breed.id_ktg','=','kategori.id')
        ->select('hewan.id AS id_hewan', DB::raw( 'hewan.*' ),
                 'pemilik.nama AS namaP', DB::raw( 'pemilik.*' ),
                 'no_simpan.nama AS namaS',
                 'breed.nama AS namaB',
                 'kategori.nama AS namaK')
        ->where('no_simpan.id',2)
        ->orderBy('hewan.id', 'DESC')
        ->paginate(10);

        return view ('data-pasien2',['data' => $data]);
    }

    public function indexC3(){
       
        $data = $this->Hewan->getData()
        ->join('pemilik','hewan.id_pemilik','=','pemilik.id')
        ->join('no_simpan','hewan.id_simpan','=','no_simpan.id')
        ->join('breed','hewan.id_breed','=','breed.id')
        ->join('kategori','breed.id_ktg','=','kategori.id')
        ->select('hewan.id AS id_hewan', DB::raw( 'hewan.*' ),
                 'pemilik.nama AS namaP', DB::raw( 'pemilik.*' ),
                 'no_simpan.nama AS namaS',
                 'breed.nama AS namaB',
                 'kategori.nama AS namaK')
        ->where('no_simpan.id',3)
        ->orderBy('hewan.id', 'DESC')
        ->paginate(10);

        return view ('data-pasien3',['data' => $data]);
    }


}
