<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promosi;
use Session;

class PromosiController extends Controller
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
        if($request->has('cari_promosi')){
            $promosis = Promosi::where('judul','LIKE','%'.$request->cari_promosi.'%')->orderBy('created_at','desc')->paginate(10);
        
        }else{
            $promosis = Promosi::orderBy('created_at','desc')->paginate(10);
        }
        return view('promosi/index',compact('promosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promosi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $fileName ='';

        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/Promosi/',$fileName);
        }
        $user = Promosi::create(array_merge($request->all(),[
            'foto' => $fileName
        ]));

        // return view('hadiah/index_hadiah')->with('success','Data berhasil di simpan');
        return redirect()->route('promosi.index')->with('success','Data berhasil di simpan');
        
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
        $data = Promosi::where('id_promosi',$id)->first();
        return view('promosi.edit_promosi', compact('data'));
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
        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/Promosi/',$fileName);
        }

        $simpan = Promosi::where('id_promosi',$id)->update([
            // dd($request->all());
                'judul' =>$request->judul,
                'foto' =>$fileName,
                'kategori' =>$request->kategori,
                'status' =>$request->status,
                'ket' =>$request->ket,
            ]);
    
            if(!$simpan){
                return redirect()->route('promosi.index')->with('error','Data gagal di update');
            }
            return redirect()->route('promosi.index')->with('success','data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Promosi $promosi)
    {
        // $delete = $promosi->where('id_promosi',$id)->delete();

        // if(!$delete){
        //     return redirect()->route('promosi.index')->with('error','Data gagal di dihapus');
        // }
        // return redirect()->route('promosi.index')->with('success','Data berhasil di hapus');
    }

    public function indexContent(Request $request)
    {
        if($request->has('cari_content')){
            $contents = Promosi::where('judul','LIKE','%'.$request->cari_content.'%')->orWhere('kategori','Content')->orderBy('created_at','desc')->paginate(10);
        
        }else{
            $contents = Promosi::where('kategori','Content')->orderBy('created_at','desc')->paginate(10);
        }
        return view('promosi/index_content',compact('contents'));
    }

    public function indexSlider(Request $request)
    {
        if($request->has('cari_hadiah')){
            $hadiahs = Promosi::where('name','LIKE','%'.$request->cari_hadiah.'%')->paginate(10);
        
        }else{
            $hadiahs = Promosi::paginate(10);
        }
        return view('hadiah/index_hadiah',compact('hadiahs'));
    }

    public function Delete($id, Promosi $promosi){
        $delete = $promosi->where('id_promosi',$id)->delete();

        if(!$delete){
            return redirect()->route('promosi.index')->with('error','Data gagal di dihapus');
        }
        return redirect()->route('promosi.index')->with('success','Data berhasil di hapus');
    }

    public function Nonaktif(Request $request, $id)
    {
        $simpan = Promosi::where('id_promosi',$id)->update([
            // dd($request->all());
                'status' =>'Nonaktif'
            ]);
    
            if(!$simpan){
                return redirect()->route('promosi.index')->with('error','Data gagal di update');
            }
            return redirect()->route('promosi.index')->with('success','data berhasil di update');
    }

}
