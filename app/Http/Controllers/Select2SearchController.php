<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\StokObatModel;
use App\Models\PemakaianObatModel;

class Select2SearchController extends Controller
{
    //
    public function __construct()
    {
        
        $this->Obat      = new StokObatModel();

    }

    public function index()
    {
    	return view('home');
    }

    public function selectSearch(Request $request)
    {
    	$movies = [];

        if($request->has('q')){
            $search = $request->q;
            $movies = $this->Obat->getSobat()
                    ->join('obat','stok_obat.kode_obat','=','obat.id')
            		->where('obat.name', 'LIKE', "%$search%")
                    ->select('obat.name','stok_obat.*')
            		->get();
        }
        return response()->json($movies);
    }

    public function StorePemakianObat(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'cost' => 'required'
         ]);
         
         $count = count($request->task_name);
     
         for ($i=0; $i < $count; $i++) { 
           $task = new PemakaianObatModel();
           $task->task_name = $request->task_name[$i];
           $task->cost = $request->cost[$i];
           $task->save();
         }
     
         return redirect()->back();
    }
}
