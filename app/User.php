<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'nama_lengkap', 'email', 'password','role','nis'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan','id_jurusan','id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas','id');
    }

    public function tahunajaran()
    {
        return $this->belongsTo('App\Tahunajaran','id_tahunajaran','id');
    }
}
