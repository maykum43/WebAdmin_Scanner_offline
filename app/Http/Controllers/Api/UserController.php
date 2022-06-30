<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    public function cari_pelanggan(Request $request) {
        $cust=User::where('id', 'LIKE', '%'.$request->cari_pelanggan.'%') ->orWhere('email', 'LIKE', '%'.$request->cari_pelanggan.'%')->orWhere('name', 'LIKE', '%'.$request->cari_pelanggan.'%') ->get();

        if($cust !==null) {
            return response()->json([ 'success'=> 1,
                'message'=> 'Customer Ditemukan',
                'user'=> $cust]);
        }

        return $this->error('User tidak ditemukan');
    }

    public function login(Request $request) {

        // dd($request->all());die();
        $user=User::where('email', $request->email)->first();
        // Status User
        // $status=User::where('status', $request->status);

        if($user) {
            if(password_verify($request->password, $user->password)) {
                if ($user->status == 'Disetujui') {
                    return response()->json([ 
                        'success'=> 1,
                        'message'=> 'Selamat Datang '.$user->name,
                        // dengan ID : ".$user->id,
                        'user'=> $user
                    ]);    
                }else{
                    return $this->error('Menunggu persetujuan Admin');
                }
            }else{
                return $this->error('Password anda salah');
            }
        }else{
            return $this->error('Email tidak ditemukan ');
        }
    }

    public function register(Request $request) {
        //nama, email,pass
        $validasi = Validator::make($request->all(), [ 
                'name'=>'required',
                'email'=>'required|unique:users',
                'password'=>'required|min:6',
                'alamat'=> 'required',
                'phone'=>'required|unique:users',
                'norek'=>'required|unique:users',
                'nama_bank'=>'required',
                'atas_nama'=>'required',
                'nama_akun_ol'=>'required'
                ]);

        if($validasi->fails()) {
            $val=$validasi->errors()->all();
            return $this->error($val[0]);
        }
            $user=User::create(array_merge($request->all(), [ 'password'=> bcrypt($request->password)]));

            if($user) {
                return response()->json([ 'success'=> 1,
                    'message'=> 'Register Berhasil, menunggu persetujuan Admin',
                    'user'=> $user]);
            }

            return $this->error('Registrasi Gagal');
    }

    public function update(Request $request, $email) {

        $user=User::where('email', $email)->first();

            if($user) {
                $user->update($request->all());
                return response()->json([ 'success'=> 1,
                    'message'=> 'Edit Data Berhasil',
                    'user'=> $user]);
            }

        return $this->error("User tidak ditemukan");
    }

    public function error($pesan) {
        return response()->json([ 'success'=> 0,
            'message'=> $pesan]);
    }
}
