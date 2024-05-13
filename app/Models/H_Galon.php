<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class H_Galon extends Model
{
    use HasFactory;

    protected $table = "h_galon";
    protected $primaryKey = "h_galon_id";
    public $incrementing = true;
    public $timestamps = true;
}
