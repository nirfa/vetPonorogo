<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemilikModel;
use DB;

class PemilikController extends Controller
{
    //
    public function __construct()
    {
        $this->Pemilik  = new PemilikModel();
    }

    public function store(Request $request){

        $validated = $request->validate([
           'nama'    => 'required',
           'no_hp'   => 'required',
           'alamat'  => 'required',
           
        ]);
        
        $pemilik = $this->Pemilik->getData()->insert([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(),  
          
        ]);
    
    
        return redirect('tambah-pasien')->with('success','Data Pemilik Berhasil di Tambahkan !');
      
    }

    public function detail($id){
        $pemilik = $this->Pemilik->getData()
        ->join('hewan','hewan.id_pemilik','=','pemilik.id')
        ->select('pemilik.*','hewan.id AS id_hewan')
        ->where('pemilik.id',$id)->get();


        return view ('edit-pemilik', ['pemilik'=> $pemilik]);
    }

    public function editPemilik(Request $request){

        $pemilik = $this->Pemilik->getData()->where('id',$request->id)->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        

        return redirect('/detailpasien/'.$request->id_hewan)->with(['success' => 'Data Pemilik Berhasil di Update']);
    }
}
