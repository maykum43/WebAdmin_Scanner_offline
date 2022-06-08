<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\SnProduk;
use App\Imports\SNImport;

class SNController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){ 
        if($request->has('cari_sn')){
                    $sn = SnProduk::where('sn','LIKE','%'.$request->cari_sn.'%')->orWhere('model','LIKE','%'.$request->cari_sn.'%')->paginate(10);
                }else{
                    $sn = SnProduk::orderBy('created_at','desc')->paginate(10);
                }
                return view('sn.data_sn', compact('sn'));
    }

    public function indexAktif(Request $request){
        $sn = SnProduk::where('status','Aktif')->paginate(10);
        return view('sn.data_sn_aktif', compact('sn'));
    }

    public function create(){
        return view('sn.create_sn');
    }

    public function simpan(Request $request){
        // dd($request->all());
        SnProduk::create([
            'sn' => $request->sn,
            'model' => $request->model,
            'harga' => $request->harga,
            'discount' => $request->discount,
            'poin' => $request->poin,
            'status' => $request->status,
        ]);

        return redirect('sn');
    }

    public function edit($id){
        $data = SnProduk::where('id',$id)->first();
        return view('sn.edit_sn', compact('data'));
    }

    public function update($id,SnProduk $snc, Request $request){
        // dd($request->all());
        $simpan = $snc->where('id',$id)->update([
            'sn' => $request->sn,
            'model' => $request->model,
            'harga' => $request->harga,
            'discount' => $request->discount,
            'poin' => $request->poin,
            'status' => $request->status,
        ]);
        if(!$simpan){
            return redirect()->route('sn')->with('error','data gagal di update');
        }
        return redirect()->route('sn')->with('success','data berhasil di update');
    }

    public function softDelete($id, SnProduk $snc){
        
        $simpan = $snc->where('id',$id)->update([
            'status' => 'Nonaktif',
        ]);

        if(!$simpan){
            return redirect()->route('sn')->with('error','data gagal di nonaktifkan');
        }

        return redirect()->route('sn')->with('success','data berhasil di dinonaktifkan');
    }

    public function hardDelete($id, SnProduk $snc){
        $delete = $snc->where('id',$id)->delete();

        if(!$delete){
            return redirect()->route('sn')->with('error','Data gagal di dihapus');
        }
        return redirect()->route('sn')->with('success','Data berhasil di hapus');
    }
    
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("sn_produk")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function export(){
        return Excel::download(new SerialNumberExport, 'SN.xlsx');
    }

    public function import(){
        return view('import');
    } 

    public function store(Request $request){
        
        Excel::import(new SNImport, $request->file('excel'));

        return redirect()->route('sn')->with('success','Data Behasil di Import.');
        // ->withSuccess('Data Behasil di Import!');
    }
}
