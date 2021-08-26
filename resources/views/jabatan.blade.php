@extends('layouts.dashboard.master')
@section('title','Jabatan')
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
      <h3 class="panel-title">Halaman Jabatan</h3>
    </div>
    <div class="col-md-6">
      <a href="#" class="btn btn-primary navbar-btn-right" id="btn-tambahposition"  data-toggle="modal" data-target="#tambahposition">
        Tambah
      </a>
    </div>
  </div>
  <div class="panel-body" style="margin-top: 10px;">
    @if($positions->count() != 0)
    <table class="table table-hover" id="data_positions_reguler" style="margin-top: 10px;">
      <thead>
        <tr>
            <th>No</th>
            <th>Nama Jabatan</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php
          $i = 1;
        @endphp
		@foreach($positions as $position)
        <tr>
            <td>{{$positions->perPage()*($positions->currentPage()-1)+$i}}</td>
            @php $i++; @endphp
            <td>{{$position->nama_jabatan}}</td>
            <td>
                <a href="#" class="btn btn-primary edit-position" title="Edit" data-toggle="modal" data-target="#editposition" data-jabatan_id="{{$position->id}}" data-nama_jabatan="{{$position->nama_jabatan}}"> <i class="lnr lnr-pencil"></i> </a>
                <a href="#" class="btn btn-danger hapus-position" title="Hapus"  data-jabatan_id="{{$position->id}}"> <i class="lnr lnr-trash"></i> </a>
            </td>
        </tr>
		@endforeach
      </tbody>
    </table>
    <div class="">
      {{$positions->links()}}
    </div>
    @else
    <h3>Belum ada data jabatan</h3>
    @endif
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahposition" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storePosition')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Jabatan</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_jabatan" value="" class="form-control" placeholder="Masukkan nama jabatan">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- MODAL EDIT --}}
  <div class="modal fade" id="editposition" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updatePosition')}}" method="post">
            @csrf @method("PATCH")
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Jabatan</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="jabatan_id" id="update_id" value="">
                        <input type="text" name="nama_jabatan" value="" class="form-control" id="update_nama_jabatan">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@stop
@section('linkfooter')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#btn-tambahposition').click(function(){

		});
        $(".edit-position").click(function (e) {
            const jabatan_id = $(this).data("jabatan_id")
            const nama_jabatan = $(this).data("nama_jabatan")
            $("#update_id").val(jabatan_id)
            $("#update_nama_jabatan").val(nama_jabatan)

        });

		$('.hapus-position').click(function(){
			const jabatan_id = $(this).data('jabatan_id');
            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/positions/"+jabatan_id+"/delete"
                }
            });


		});

	});

</script>
@stop
