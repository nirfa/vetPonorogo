<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pemakaian_stok extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getData()
    {
        return DB::table('pemakaian_stoks');
    }

}
