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
            $cust = User::orderBy('created_at','desc')->paginate(10);
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
}
