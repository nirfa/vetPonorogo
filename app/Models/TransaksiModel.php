<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TransaksiModel extends Model
{
    use HasFactory;

    public function getData()
    {
        return DB::table('transaksi');
    }

}
