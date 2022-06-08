<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RiwRedModel;

class RedeemPoinController extends Controller
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
        if($request->has('cari_user')){
            $data_redeem = RiwRedModel::where('email','LIKE','%'.$request->cari_user.'%')->paginate(10);
        
        }else{
            $data_redeem = RiwRedModel::paginate(10);
        }
        return view('redeem_poin/redeem_poin',compact('data_redeem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function viewPoinCust()
    {
        // $poin_user = RiwayatSN::select('SELECT id, SUM(poin) AS TotalPoin FROM riwayat_sn GROUP BY id;');
        // return view('hadiah.poin_cust',compact('poin_user'));

        $poin_user = RiwayatSN::groupBy('email')
                    ->selectRaw('email,sum(poin) as totalPoin')
                    ->orderBy('totalPoin', 'DESC')
                    ->paginate(10);

        return view('hadiah.poin_cust',compact('poin_user'));
    }

    public function redeemPoin()
    {
        $totalPoin_user = RiwayatSN::groupBy('email')
                    ->selectRaw('email,sum(poin) as totalPoin');

        $req_poinHadiah = HadiahModel::where('name',$request->name)->get('req_poin');
        
    }
    public function selesai($id)
    {
        $update = RiwRedModel::where('id',$id)->update([
            'status' => 'Selesai',
        ]);

        if(!$update){
            return redirect()->route('redeemPoin.index')->with('error','data gagal di selesaikan');
        }
        return redirect()->route('redeemPoin.index')->with('success','Data berhasil diselesaikan');
    }
    public function HardDelete($id)
    {
        $delete = RiwRedModel::where('id',$id)->delete();

        if(!$delete){
            return redirect()->route('redeemPoin.index')->with('error','Data gagal di dihapus');
        }
        return redirect()->route('redeemPoin.index')->with('success','Data berhasil di hapus');
    }
}
