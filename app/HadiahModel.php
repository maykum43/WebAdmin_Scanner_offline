<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HadiahModel extends Model
{
    protected $fillable = [
        'name', 'req_poin','foto','status','stok',
    ];
}
