<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pemakaian_stok;
use App\Models\StokObatModel;
use DB;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->Obat  = new StokObatModel();
        $this->pemakaian  = new Pemakaian_stok();
    }

    public function view()
    {
        $obat = $this->Obat->getSobat()
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('stok_obat.*', 'obat.name')
            ->get();
        foreach ($obat as $obats) {

            $jumlah = $this->Obat->getSobat()
                ->join('pemakaian_stoks', 'stok_obat.id', '=', 'pemakaian_stoks.id_stok')
                ->select('pemakaian_stoks.jumlah')
                ->where('stok_obat.id', $obats->id)
                ->get();
            $total = 0;
            foreach ($jumlah as $jumlahs) {
                $total = $total + $jumlahs->jumlah;
            }
            $obats->jumlah_pemakaian = $total;
            $obats->harga_terpakai = $total * $obats->harga_dasar;
        }

        return view('keuangan', ['data' => $obat]);
    }

    public function cek(Request $request)
    {
        $dari   = $request->tgl_mulai;
        $ke     = $request->tgl_selesai;

        $obat = $this->Obat->getSobat()
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->join('pemakaian_stoks', 'stok_obat.id', '=', 'pemakaian_stoks.id_stok')
            ->select('stok_obat.*', 'obat.name')
            ->whereBetween(DB::raw('DATE(pemakaian_stoks.created_at)'), [$dari, $ke])
            ->get();

        foreach ($obat as $obats) {

            $jumlah = $this->Obat->getSobat()
                ->join('pemakaian_stoks', 'stok_obat.id', '=', 'pemakaian_stoks.id_stok')
                ->select('pemakaian_stoks.jumlah')
                ->where('stok_obat.id', $obats->id)
                ->get();
            $total = 0;
            foreach ($jumlah as $jumlahs) {
                $total = $total + $jumlahs->jumlah;
            }
            $obats->jumlah_pemakaian = $total;
            $obats->harga_terpakai = $total * $obats->harga_dasar;
        }

        return view('keuangan', ['data' => $obat]);

    }
}
