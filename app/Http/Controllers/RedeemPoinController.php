<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RiwRedModel;
use App\User;

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
    public function selesai($id,User $user)
    {
        $update = RiwRedModel::where('id',$id)->update([
            'status' => 'Selesai',
        ]);

        $this->pushNotif('Redeem Hadiah Selesai','Silahkan Cek Whatsapp atau email anda, untuk bukti pengiriman yang kami kirim',$user->fcm);

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
