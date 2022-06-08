<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HadiahModel;
use App\RiwayatSN;
use App\User;
use App\RiwRedModel;


class HadiahController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('cari_hadiah')){
            $hadiahs = HadiahModel::where('name','LIKE','%'.$request->cari_hadiah.'%')->paginate(10);
        
        }else{
            $hadiahs = HadiahModel::paginate(10);
        }
        return view('hadiah/index_hadiah',compact('hadiahs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hadiah.create_hadiah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName ='';

        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/Hadiah/FotoHadiah',$fileName);
        }
        $user = HadiahModel::create(array_merge($request->all(),[
            'foto' => $fileName
        ]));

        // return view('hadiah/index_hadiah')->with('success','Data berhasil di simpan');
        return redirect()->route('hadiah.index')->with('success','Data berhasil di simpan');
        // return redirect()->route('customer')->with('success','Data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = HadiahModel::where('id',$id)->first();
        return view('hadiah.edit_hadiah', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $fileName ='';
        // $fileName = $request->foto;

        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/Hadiah/FotoHadiah',$fileName);
        }

        $simpan = HadiahModel::where('id',$id)->update([
            // dd($request->all());
                'name' =>$request->name,
                'req_poin' =>$request->req_poin,
                'foto' =>$fileName,
                'status' =>$request->status,
                'stok' =>$request->stok,
            ]);
    
            if(!$simpan){
                return redirect()->route('hadiah.index')->with('error','Data gagal di update');
            }
            return redirect()->route('hadiah.index')->with('success','data berhasil di update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // $hapus = HadiahModel::where('id',$id)->delete();

        // if(!$hapus){
        //     return redirect()->route('hadiah')->with('error','Data gagal di dihapus');
        //     // return redirect('hadiah')->with('error','Data gagal di dihapus');
        // }

        // return redirect()->route('hadiah')->with('success','Data berhasil di hapus');
        // // return redirect('hadiah')->with('success','Data berhasil di hapus');
    }

    public function Hdelete($id, HadiahModel $hadiah){
        $hapus = $hadiah->where('id',$id)->delete();

        if(!$hapus){
            return redirect()->route('hadiah.index')->with('error','Data gagal di dihapus');
            // return redirect('hadiah')->with('error','Data gagal di dihapus');
        }

        return redirect()->route('hadiah.index')->with('success','Data berhasil di hapus');
        // return redirect('hadiah')->with('success','Data berhasil di hapus');
    }

    public function viewPoinCust()
    {

        // $req_poinHadiah = HadiahModel::where('name',$request->name)->sum('req_poin');

        $poin_user = RiwayatSN::groupBy('email')
                    ->selectRaw('email,sum(poin) as totalPoin')
                    ->orderBy('totalPoin', 'DESC')
                    ->paginate(10);

        // $poinAwal = RiwayatSN::where('email')->sum('poin');
        // $poinRedeem= RiwRedModel::where('email')->sum('jml_poin');

        // $totalPoin_user = RiwayatSN::where('email')->sum('poin');
        // $poinRedeem= RiwRedModel::where('email')->sum('jml_poin');
        // $sisaPoin = $totalPoin_user - $poinRedeem;

        // ->orderBy('email','DESC')
        // ->paginate(10);

        return view('hadiah.poin_cust',compact('poin_user'));
    }

    public function redeemPoin()
    {
                
    }
}
