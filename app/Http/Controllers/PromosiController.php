<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promosi;

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
            $promosis = Promosi::where('judul','LIKE','%'.$request->cari_promosi.'%')->paginate(10);
        
        }else{
            $promosis = Promosi::paginate(10);
            // where('status','Aktif')->
        }
        return view('promosi/index_promosi',compact('promosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promosi.create_promosi');
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
        $data = Promosi::where('id',$id)->first();
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

        $simpan = Promosi::where('id',$id)->update([
            // dd($request->all());
                'judul' =>$request->judul,
                'foto' =>$fileName,
                'status' =>$request->status,
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
    public function destroy($id)
    {
        //
    }

    public function Delete($id, Promosi $promosis){
        $hapus = $promosis->where('id',$id)->delete();

        if(!$hapus){
            return redirect()->route('promosi.index')->with('error','Data gagal di dihapus');
        }
        return redirect()->route('promosi.index')->with('success','Data berhasil di hapus');
    }

    public function Slidebar(Request $request)
    {
        if($request->has('cari_promosi')){
            $promosis = Promosi::where('judul','LIKE','%'.$request->cari_promosi.'%')->paginate(10);
        
        }else{
            $promosis = Promosi::paginate(10);
            // where('status','Aktif')->
        }
        return view('promosi/index_promosi',compact('promosis'));
    }
    
}
