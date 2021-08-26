<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{

    use SoftDeletes;

    protected $table = 'karyawan';
    protected $fillable = ['user_id','jabatan_id','nik','no_hp','alamat'];
    protected $dates = ['deleted_at'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class)->withTrashed();
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class,'karyawan_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
