<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $datetimebatas = date_create("12:00:00");
        $now = strtotime(date('H:i'));
        $mulaiPagi = strtotime(date('07:00'));
        $akhirPagi = strtotime(date('08:00'));
        $mulaiSore = strtotime(date('16:00'));
        $akhirSore = strtotime(date('17:00'));

        if ($now >= $mulaiPagi && $now <= $akhirPagi) {
            $datetimebatas = date_create("08:00:00");
        }elseif($now >= $mulaiSore && $now <= $akhirSore){
            $datetimebatas = date_create("17:00:00");
        }else{
            $datetimebatas = null;
        }

        if ($datetimebatas != null) {
            $batas = date_format($datetimebatas,"Y-m-d H:i:s");
        }else{
            $batas = null;
        }
        return view('index',compact(['batas']));
    }

    public function submitKehadiranPagi(Request $request)
    {
        $user = auth()->user(); //
        $tanggal = date("Y-m-d");

        $kehadiranHariIni = Absensi::where('tanggal',$tanggal)->where('karyawan_id',$user->karyawan->id)->first();
        if ($kehadiranHariIni == null) {
            $kehadiran = Absensi::create([
                'karyawan_id' => $user->karyawan->id,
                'tanggal' => $tanggal,
                'waktu_masuk' => date("H:i:s"),
            ]);

            return back()->with('success','Berhasil Check in');
        }else {
            return back()->with('success','Kamu telah mengisi kehadiran');
        }


    }

    public function submitKehadiranSore(Request $request)
    {
        $user = auth()->user();
        $tanggal = date("Y-m-d");
        $kehadiranHariIni = Absensi::where('tanggal',$tanggal)->where('karyawan_id',$user->karyawan->id)->first();
        if ($kehadiranHariIni) {
            $kehadiranHariIni->update([
                'waktu_keluar' => date("H:i:s")
            ]);
        }else{
            $kehadiranHariIni = Absensi::create([
                'karyawan_id'=> $user->karyawan->id,
                'tanggal' => $tanggal,
                'waktu_keluar' => date("H:i:s")
            ]);
        }

        return back()->with('success','Berhasil mengisi kehadiran');
    }
}
