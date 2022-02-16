<?php

namespace App\Http\Controllers;
use App\Models\Pemakaian_stok;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use Illuminate\Http\Request;

use App\Models\TransaksiModel;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->transaksi  = new TransaksiModel();
        $this->Pemakaian = new Pemakaian_stok();
        $this->Penyakit = new PenyakitModel();
        $this->Obat  = new StokObatModel();
    }

    public function view($id)
    {
        $transaksi = $this->transaksi->getData()->where('id_status',$id)->get();
        
        return view('transaksi', ['data' => $transaksi]);
    }

    public function tambahTransaksi(Request $request)
    {
        // dd($request->id_status,$request->id_statusT);
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $request->validate([
            'id_stok' => 'required',
            'id_status' => 'required',
            'jumlah' => 'required'
         ],$pesan);

        $count = count($request->id_stok);

        for ($i = 0; $i < $count; $i++) {
            $stok = $this->Obat->getSobat()->where('id', $request->id_stok[$i])->first();
            $jumlah = $request->jumlah[$i];
            if ($stok->stok_awal > 0) {
                $stok = $this->Obat->getSobat()->where('id', $request->id_stok[$i])->update([
                    'stok_akhir' => $stok->stok_akhir - $jumlah,
                  
                ]);
            } 
        }       
       
        for ($i = 0; $i < $count; $i++) {
            $task = new Pemakaian_stok();
            $task->id_stok = $request->id_stok[$i];
            $task->id_status = $request->id_status[$i];
            $task->jumlah = $request->jumlah[$i];
            $task->save();
            // dd($task);
        }
       
        
       
     
        $transaksi = $this->transaksi->getData()->insert([
            'id_status'     => $request->id_statusT,
            'id_hewan'      => $request->id_hewan,
            'harga_terapan' => $request->harga_total,
            "created_at"    =>  \Carbon\Carbon::now(), 
        ]);
    
       
        return redirect('/transaksi/'.$request->id_statusT);
    }

    public function editTransaksi(Request $request, $id)
    {
        $perolehan = $request->pendaftaran + 
                     $request->periksa + 
                     $request->injeksi + 
                     $request->peroral + 
                     $request->bahan_medis + 
                     $request->rawat_inap + 
                     $request->sewa_kandang + 
                     $request->kateterisasi + 
                     $request->lainnya;
        if($request->peroral > 0){
            $peroralJ = 5000;
            $peroralA = 10000;
        } else{
            $peroralJ = 0;
            $peroralA = 0;
        }

        if($request->kateterisasi >= 380000){
            $kateteJ = 300000;
            $kateteA = 80000;
        } else if ($request->kateterisasi == 370000){
            $kateteJ = 300000;
            $kateteA = 70000;
        } else {
            $kateteJ = 0;
            $kateteA = 0;
        }

        $jasa       = $request->periksa + $peroralJ +   $request->rawat_inap + $kateteJ;
        $alat_obat  = $request->pendaftaran +   $request->injeksi + $peroralA +    $request->bahan_medis +   $request->sewa_kandang + $kateteA;

        $harga_terapan = $this->transaksi->getData()->select('harga_terapan')->where('id_status',$id)->get();
        $laba = $perolehan - $jasa - $harga_terapan[0]->harga_terapan;

        $this->transaksi->getData()
            ->where('id_status', $id)
            ->update([
                'pendaftaran' => $request->pendaftaran,
                'periksa'     => $request->periksa,
                'injeksi'     => $request->injeksi,
                'peroral'     => $request->peroral,
                'bahan_medis' => $request->bahan_medis,
                'rawat_inap'  => $request->rawat_inap,
                'sewa_kandang'=> $request->sewa_kandang,
                'kateterisasi'=> $request->kateterisasi,
                'lainnya'     => $request->lainnya,
                'keterangan'  => $request->ciri_spesifik,
                'perolehan'   => $perolehan,
                'jasa'        => $jasa,
                'alat_obat'   => $alat_obat,
                'laba'        => $laba,

            ]);
    
        // dd($harga_terapan);
        return redirect('/transaksi/'.$id);
    }


    public function riwayat()
    {
        $transaksi = $this->transaksi->getData()
                    ->join('hewan','hewan.id','=','transaksi.id_hewan')
                    ->join('breed', 'hewan.id_breed', '=', 'breed.id')
                    ->join('kategori', 'breed.id_ktg', '=', 'kategori.id')
                    ->select('hewan.*','transaksi.*','kategori.nama AS namaK')
                    ->get();

        
        return view('riwayat-transaksi', ['transaksi' => $transaksi]);
    }
}
