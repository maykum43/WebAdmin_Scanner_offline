<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','nama','email','notlp','alamat','norek','nm_bank','nm_akun_ol'
    ];

}
