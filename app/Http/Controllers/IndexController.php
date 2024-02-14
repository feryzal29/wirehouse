<?php

namespace App\Http\Controllers;

use App\Models\mapinguser;
use App\Models\Transfer2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $maping = mapinguser::where('user_id',Auth::user()->id)
                    ->first();
        $keluar = Transfer2::where('pengirim_id', $maping->plan_id)->count();
        $belum = Transfer2::where('penerima_id', $maping->plan_id)->where('status_pengiriman','belum')->count();
        $sudah = Transfer2::where('penerima_id', $maping->plan_id)->where('status_pengiriman','diterima')->count();
        $pengganti = Transfer2::where('penerima_id', $maping->plan_id)
                                ->where('pengganti','=','yes')->count();
        return view('index',compact(['keluar','belum','sudah','pengganti']));
    }

   
}
