<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarulang extends Model
{
    use HasFactory;

    protected $table = 'daftarulang';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo('App\User','id_user','id');
    }

}
