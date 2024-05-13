<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class H_Galon extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "h_galon";
    protected $primaryKey = "h_galon_id";
    public $incrementing = true;
    public $timestamps = true;

    public function dimiliki_penyewa(){
        return $this->belongsTo('App\Models\User', 'penyewa_id', 'user_id');
    }
}
