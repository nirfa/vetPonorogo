<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PemilikModel extends Model
{
    use HasFactory;

    public function getData()
    {
        return DB::table('pemilik');
    }

    protected $guarded = [];

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',

    ];

}
