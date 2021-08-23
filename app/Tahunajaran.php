<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunajaran extends Model
{
    use HasFactory;

    protected $table = 'tahunajaran';
    protected $guarded = ['id'];
}
