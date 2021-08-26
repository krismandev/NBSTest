<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Karyawan;
use App\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function getEmployees()
    {
        $positions = Jabatan::all();
        $employees = Karyawan::paginate(10);
        return view('karyawan',compact(['employees','positions']));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'nik' => 'required',
            'jabatan_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nik),
            'role' => 'karyawan'
        ]);

        $karyawan = Karyawan::create([
            'user_id' => $user->id,
            'jabatan_id' => $request->jabatan_id,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return back()->with('success','Berhasil menambah karyawan');
    }

    public function updateEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'nik' => 'required',
            'jabatan_id' => 'required'
        ]);

        $karyawan = Karyawan::find($request->karyawan_id);
        $user = User::find($karyawan->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $karyawan->update([
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'jabatan_id' => $request->jabatan_id
        ]);

        return back()->with('success','Berhasil mengupdate data karyawan');
    }
}
