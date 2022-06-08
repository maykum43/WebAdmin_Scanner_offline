<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class RiwayatSN extends Model
{
    // use HasFactory;
    
    protected $table = "riwayat_sn";
    protected $primaryKey = "id_rwt";
    protected $foreignKey = "sn";
    protected $fillable = [
        'id_rwt','sn','model','poin','email','status','created_at'
    ]; 
    public function rwt_sns(){
    	return $this->hasMany('App\SnProduk');
    }

    public function rwt_user(){
        return $this->hasMany('App\User');
    }
}
