<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwRedModel extends Model
{
    protected $table = 'riwayat_redeem';
    protected $fillable = [
        'email', 'jml_poin','status','nama_hadiah','create_at'
    ];
}
