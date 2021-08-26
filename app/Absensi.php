<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = ['karyawan_id','tanggal','waktu_masuk','waktu_keluar','terlambat'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class)->withTrashed();
    }
}
