<?php

namespace App\Http\Controllers;

use App\Models\HewanModel;
use App\Models\PemilikModel;
use Illuminate\Http\Request;
use DB;

class HewanController extends Controller
{
    //
    public function __construct()
    {
        $this->Hewan   = new HewanModel();
        $this->Pemilik = new PemilikModel();
    }

    public function index()
    {

        $countries      = DB::table('kategori')->pluck("nama", "id");
        $breed          = DB::table('breed')->get();
        $penyimpanan    = DB::table('no_simpan')->get();
        $pemilik        = DB::table('pemilik')->get();

        // dd($ukuran,$tema);
        return view('tambah-pasien', [
            'countries' => $countries,
            'breed' => $breed,
            'penyimpanan' => $penyimpanan,
            'pemilik' => $pemilik
        ]);
    }

    public function selectSearch(Request $request)
    {
        $movies = [];

        if ($request->has('q')) {
            $search = $request->q;
            $movies = $this->Pemilik->getData()
                ->where('nama', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($movies);
    }

    public function getBreed($id)
    {
        $states = DB::table("breed")->where("id_ktg", $id)->pluck("nama", "id");
        return json_encode($states);
    }

    public function store(Request $request)
    {
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $this->validate($request,[
            'id_pemilik'   => 'required',
            'id_breed'   => 'required',
            'id_simpan'   => 'required',
            'nama'   => 'required',
            'tgl_lahir'   => 'required',
            'umur'   => 'required',
            'jenis_kelamin'   => 'required',
            'ciri_spesifik'   => 'required',

         ],$pesan);

       
        $hewan = $this->Hewan->getData()->insert([
            'id'        => $request->id,
            'id_pemilik' => $request->id_pemilik,
            'id_breed' => $request->id_breed,
            'id_simpan' => $request->id_simpan,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ciri_spesifik' => $request->ciri_spesifik,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),

        ]);


        return redirect('data-pasien')->with(['success' => 'Data Pasien Berhasil di Tambahkan']);
    }

    public function detail($id)
    {
        $countries      = DB::table('kategori')->pluck("nama", "id");
        $breed          = DB::table('breed')->get();
        $penyimpanan    = DB::table('no_simpan')->get();
        $pasien = $this->Hewan->getData()->where('id', $id)->get();

        // dd($pasien);
        return view('edit-pasien', [
            'pasien' => $pasien,
            'countries' => $countries,
            'breed' => $breed,
            'penyimpanan' => $penyimpanan,
        ]);
    }

    public function editPasien(Request $request, $id)
    {

        $pasien = $this->Hewan->getData()->where('id', $id)->update([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ciri_spesifik' => $request->ciri_spesifik,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        return redirect('/detailpasien/' . $id)->with(['success' => 'Data Pasien Berhasil di Update']);
    }

    public function viewTambahJenis()
    {
        $kategori = DB::table('kategori')->get();
       
        return view('tambah-jenisH', ['kategori' => $kategori]);
    }

    public function storeBreed(Request $request)
    {
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $this->validate($request,[
            'id_ktg' => 'required|not_in: 0',
            'nama'   => 'required',

         ],$pesan);

        $breed = DB::table('breed')->insert([
            'id_ktg'    => $request->id_ktg,
            'nama'      => $request->nama,
        ]);

       
        return redirect('tambah-pasien')->with(['success' => 'Jenis ' .$request->nama. ' Berhasil di Tambahkan']);   
    }

    public function storeKategori(Request $request)
    {
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $this->validate($request,[
            'nama' => 'required',
            
         ]);

        $breed = DB::table('kategori')->insert([
            'nama'      => $request->nama,
        ],$pesan);
        return redirect('tambah-jenisH')->with(['success' => 'Kategori ' .$request->nama. ' Berhasil di Tambahkan']);   
    }
}
