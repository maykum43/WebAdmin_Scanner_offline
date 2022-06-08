<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promosi;

class PromosisController extends Controller
{
    public function IndexSlidebar(Request $request)
    {
        if($request->has('cari_promosi')){
            $promosis = Promosi::where('judul','LIKE','%'.$request->cari_promosi.'%')->orWhere('kategori','Slidebar')->paginate(10);
        
        }else{
            $promosis = Promosi::where('kategori','Slidebar')->paginate(10);
        }
        return view('promosi/slidebar/index',compact('promosis'));
    }

    public function IndexContent(Request $request)
    {
        if($request->has('cari_promosi')){
            $promosis = Promosi::where('judul','LIKE','%'.$request->cari_promosi.'%')->orWhere('kategori','Content')->paginate(10);
        
        }else{
            $promosis = Promosi::where('kategori','Content')->paginate(10);
        }
        return view('promosi/content/index',compact('promosis'));
    }

    public function createSlidebar()
    {
        return view('promosi/slidebar/create');
    }

    public function storeSlidebar(Request $request)
    {
        // dd($request->all());
        $fileName ='';

        if($request->foto->getClientOriginalName()){
            $file = str_replace(' ','',$request->foto->getClientOriginalName());
            $fileName = date('YdmHs').rand(1,999).'_'.$file;
            $request->foto->storeAs('public/Promosi/',$fileName);
        }
        $user = Promosi::create(array_merge($request->all(),[
            'foto' => $fileName,
            'kategori' => 'Slidebar',
            // 'ket' => $request->ket
        ]));

        return redirect()->route('promosis.slidebar')->with('success','Data berhasil di simpan');
    }
    
    public function editSlidebar($id)
    {
        $data = Promosi::where('id',$id)->first();
        return view('promosi/slidebar/edit', compact('data'));
    }

    public function updateSlider(Request $request, $id)
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
                'ket' =>$request->ket,
            ]);
    
            if(!$simpan){
                return redirect()->route('promosis.slidebar')->with('error','Data gagal di simpan');
            }
            return redirect()->route('promosis.slidebar')->with('success','Data berhasil di simpan');
    }
}
