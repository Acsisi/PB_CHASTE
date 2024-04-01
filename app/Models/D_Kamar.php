<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class D_Kamar extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "d_kamar";
    protected $primaryKey = "d_kamar_id";
    public $incrementing = true;
    public $timestamps = false;

    public function dimiliki_h_kamar(){
        return $this->belongsTo('App\Models\H_Kamar', 'h_kamar_id', 'h_kamar_id');
    }

    public function dimiliki_kamar(){
        return $this->belongsTo('App\Models\Kamar', 'kamar_id', 'kamar_id');
    }
}
