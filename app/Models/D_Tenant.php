<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class D_Tenant extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "d_tenant";
    protected $primaryKey = "d_tenant_id";
    public $incrementing = true;
    public $timestamps = false;

    public function dimiliki_h_tenant(){
        return $this->belongsTo('App\Models\H_Tenant', 'h_tenant_id', 'h_tenant_id');
    }

    public function dimiliki_tenant(){
        return $this->belongsTo('App\Models\Tenant', 'tenant_id', 'tenant_id');
    }
}
