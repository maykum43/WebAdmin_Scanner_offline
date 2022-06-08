<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'id','judul','foto','status','created_at','kategori','ket'
    ];
}
