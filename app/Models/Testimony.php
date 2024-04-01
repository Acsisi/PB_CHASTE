<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimony extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "testimony";
    protected $primaryKey = "testimony_id";
    public $incrementing = true;
    public $timestamps = true;

    public function dimiliki_customer(){
        return $this->belongsTo('App\Models\User', 'customer_id', 'user_id');
    }
}
