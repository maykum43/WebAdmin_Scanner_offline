<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnProduk extends Model
{
    protected $table = "sn_produk";
    protected $primaryKey = "id";
    protected $fillable = [
        'sn','model','harga','discount','poin','status'
    ];
    public function sns(){
    	return $this->belongsTo('App\User');
    }
}
