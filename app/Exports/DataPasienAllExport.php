<?php

namespace App\Exports;

use App\Models\HewanModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DataPasienAllExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
        $this->Hewan    = new HewanModel();
    }
    public function view(): View
    {
        $data = $this->Hewan->getData()
        ->join('pemilik', 'hewan.id_pemilik', '=', 'pemilik.id')
        ->join('no_simpan', 'hewan.id_simpan', '=', 'no_simpan.id')
        ->join('breed', 'hewan.id_breed', '=', 'breed.id')
        ->join('kategori', 'breed.id_ktg', '=', 'kategori.id')
        ->select(
            'hewan.id AS id_hewan',
            DB::raw('hewan.*'),
            'pemilik.nama AS namaP',
            DB::raw('pemilik.*'),
            'no_simpan.nama AS namaS',
            'breed.nama AS namaB',
            'kategori.nama AS namaK'
        )
        ->orderBy('hewan.id', 'DESC')->get();
        return view('export.data-pasien', ['data' => $data]);
    }
}
