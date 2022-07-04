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
                    $user->update([
                        'fcm' => $request->fcm
                    ]);

                    return response()->json([ 
                        'success'=> 1,
                        'message'=> 'Selamat Datang '.$user->name,
                        // dengan ID : ".$user->id,
                        'user'=> $user
                    ]);    
                }else{
                    return $this->error('Menunggu persetujuan Admin');
                    $user->update([
                        'fcm' => $request->fcm
                    ]);
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
                $this->pushNotif('Registrasi Akun','Permintaan registrasi diproses. Mohon menunggu persetujuan admin.',$user->fcm);
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

    public function pushNotif($title, $message, $mFcm) {
        // $title, $message
        // Request $request

        // $mData = [
        //     'title' => $request->title,
        //     'body' => $request->message
        // ];

        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mFcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAA3Zm8IwE:APA91bGc8VfDQa1ccXE_uqYR--6gyTZMK2gtMK6lcQdmm4ipt86S-fLQvcQhPFt46qBMiu4wm3THdAP-p4F9wPxcn5diJ1pS8_aY5-wp8kb3dwYDQsUEdKfVf4T9fzKIgs2ZMuHYneYt"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }
}
