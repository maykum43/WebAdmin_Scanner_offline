<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'id','judul','foto','status','created_at','kategori','ket'
    ];
}
