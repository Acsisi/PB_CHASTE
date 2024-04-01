<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "tenant";
    protected $primaryKey = "tenant_id";
    public $incrementing = true;
    public $timestamps = true;

    public function dimiliki_user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    public function dimiliki_penyewa(){
        return $this->belongsTo('App\Models\User', 'penyewa_id', 'user_id');
    }

    public function memiliki_h_menu(){
        return $this->hasMany('App\Models\H_Menu', 'tenant_id', 'tenant_id');
    }
    public function memiliki_menu(){
        return $this->hasMany('App\Models\Menu', 'tenant_id', 'tenant_id');
    }
    
    public function memiliki_d_tenant(){
        return $this->hasMany('App\Models\D_Tenant', 'tenant_id', 'tenant_id');
    }
}
