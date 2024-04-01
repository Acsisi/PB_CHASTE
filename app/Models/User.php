<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'nama',
        'ktp',
        'foto',
        'role',
        'no_telp',
        'email',
        'status',
    ];

    protected $table = "user";
    protected $primaryKey = "user_id";
    public $incrementing = true;
    public $timestamps = true;

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function memiliki_tenant(){
        return $this->hasMany('App\Models\Tenant', 'user_id', 'user_id');
    }
    public function memiliki_menu(){
        return $this->hasMany('App\Models\Menu', 'user_id', 'user_id');
    }
    public function memiliki_kamar(){
        return $this->hasMany('App\Models\Kamar', 'user_id', 'user_id');
    }

    public function memiliki_tenant_penyewa(){
        return $this->hasOne('App\Models\Tenant', 'penyewa_id', 'user_id');
    }
    public function memiliki_kamar_penyewa(){
        return $this->hasOne('App\Models\Kamar', 'penyewa_id', 'user_id');
    }
    public function memiliki_testimony(){
        return $this->hasOne('App\Models\Testimony', 'customer_id', 'user_id');
    }

    public function memiliki_h_tenant(){
        return $this->hasMany('App\Models\H_Tenant', 'user_id', 'user_id');
    }
    public function memiliki_h_kamar(){
        return $this->hasMany('App\Models\H_Tenant', 'user_id', 'user_id');
    }
    public function memiliki_h_bulan(){
        return $this->hasMany('App\Models\H_Tenant', 'user_id', 'user_id');
    }

    public function memiliki_h_menu_customer(){
        return $this->hasMany('App\Models\H_Menu', 'customer_id', 'user_id');
    }
    public function memiliki_h_tenant_penyewa(){
        return $this->hasMany('App\Models\H_Tenant', 'penyewa_id', 'user_id');
    }
    public function memiliki_h_kamar_penyewa(){
        return $this->hasMany('App\Models\H_Tenant', 'penyewa_id', 'user_id');
    }
}
