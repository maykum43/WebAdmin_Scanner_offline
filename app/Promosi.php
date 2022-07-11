<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    protected $table = "promosis";
    protected $fillable = [
        'id_promosi', 'judul','status','ket','kategori','created_at','foto'
    ];
}
