<?php

namespace App\Exports;

use App\Models\HewanModel;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class StokObatExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $id)
    {
        $this->Hewan    = new HewanModel();
        $this->id       = $id;
        $this->Penyakit = new PenyakitModel();
    }

    public function view(): View
    {
        $penyakit = $this->Penyakit->getData()->where('id_hewan', $this->id)->get();
        $data = $this->Hewan->getData()
        ->join('pemilik', 'hewan.id_pemilik', '=', 'pemilik.id')
        ->join('no_simpan', 'hewan.id_simpan', '=', 'no_simpan.id')
        ->join('breed', 'hewan.id_breed', '=', 'breed.id')
        ->join('kategori', 'breed.id_ktg', '=', 'kategori.id')
        ->select(
            'hewan.nama AS namaH',
            'hewan.id AS id_hewan',
            DB::raw('hewan.*'),
            'pemilik.nama As namaP',
            DB::raw('pemilik.*'),
            'no_simpan.nama AS namaS',
            'breed.nama AS namaB',
            'kategori.nama AS namaK'
        )
        ->where('hewan.id', $this->id)
        ->get();
        return view('export', ['data' => $data, 'penyakit' => $penyakit]);
    }
}
