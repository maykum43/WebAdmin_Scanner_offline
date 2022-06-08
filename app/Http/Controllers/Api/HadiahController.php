<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HadiahModel;

class HadiahController extends Controller
{
    public function listHadiah()
    {
        $hadiahs = HadiahModel::where('status','Aktif')->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Data Hadiah berhasil',
            'hadiahs' => $hadiahs
        ]);
    }

    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }

    public function cariHadiah(Request $request)
    {
        // 'req_poin'
        $req_poinHadiah = HadiahModel::where('name',$request->name)->sum('req_poin');
        
        if($req_poinHadiah == null){
            return $this->error('Hadiah tidak ditemukan');
        }else{
            return response()->json([
                'success' => 1,
                'message' => 'Get Data Hadiah berhasil',
                'nama Hadiah' => $request->name,
                'req_poin' => $req_poinHadiah
            ]);
        }
    }
}
