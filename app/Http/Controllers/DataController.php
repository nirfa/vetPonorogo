<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HewanModel;
use App\Models\PenyakitModel;
use App\Models\StokObatModel;
use App\Models\Pemakaian_stok;
use DB;
use Redirect;

use App\Event;
use App\Exports\StokObatExport;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    //
    public function __construct()
    {
        $this->Hewan    = new HewanModel();
        $this->Penyakit = new PenyakitModel();
        $this->Obat     = new StokObatModel();
        $this->Pemakaian = new Pemakaian_stok();
    }

    public function index()
    {

        $data = $this->Hewan->getData()
            ->join('pemilik', 'hewan.id_pemilik', '=', 'pemilik.id')
            ->join('no_simpan', 'hewan.id_simpan', '=', 'no_simpan.id')
            ->join('breed', 'hewan.id_breed', '=', 'breed.id')
            ->join('kategori', 'breed.id_ktg', '=', 'kategori.id')
            ->select(
                'hewan.id AS id_hewan',
                DB::raw('hewan.*'),
                'pemilik.nama AS namaP',
                DB::raw('pemilik.*'),
                'no_simpan.nama AS namaS',
                'breed.nama AS namaB',
                'kategori.nama AS namaK'
            )
            ->orderBy('hewan.id', 'DESC')
            ->paginate(5);

        return view('data-pasien', ['data' => $data]);
    }


    public function detail($id)
    {
        $detail = $this->Hewan->getData()
            ->join('pemilik', 'hewan.id_pemilik', '=', 'pemilik.id')
            ->join('no_simpan', 'hewan.id_simpan', '=', 'no_simpan.id')
            ->join('breed', 'hewan.id_breed', '=', 'breed.id')
            ->join('kategori', 'breed.id_ktg', '=', 'kategori.id')
            ->select(
                'hewan.id AS id_hewan',
                'hewan.nama AS namaH',
                DB::raw('hewan.*'),
                'pemilik.nama As namaP',
                'pemilik.id AS id_pemilik',
                DB::raw('pemilik.*'),
                'no_simpan.nama AS namaS',
                'breed.nama AS namaB',
                'kategori.nama AS namaK'
            )
            ->where('hewan.id', $id)
            ->get();

        $penyakit = $this->Penyakit->getData()->where('id_hewan', $id)->paginate(7);

        return view('penyakit', [
            'detail' => $detail,
            'penyakit' => $penyakit
        ]);
    }

    public function viewAdd($id)
    {
        $detail = $this->Hewan->getData()
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
            ->where('hewan.id', $id)
            ->get();

        $penyakit = $this->Penyakit->getData()->where('id_hewan', $id)->get();


        $kode = DB::table('kode_obat')->pluck("name", "id");

        return view('tambah-penyakit', ['detail' => $detail, 'kode' => $kode]);
    }

    public function getObat($id)
    {
        $obat = DB::table("obat")->where("kd_obat", $id)->pluck("name", "id");
        return json_encode($obat);
    }



    public function store(Request $request)
    {

        $penyakit = $this->Penyakit->getData()->insert([
            'id'        => $request->id,
            'id_hewan' => $request->id_hewan,
            'anamnesa' => $request->anamnesa,
            'hasil_priksa' => $request->hasil_priksa,
            'diagnosa' => $request->diagnosa,
            'terapi' => $request->terapi,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),

        ]);

        $akhir = DB::table('status_pasien')->orderBy('id', 'DESC')->first();
        $direct = $akhir->id;
        // dd($akhir, $direct);
        return redirect('/tambah/pemakaian-obat/' . $direct)->with('success', 'Data Berhasil di Tambahkan ! Silahkan Tambahkan Data Obat Untuk Rekap');
    }

    public function viewDetail($id)
    {
        $penyakit = $this->Penyakit->getData()->where('id', $id)->get();

        return view('edit-penyakit', ['penyakit' => $penyakit]);
    }


    public function editPenyakit(Request $request, $id)
    {

        $penyakit = $this->Penyakit->getData()->where('id', $id)->update([
            'id_hewan' => $request->id_hewan,
            'anamnesa' => $request->anamnesa,
            'hasil_priksa' => $request->hasil_priksa,
            'diagnosa' => $request->diagnosa,
            'terapi' => $request->terapi,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        return Redirect::route('detailpasien', ['id' => $request->id_hewan])->with('message', 'State saved correctly!!!');
    }

    public function hapusPenyakit($id)
    {
        $penyakit = $this->Penyakit->getData()->where('id', $id)->delete();

        return redirect()->back();
    }

    public function selectSearch(Request $request)
    {
        $movies = [];

        if ($request->has('q')) {
            $search = $request->q;
            $movies = $this->Obat->getSobat()
                ->join('obat', 'stok_obat.kode_obat', '=', 'obat.id')
                ->where('obat.name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($movies);
    }

    public function fileExport($id)
    {
        return Excel::download(new StokObatExport($id), 'StokObat.xlsx');
    }
}
