<?php

namespace App\Http\Controllers;

use App\Exports\StokObatExport;
use Illuminate\Http\Request;
use App\Models\StokObatModel;
use DB;
use Maatwebsite\Excel\Facades\Excel;
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
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('stok_obat.*', 'obat.name')
            ->get();
        return view('stok-obat', ['obat' => $obat]);
    }

    public function viewTambah()
    {
        $kode = DB::table('kode_obat')->pluck("name", "id");
        return view('tambah-stok-obat', compact('kode'));
    }

    public function getObat($id)
    {
        $obat = DB::table("obat")->where("kd_obat", $id)->pluck("name", "id");
        return json_encode($obat);
    }

    public function tambah(Request $request)
    {
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $this->validate($request, [
            'kode'          => 'required',
            'kode_obat'     => 'required',
            'satuan'        => 'required|not_in:0',
            'stok_awal'     => 'required',
            'harga_dasar'   => 'required',


        ], $pesan);

        $cek      = $this->Obat->getSobat()->where('kode_obat', $request->kode_obat)->get();
        $tanggal = date('Y-m-d');

        if (count($cek) == 0) {
            $obat = $this->Obat->getSobat()->insert([
                'id'         => $request->id,
                'kode_obat'  => $request->kode_obat,
                'satuan'     => $request->satuan,
                'stok_awal'  => $request->stok_awal,
                'harga_dasar'  => $request->harga_dasar,
                'stok_akhir' => $request->stok_awal,
                "created_at" => $tanggal,

            ]);

            return redirect('/stok-obat')->with('toast_warning', 'Data obat sudah ada !');
        }


        return redirect('/tambah-stok')->with(['success' => 'Obat ' . $request->kode_obat . ' berhasil ditambahkan']);
    }


    public function detailtambah($id)
    {
        $obat = $this->Obat->getSobat()
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('stok_obat.*', 'obat.name')
            ->where('stok_obat.id', $id)->get();

        return view('tambahan-obat', ['obat' => $obat]);
    }

    public function storeTambahan(Request $request)
    {
        $pesan = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi minimal :min karakter !',
            'max' => ':attribute harus diisi maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka !',
        ];

        $this->validate($request, [
            'jumlah'     => 'required',

        ], $pesan);

        $cek        = $this->Obat->getSobat()->where('id', $request->id_stok)->pluck('tambahan');

        // dd($cek);
        if ($cek === null) {
            $cekobat        = $this->Obat->getSobat()->where('id', $request->id_stok)->get();
            $jumlah         = $request->jumlah;
            $stok_akhir     = $cekobat[0]->stok_akhir;
            $sekarang       = $jumlah + $stok_akhir;

            $updateobat = $this->Obat->getSobat()->where('id', $request->id_stok)->update([
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
            $cekobat        = $this->Obat->getSobat()->where('id', $request->id_stok)->get();
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
            $updateobat = $this->Obat->getSobat()->where('id', $request->id_stok)->update([
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
            ->join('stok_obat', 'tambahan_stok.id_stok', '=', 'stok_obat.id')
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('obat.name', 'tambahan_stok.*')
            ->orderBy('tambahan_stok.id', 'DESC')
            ->paginate(15);

        return view('tambahan-stok', ['tambahan' => $tambahan]);
    }

    public function hapus($id)
    {
        $obat = $this->Obat->getSobat()->where('id', $id)->delete();

        return redirect()->back();
    }

    public function resetStok()
    {
        $obat = $this->Obat->getSobat()->get();
        $tanggal = date('Y-m-d');
        foreach ($obat as $obats) {
            $this->Obat->getSobat()->where('id', $obats->id)->update([
                'tambahan'   => 0,
                'stok_awal' => $obats->stok_akhir,
                "updated_at" => $tanggal,
            ]);
        }
        return redirect()->back();
    }

    public function cek(Request $request)
    {
        $dari   = $request->tgl_mulai;
        $ke     = $request->tgl_selesai;


        $tambahan = $this->Obat->getTambahan()
            ->join('stok_obat', 'tambahan_stok.id_stok', '=', 'stok_obat.id')
            ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
            ->select('obat.name', 'tambahan_stok.*')
            ->whereBetween(DB::raw('DATE(tambahan_stok.created_at)'), [$dari, $ke])
            ->orderBy('tambahan_stok.id', 'DESC')
            ->get();

        return view('tambahan-stok', ['tambahan' => $tambahan]);
    }
}
