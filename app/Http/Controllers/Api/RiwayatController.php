<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RiwayatSN;
use App\SnProduk;
use App\HadiahModel;
use App\RiwRedModel;
// use App\User;

class RiwayatController extends Controller
{
    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }

    public function index(Request $request){
        // dd($request->all());die();
        if($request->has('cari')){
            $riw = RiwayatSN::where('email','LIKE','%'.$request->cari.'%')->get();
        }
        return response()->json([
            'success' => 1,
            'message' => 'Get Serial Number Berhasil',
            'riws' => $sn
        ]);
    }

    public function his_sn(Request $request){ 

        $his = RiwayatSN::where('email','LIKE','%'.$request->his_sn.'%')->orderBy('created_at','desc')->get();

        if($his){
               return response()->json([
               'success' => 1,
               'message' => 'Hasil Riwayat',
            //    'email' => $request->his_sn,
               'riws' => $his
               ]);
        }
        return $this->error('Belum ada history.');
    }

    public function create_his(Request $request){
        // dd($request->all());
        $statusAktif = 'Aktif';
        
        // $sn = SNCashback::where('sn',$request)->first();
        $model = SnProduk::where('sn',$request->sn)->value('model');
        $poin = SnProduk::where('sn',$request->sn)->value('poin');
        $status = SnProduk::where('sn',$request->sn)->value('status');

         if ($status == "Aktif") {
            $create = RiwayatSN::create([
                'sn' => $request->sn,
                'email' => $request->user,
                'model' => $model,
                'poin' => $poin,
            ]);
            SnProduk::where('sn',$request->sn)->update([
                'status' => 'Nonaktif',
            ]);
            if($create){
                return response()->json([
                'success' => 1,
                'message' => 'Success menyimpan riwayat',
                'riws' => $create
                ]);
            } 
         }elseif ($status == "Nonaktif"){
            return response()->json([
                'success' => 1,
                'message' => 'Duplikat Serial Number',
                'sn' => $request->sn
                ]);
         }

         return $this->error('Mohon maaf, SN bukan dari kami.');

        // return redirect()->route('rwtsn');
    }

    public function TotalPoin(Request $request)
    {
        $poinAwal = RiwayatSN::where('email',$request->email)->sum('poin');
        $poinRedeem= RiwRedModel::where('email',$request->email)->sum('jml_poin');
        $sisaPoin = $poinAwal - $poinRedeem;

        if($sisaPoin ==! null){
                        return response()->json([
                        'success' => 1,
                        'message' => 'Total Poin',
                        'Nama User' => $request->email,
                        'TotalPoin' => $sisaPoin
                        ]);
                    }
        elseif ($sisaPoin == null) {
            return response()->json([
            'success' => 1,
            'message' => 'Total Poin',
            'Nama User' => $request->email,
            'TotalPoin' => 0
            ]);            
        }
         return $this->error('Poin Error.');
    }

    public function redeemPoin(Request $request)
    {
        //total poin yang telah di redeem
        $poinRedeem= RiwRedModel::where('email',$request->email)->sum('jml_poin');

        //total poin user
        $totalPoin_user = RiwayatSN::where('email',$request->email)->sum('poin');

        //request poin hadiah
        $req_poinHadiah = HadiahModel::where('name',$request->name)->sum('req_poin');

        //hasil total poin user - poin yang telah di redeem
        $result = $totalPoin_user - $poinRedeem;
        $sisaPoin = $result - $req_poinHadiah;
        $sisaPoin2 = $req_poinHadiah-$result;

        if ($result >= $req_poinHadiah) {
            $riwayatRed = RiwRedModel::create([
                'email'=> $request->email,
                'jml_poin'=> $req_poinHadiah,
                'status'=>'Diproses',
                'nama_hadiah'=>$request->name,
            ]);

            // HadiahModel::where('name',$request->name)->update([
            //     // 'stok' => ,
            // ]);

            if($riwayatRed){
                return response()->json([
                    'success' => 1,
                    'message' => 'Redem Berhasil',
                    'Data' => $riwayatRed,
                    'Poin Awal'=>$totalPoin_user,
                    'sisaPoin' => $sisaPoin
                ]);
            }
        }else{
            return response()->json([
                'error' => 0,
                'message'=>'Mohon maaf, Poin kamu tidak mencukupi.',
                'Nama'=>$request->email,
                'Poin Kamu'=>$result,
                'Poin yang Dibutuhkan'=>$sisaPoin2,
                'Nama Hadiah'=>$request->name,
                'Poin Hadiah'=>$req_poinHadiah
            ]);
        }
        
    }

    public function riwRed(Request $request)
    {
        $riwred = RiwRedModel::where('email',$request->email)->orderBy('created_at','desc')->get();

        if($riwred){
            return response()->json([
            'success' => 1,
            'message' => 'Hasil Riwayat',
            'riwayat' => $riwred
            ]);
     }
     return $this->error('Belum ada history Redeem.');
    }

    public function totalHadiah (Request $request)
    {
        $countHad = RiwRedModel::where('email',$request->email)->count('email');

        if($countHad > 0 || $countHad  ==! null){
            return response()->json([
            'success' => 1,
            'message' => 'Data hadiah '.$request->email.' berhasil diambil',
            'riwayat' => $countHad
            ]);
        }elseif ($countHad == 0 || $countHad == null) {
            return response()->json([
                'success' => 1,
                'message' => 'Belum ada history Redeem',
                'riwayat' => 0
                ]);
        }
        return $this->error('Terjadi kesalahan.');
    }

}
