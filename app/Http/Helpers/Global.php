<?php

use App\Karyawan;

function sumKaryawan()
{
    $sumKaryawan = Karyawan::count();
    return $sumKaryawan;
}
