@extends('layouts.stisla.index', ['title' => 'Halaman Data Admin', 'page_heading' => 'Daftar Admin'])

@section('content')
<div class="card">

  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      {{$errors->first()}}
    </div>
  </div>
  @endif

  @if (session()->has('sukses'))
  <div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      {{session()->get('sukses')}}
    </div>
  </div>
  @endif

  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#commodity_create_modal">
        <i class="fas fa-fw fa-plus"></i>
        Tambah Data
      </button>
    </div>
  </div>
  <div class="row px-3 py-3">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Jabatan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barangs as $barang)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td><img alt="image" src="../assets/img/avatar/{{ $barang->photo }}.png" class="rounded-circle mr-1" style="width: 125px; height: 125px;"></td>
              <td>{{ Str::limit($barang->name, 55, '...') }}</td>
              <td>{{ $barang->email }}</td>
              <td>{{ $barang->role }}</td>
              <td>
                <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Baik">Aktif</span>
              </td>
              <td class="text-center">
                <a data-id="{{ $barang->id }}" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="tooltip" data-placement="top" title="Hapus data">
                  <i class="fas fa-fw fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('modal')
@include('penguruss.modal.create')
@endpush

@push('js')
@include('penguruss._script')
@endpush