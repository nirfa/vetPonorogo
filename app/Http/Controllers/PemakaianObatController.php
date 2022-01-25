<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian_stok;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use Illuminate\Http\Request;

class PemakaianObatController extends Controller
{
    //
    public function __construct()
    {
        $this->Pemakaian = new Pemakaian_stok();
        $this->Penyakit = new PenyakitModel();
        $this->Obat  = new StokObatModel();
    }

    public function index()
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

        return view('pemakaian-obat', ['pemakaian' => $pemakaian]);
    }


    public function storePemakaianObat(Request $request)
    {
        // $request->validate([
        //     'id_stok' => 'required',
        //     'id_status' => 'required',
        //     'jumlah' => 'required'
        //  ]);
        $count = count($request->id_stok);
        for ($i = 0; $i < $count; $i++) {
            $stok = $this->Obat->getSobat()->where('id', $request->id_stok[$i])->first();
            $jumlah = $request->jumlah[$i];
            if ($stok->stok_awal > 0) {
                $stok = $this->Obat->getSobat()->where('id', $request->id_stok[$i])->update([
                    'stok_akhir' => $stok->stok_akhir - $jumlah,
                    'stok_awal' => $stok->stok_awal - $jumlah
                ]);
            } else {
                $stok = $this->Obat->getSobat()->where('id', $request->id_stok[$i])->update([
                    'stok_akhir' => $stok->stok_akhir - $jumlah,
                    'tambahan' => $stok->tambahan - $jumlah
                ]);
            }
        }

        $direct = $request->id_hewan;

        for ($i = 0; $i < $count; $i++) {
            $task = new Pemakaian_stok();
            $task->id_stok = $request->id_stok[$i];
            $task->id_status = $request->id_status[$i];
            $task->jumlah = $request->jumlah[$i];
            $task->save();
        }

        //  for ($i=0; $i < $count; $i++){
        //     $cek = $this->Obat->getSobat()->where('id',$request->id_stok[$])->pluck('stok_akhir');
        //  }


        //  dd($cek);
        return redirect('/detailpasien/' . $request->id_hewan)->with(['success' => 'Data Pemilik Berhasil di Update']);
    }

    public function view($id)
    {
        $penyakit = $this->Penyakit->getData()->where('id', $id)->get();
        return view('tambah-pemakaian-obat', ['penyakit' => $penyakit]);
    }
}
