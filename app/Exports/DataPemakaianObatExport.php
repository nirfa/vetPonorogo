<?php

namespace App\Exports;

use App\Models\Pemakaian_stok;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use Carbon\Carbon;
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
        // $pemakaian = $this->Pemakaian->getData()
        //     ->join('stok_obat', 'pemakaian_stoks.id_stok', '=', 'stok_obat.id')
        //     ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
        //     ->join('status_pasien', 'pemakaian_stoks.id_status', '=', 'status_pasien.id')
        //     ->join('hewan', 'status_pasien.id_hewan', '=', 'hewan.id')
        //     ->join('pemilik', 'pemilik.id', '=', 'hewan.id_pemilik')
        //     ->select('obat.*', 'hewan.*', 'pemakaian_stoks.*', 'pemilik.*', 'obat.id as kodeObat')
        //     ->orderBy('pemakaian_stoks.id', 'DESC')
        //     ->get();
        $obat = $this->Obat->getSobat()
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('stok_obat.*', 'obat.name')
            ->get();
        foreach ($obat as $obats) {
            $pemakaian = $this->Pemakaian->getData()
                ->where('id_stok', $obats->id)
                ->get();
            $tgl = '';
            foreach ($pemakaian as $pemakaians) {
                $created = $pemakaians->created_at;
                $tgl = $tgl . Carbon::parse($created)->format('d') . ', ';
            }
            $total = 0;
            foreach ($pemakaian as $jumlahs) {
                $total = $total + $jumlahs->jumlah;
            }
            $obats->tanggal = $tgl;
            $obats->total = $total;
            $obats->harga_total = $total * $obats->harga_dasar;
        }
        return view('export.data-pemakaian-obat', ['pemakaian' => $obat]);
    }
}
