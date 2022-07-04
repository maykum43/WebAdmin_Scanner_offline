<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function index(){
    //     return view('customer.data_cust');
    // }
    public function index(Request $request){
        if($request->has('cari_user')){
            $cust = User::where('name','LIKE','%'.$request->cari_user.'%')
                        ->orWhere('email','LIKE','%'.$request->cari_user.'%')
                        ->paginate(10);
        }else{
            $cust = User::where('role','User')->orderBy('created_at','desc')->paginate(10);
        }
        return view('customer.data_cust', compact('cust'));
    }

    public function edit($id){
        $data = User::where('id',$id)->first();
        return view('customer.edit_cust', compact('data'));
    }
    // public function edit($id){
    //     $data = User::where('id',$id)->first();
    //     return view('customer.edit_cust', compact('data'));
    // }

    public function update($id,User $user, Request $request){
        $simpan = $user->where('id',$id)->update([
        // dd($request->all());
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'norek' =>$request->norek,
            'nama_bank' =>$request->nama_bank,
            'atas_nama' =>$request->atas_nama,
            'nama_akun_ol' =>$request->nama_akun_ol,
            'status' =>$request->status,
            'alamat' =>$request->alamat,
        ]);

        if(!$simpan){
            return redirect()->route('customer')->with('error','data gagal di update');
        }
        return redirect()->route('customer')->with('success','data berhasil di update');
    }

    public function softDelete($id, User $user){

        $simpan = $user->where('id',$id)->update([
            'status' => 'Nonaktif',
        ]);

        if(!$simpan){
            return redirect()->route('customer')->with('error','Customer gagal di dinonaktifkan');
        }

        return redirect()->route('customer')->with('success','Customer berhasil dinonaktifkan');
    }

    public function hardDelete($id,User $user){
        $hapus = $user->where('id',$id)->delete();

        if(!$hapus){
            return redirect()->route('customer')->with('error','Data gagal di dihapus');
        }

        return redirect()->route('customer')->with('success','Data berhasil di hapus');
    }

    public function create(){
        return view('customer.create_cust');
    }

    public function simpan(Request $request){

        // dd($request->all());

        $fileName ='';

        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/User/FotoProfil',$fileName);
        }
        $user = User::create(array_merge($request->all(),[
            'password' => bcrypt($request->password),
            'foto' => $fileName
        ]));

        return redirect()->route('customer')->with('success','Data berhasil di simpan');
    }

    public function Approve($id, User $user){
        
        $user_fcm = $user->where('id',$id)->first();
        $simpan = $user->where('id',$id)->update([
            'status' => 'Disetujui',
        ]);

        if(!$simpan){
            return redirect()->route('customer')->with('error','User gagal disetujui');
        }
        $this->pushNotif('Registrasi Akun','Hallo '.$user_fcm->name.'. Permintaan registrasi Disetujui. Mohon login menggunakan akun anda.',$user_fcm->fcm);
        return redirect()->route('customer')->with('success','User berhasil disetujui');
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
