<?php

namespace App\Exports;

use App\Models\Pemakaian_stok;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DataPemakaianObatExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct()
    {
        $this->Pemakaian = new Pemakaian_stok();
        $this->Penyakit = new PenyakitModel();
        $this->Obat  = new StokObatModel();
    }
    public function view(): View
    {
        $pemakaian = $this->Pemakaian->getData()
            ->join('stok_obat', 'pemakaian_stoks.id_stok', '=', 'stok_obat.id')
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->join('status_pasien', 'pemakaian_stoks.id_status', '=', 'status_pasien.id')
            ->join('hewan', 'status_pasien.id_hewan', '=', 'hewan.id')
            ->join('pemilik', 'pemilik.id', '=', 'hewan.id_pemilik')
            ->select('obat.name', 'hewan.nama', 'pemakaian_stoks.*', 'pemilik.alamat')
            ->orderBy('pemakaian_stoks.id', 'DESC')
            ->paginate(15);

        return view('export.data-pemakaian-obat', ['pemakaian' => $pemakaian]);
    }
}
