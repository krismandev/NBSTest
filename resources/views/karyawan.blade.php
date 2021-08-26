@extends('layouts.dashboard.master')
@section('title','Karyawan')
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
      <h3 class="panel-title">Halaman Data Karyawan</h3>
    </div>
    <div class="col-md-6">
      <a href="#" class="btn btn-primary navbar-btn-right" id="btn-tambahemployee"  data-toggle="modal" data-target="#tambahemployee">
        Tambah
      </a>
    </div>
  </div>
  <div class="panel-body" style="margin-top: 10px;">
    @if($employees->count() != 0)
    <table class="table table-hover" style="margin-top: 10px;">
      <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php
          $i = 1;
        @endphp
		@foreach($employees as $employee)
        <tr>
            <td>{{$employees->perPage()*($employees->currentPage()-1)+$i}}</td>
            @php $i++; @endphp

            <td>{{$employee->user->name}}</td>
            <td>{{$employee->jabatan->nama_jabatan}}</td>
            <td>
                <a href="#" class="btn btn-primary edit-employee" title="Edit" data-toggle="modal" data-target="#editemployee"
                    data-jabatan_id="{{$employee->jabatan->id}}"
                    data-karyawan_id="{{$employee->id}}"
                    data-nama_jabatan="{{$employee->jabatan->nama_jabatan}}"
                    data-name="{{$employee->user->name}}"
                    data-no_hp="{{$employee->no_hp}}"
                    data-alamat="{{$employee->alamat}}"
                    data-nik="{{$employee->nik}}"
                    data-email="{{$employee->user->email}}">
                    <i class="lnr lnr-pencil"></i>
                </a>
                <a href="#" class="btn btn-danger hapus-employee" title="Hapus"  data-jabatan_id="{{$employee->id}}"> <i class="lnr lnr-trash"></i> </a>
            </td>
        </tr>
		@endforeach
      </tbody>
    </table>
    <div class="">
      {{$employees->links()}}
    </div>
    @else
    <h3>Belum ada data karyawan</h3>
    @endif
  </div>
</div>

{{-- ADD EMPLOYEE --}}
<!-- Modal -->
<div class="modal fade" id="tambahemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeEmployee')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="name" value="" class="form-control" placeholder="Masukkan nama">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Email</span>
                    </div>
                    <div class="col-md-12">
                        <input type="email" name="email" value="" class="form-control" placeholder="Masukkan email">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. HP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="no_hp" value="" class="form-control" placeholder="Masukkan Nomor HP">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>NIK</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nik" value="" class="form-control" placeholder="Masukkan NIK">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Jabatan</span>
                    </div>
                    <div class="col-md-12">
                        <select name="jabatan_id" id="" class="form-control">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($positions as $position)
                            <option value="{{$position->id}}">{{$position->nama_jabatan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Alamat</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="alamat" value="" class="form-control" placeholder="Masukkan Alamat">
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
  <div class="modal fade" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateEmployee')}}" method="post">
            @csrf @method("PATCH")
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="karyawan_id" id="update_karyawan_id" value="">
                        <input type="text" id="update_name" name="name" value="" class="form-control" placeholder="Masukkan nama">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Email</span>
                    </div>
                    <div class="col-md-12">
                        <input type="email" id="update_email" name="email" value="" class="form-control" placeholder="Masukkan email">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. HP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" id="update_no_hp" name="no_hp" value="" class="form-control" placeholder="Masukkan Nomor HP">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>NIK</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" id="update_nik" name="nik" value="" class="form-control" placeholder="Masukkan NIK">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Jabatan</span>
                    </div>
                    <div class="col-md-12">
                        <select name="jabatan_id" class="form-control" id="update_jabatan_id">
                            <option value="" selected id="jabatan_selected">Pilih Jabatan</option>
                            @foreach ($positions as $position)
                            <option value="{{$position->id}}">{{$position->nama_jabatan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Alamat</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="alamat" id="update_alamat" value="" class="form-control" placeholder="Masukkan Alamat">
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
		$('#btn-tambahemployee').click(function(){

		});
        $(".edit-employee").click(function (e) {
            const name = $(this).data("name")
            const karyawan_id = $(this).data("karyawan_id")
            const email = $(this).data("email")
            const no_hp = $(this).data("no_hp")
            const nik = $(this).data("nik")
            const jabatan_id = $(this).data("jabatan_id")
            const alamat = $(this).data("alamat")

            const nama_jabatan = $(this).data("nama_jabatan")
            $("#update_karyawan_id").val(karyawan_id)
            $("#update_name").val(name)
            $("#update_email").val(email)
            $("#update_no_hp").val(no_hp)
            $("#update_nik").val(nik)
            $("#update_alamat").val(alamat)
            $("#jabatan_selected").html(nama_jabatan).val(jabatan_id)

        });

		$('.hapus-employee').click(function(){
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
                    window.location = "/employees/"+jabatan_id+"/delete"
                }
            });


		});

	});

</script>
@stop
