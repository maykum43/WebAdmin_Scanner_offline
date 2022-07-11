<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HadiahModel;
use App\User;

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

    public function getAll_fcm(Request $request)
    {
        // $hadiahs = HadiahModel::where('status','Aktif')->get();
        // ->where('fcm' != NULL)
        $data_fcm = User::select('fcm')->whereNotNull('fcm')->get();
        // SELECT `fcm` FROM `users` WHERE `fcm` IS NOT NULL
            if($data_fcm == null){
                return $this->error('Data FCM Kosong');
            }else{
            return response()->json([
                'success' => 1,
                'message' => 'Get Data FCM berhasil',
                'Data FCM' => $data_fcm
            ]);
            }
    }

    
}
