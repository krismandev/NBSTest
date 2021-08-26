@extends('layouts.dashboard.master')
@section('title','Rekap Kehadiran')
@section('content')
@if(session('success'))

<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<i class="fa fa-check-circle"></i> {{session('success')}}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="panel">
  <div class="panel-heading">
    <div class="col-md-6">
      <h3 class="panel-title">Rekap Kehadiran Saya Bulan ini</h3>
    </div>
  </div>
  <div class="panel-body" style="margin-top: 10px;">
    @if($kehadirans != null)
    <table class="table table-hover" style="margin-top: 10px;">
      <thead>
        <tr>
            <th>Tanggal</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
        </tr>
      </thead>
      <tbody>

		@foreach($kehadirans as $kehadiran)
        <tr>
            <td>{{$kehadiran->tanggal}}</td>
            <td>{{date("H:i",strtotime($kehadiran->waktu_masuk))}}</td>
            <td>{{date("H:i",strtotime($kehadiran->waktu_keluar))}}</td>
        </tr>
		@endforeach
      </tbody>
    </table>
    <div class="">

    </div>
    @else
    <h3>Belum ada data karyawan</h3>
    @endif
  </div>
</div>

@stop
@section('linkfooter')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {


	});

</script>
@stop
