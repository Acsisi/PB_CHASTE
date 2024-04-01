<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class D_Bulan extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "d_bulan";
    protected $primaryKey = "d_bulan_id";
    public $incrementing = true;
    public $timestamps = false;

    public function dimiliki_h_bulan(){
        return $this->belongsTo('App\Models\H_Bulan', 'h_bulan_id', 'h_bulan_id');
    }
}
