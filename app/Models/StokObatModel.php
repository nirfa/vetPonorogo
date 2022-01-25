<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StokObatModel extends Model
{
    use HasFactory;

    public function getKobat()
    {
        return DB::table('kode_obat');
    }

    public function getObat()
    {
        return DB::table('obat');
    }

    public function getSobat()
    {
        return DB::table('stok_obat');
    }

    public function getTambahan()
    {
        return DB::table('tambahan_stok');
    }

}
