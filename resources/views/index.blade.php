@extends('layouts.dashboard.master')
@section('title','Dashboard')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<i class="fa fa-check-circle"></i> {{session('success')}}
</div>
@endif


@if(auth()->user()->role=="karyawan")
<div class="alert alert-warning">
    <p>Check in dimulai 07.00 - 08.00 WIB</p>
    <p>Check out dimulai 16.00 - 17.00 WIB</p>
    <p id="teks"></p>
</div>
    @if ($batas != null)
    @php
         $now = strtotime(date('H:i'));
        $mulaiPagi = strtotime(date('07:00'));
        $akhirPagi = strtotime(date('08:00'));
        $mulaiSore = strtotime(date('16:00'));
        $akhirSore = strtotime(date('17:00'));

    @endphp
    @if($now >= $mulaiPagi && $now <=$akhirPagi)
        <div class="col-lg-12">
            <form action="{{route('submitKehadiranPagi')}}" method="GET">
                <button type="submit" class="btn btn-primary" style="width:100%;">Check In</button>
            </form>
        </div>
    @elseif ($now >= $mulaiSore && $now <= $akhirSore)
        <div class="col-lg-12">
            <form action="{{route('submitKehadiranSore')}}" method="GET">
                <button type="submit" class="btn btn-primary" style="width:100%;">Check Out</button>
            </form>
        </div>
    @endif

    @endif
@else
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Selamat Datang {{auth()->user()->name}}</h3>
	</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-newspaper-o"></i></span>
                    <p>
                        <span class="number">{{sumKaryawan()}}</span>
                        <span class="title">Karyawan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('linkfooter')
@if ($batas != null)
<script>
    const waktu_mulai = new Date('<?php echo $batas ?>').getTime();
    const hitung_mundur = setInterval(function() {
        const waktu_sekarang = new Date().getTime();
        const selisih = waktu_mulai - waktu_sekarang;
        const hari = Math.floor(selisih / (1000 * 60 * 60 *24));
        const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        const menit = Math.floor(selisih % (1000 * 60 * 60 ) / (1000 * 60 ));
        const detik = Math.floor(selisih % (1000 * 60 ) / 1000 );
        const teks = document.getElementById('teks');
        teks.innerHTML = '<strong> Sisa waktu check in/out: ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi !</strong> ';
        if( selisih < 0 ) {
            clearInterval(hitung_mundur);
            teks.innerHTML = 'Absensi Pagi Telah Berakhir';
        }
    }, 1000);
</script>
@endif
@endsection
