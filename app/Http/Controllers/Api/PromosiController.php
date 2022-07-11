<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promosi;
use App\User;

class PromosiController extends Controller
{
    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }

    public function listContent()
    {
        $contents = Promosi::where('status','Aktif')->Where('kategori','Content')->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get data Content berhasil',
            'hadiahs' => $contents
        ]);
    }

    public function listSlider()
    {
        $sliders = Promosi::where('status','Aktif')->Where('kategori','Slider')->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get data Slider berhasil',
            'hadiahs' => $sliders
        ]);
    }
}
