<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class HewanModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;  // You most probably want this too

    public function getData()
    {
        return DB::table('hewan');
    }
}
