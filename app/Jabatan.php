<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{

    use SoftDeletes;

    protected $table = 'jabatan';
    protected $fillable = ['nama_jabatan'];
    protected $dates = ['deleted_at'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class,'jabatan_id','id');
    }

}
