<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class H_Bulan extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "h_bulan";
    protected $primaryKey = "h_bulan_id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['user_id', 'keterangan', 'total','status'];

    public function memiliki_d_bulan(){
        return $this->hasMany('App\Models\D_Bulan', 'h_bulan_id', 'h_bulan_id');
    }

    public function dimiliki_user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
}
