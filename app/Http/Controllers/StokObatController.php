<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokObatModel;
use DB;
use Sum;

class StokObatController extends Controller
{
    //
    public function __construct()
    {
        $this->Obat  = new StokObatModel();
    }

    public function index()
    {

        $obat = $this->Obat->getSobat()
        ->get();
        return view('stok-obat',['obat' => $obat]);
    }

    public function viewTambah()
    {
        $kode = DB::table('kode_obat')->pluck("name","id");
        return view('tambah-stok-obat',compact('kode'));
    }

    public function getObat($id)    
    {        
        $obat = DB::table("obat")->where("kd_obat",$id)->pluck("name","id");
        return json_encode($obat);
    }

    public function tambah(Request $request)
    {
        $cek      = $this->Obat->getSobat()->where('kode_obat', $request->kode_obat)->get();
        $tanggal = date('Y-m-d');

        if (count($cek) == 0){
            $obat = $this->Obat->getSobat()->insert([
                'id'         => $request->id,
                'kode_obat'  => $request->kode_obat,
                'satuan'     => $request->satuan,
                'stok_awal'  => $request->stok_awal,
                'stok_akhir' => $request->stok_awal,
                "created_at" => $tanggal,
          
            ]);

            return redirect('/stok-obat')->with('toast_warning', 'Data obat sudah ada !');

        }
        
       return redirect('/tambah-stok');
    }


    public function detailtambah($id)
    {
        $obat = $this->Obat->getSobat()
        ->join('obat','stok_obat.kode_obat','=','obat.id')
        ->select('stok_obat.*','obat.name')
        ->where('stok_obat.id',$id)->get();

        return view('tambahan-obat',['obat'=>$obat]);
    }

    public function storeTambahan(Request $request)
    {
       
        $cek        = $this->Obat->getSobat()->where('id',$request->id_stok)->pluck('tambahan');
        
        // dd($cek);
        if ($cek === null){
            $cekobat        = $this->Obat->getSobat()->where('id',$request->id_stok)->get();
            $jumlah         = $request->jumlah;
            $stok_akhir     = $cekobat[0]->stok_akhir;
            $sekarang       = $jumlah + $stok_akhir;             
           
            $updateobat = $this->Obat->getSobat()->where('id',$request->id_stok)->update([
                'tambahan'   => $request->jumlah,
                'stok_akhir' => $sekarang, 
                "updated_at" => $tanggal,
          
            ]);

           
            $obat = $this->Obat->getTambahan()->insert([
                'id'         => $request->id,
                'id_stok'    => $request->id_stok,
                'jumlah'     => $request->jumlah,
                "created_at" =>  \Carbon\Carbon::now(), 
          
            ]);

           

            return redirect('/stok-obat');

        } else {
            $tanggal = date('Y-m-d');
            $cekobat        = $this->Obat->getSobat()->where('id',$request->id_stok)->get();
            $sebelumnya     = $cekobat[0]->tambahan;
            $stok_akhir     = $cekobat[0]->stok_akhir;
            $jumlah         = $request->jumlah;
            $tambah         = $sebelumnya + $jumlah;
            $sekarang       = $jumlah + $stok_akhir;      

            $obat = $this->Obat->getTambahan()->insert([
                'id'         => $request->id,
                'id_stok'    => $request->id_stok,
                'jumlah'     => $request->jumlah,
                "created_at" => $tanggal,
          
            ]);
          
            $tanggal = date('Y-m-d');
            $updateobat = $this->Obat->getSobat()->where('id',$request->id_stok)->update([
                'tambahan'   => $tambah,
                'stok_akhir' => $sekarang, 
                "updated_at" => $tanggal,
          
            ]);
           
            
            return redirect('/stok-obat')->with('toast_warning', 'Data obat sudah ada !');

        }
    }

    public function viewTambahanStok()
    {
        $tambahan = $this->Obat->getTambahan()
            ->join('stok_obat','tambahan_stok.id_stok','=','stok_obat.id')
            ->join('obat','stok_obat.kode_obat','=','obat.id')
            ->orderBy('tambahan_stok.id', 'DESC')
            ->paginate(15);

        return view('tambahan-stok',['tambahan'=>$tambahan]);

    }
    
    public function hapus($id)
    {
        $obat = $this->Obat->getSobat()->where('id',$id)->delete();

        return redirect()->back();
    }

}
