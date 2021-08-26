<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Karyawan;
use Illuminate\Http\Request;

class DataKehadiranController extends Controller
{
    public function dataKehadiran()
    {
        $employees = Karyawan::all();
        $dates = Absensi::distinct()->get('tanggal');
        return view('dataKehadiran',compact(['dates']));
    }

    public function dataKehadiranByDate($tanggal)
    {
        $kehadirans = Absensi::where('tanggal',$tanggal)->get();
        return view('dataKehadiranByDate',compact(['kehadirans','tanggal']));
    }

    public function rekapAbsensi()
    {
        $user = auth()->user();
        $kehadirans = Absensi::where('karyawan_id',$user->id)->get();
        return view('rekapPerKaryawan',compact(['kehadirans']));
    }
}
