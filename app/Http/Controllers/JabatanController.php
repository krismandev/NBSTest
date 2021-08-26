<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function getPositions()
    {
        $positions = Jabatan::orderBy('nama_jabatan')->paginate(10);
        return view('jabatan',compact('positions'));
    }

    public function storePosition(Request $request)
    {
        $request->validate([
            'nama_jabatan'=>'required'
        ]);

        Jabatan::create(
            $request->all()
        );

        return back()->with('success','Berhasil menambah jabatan');
    }

    public function updatePosition(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required',
        ]);

        $jabatan = Jabatan::find($request->jabatan_id);
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return back()->with('success','Berhasil mengupdate jabatan');
    }

    public function deletePosition($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return back()->with('success','Berhasil menghapus jabatan');
    }
}
