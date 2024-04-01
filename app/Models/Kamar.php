<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kamar extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "kamar";
    protected $primaryKey = "kamar_id";
    public $incrementing = true;
    public $timestamps = true;

    public function dimiliki_user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    public function dimiliki_penyewa(){
        return $this->belongsTo('App\Models\User', 'penyewa_id', 'user_id');
    }

    public function memiliki_d_kamar(){
        return $this->hasMany('App\Models\D_Kamar', 'kamar_id', 'kamar_id');
    }
}
