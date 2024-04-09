@php
setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
$hariIndonesia = [
'Sunday' => 'Minggu',
'Monday' => 'Senin',
'Tuesday' => 'Selasa',
'Wednesday' => 'Rabu',
'Thursday' => 'Kamis',
'Friday' => 'Jum\'at',
'Saturday' => 'Sabtu'
];
$hariInggris = date('l');
$hariIni = $hariIndonesia[$hariInggris] ?? $hariInggris;
$tanggalSekarang = strftime('%d %B %Y');
@endphp

@extends('layouts.stisla.index', ['title' => 'Halaman Daftar Absensi', 'page_heading' => "Daftar Absensi $hariIni, $tanggalSekarang"])


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

  @if (auth()->user()->role == 'guru')
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ route('barang.print') }}" class="btn btn-success float-right mt-3 mx-3" data-toggle="tooltip" title="Print">
        <i class="fas fa-fw fa-print"></i>
      </a>

      <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#absensi_create_modal">
        <i class="fas fa-fw fa-plus"></i>
        Lakukan Absensi
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
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Jabatan</th>
              <th scope="col">Mata Pelajaran</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barangs as $barang)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $barang->name }}</td>
              <td>{{ Str::limit($barang->jabatan, 55, '...') }}</td>
              <td>{{ $barang->mata_pelajarans->name }}</td>
              @if($barang->condition === 1)
              <td>
                <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Hadir">Hadir</span>
              </td>
              @elseif($barang->condition === 2)
              <td>
                <span class="badge badge-pill badge-warning" data-toggle="tooltip" data-placement="top" title="Sakit">Sakit</span>
              </td>
              @else
              <td>
                <span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Tidak Hadir">Tidak Hadir</span>
              </td>
              @endif
              <td class="text-center">
                <a data-id="{{ $barang->id }}" class="btn btn-sm btn-success text-white swal-edit-button" data-toggle="modal" data-target="#edit_commodity" data-placement="top" title="Ubah data">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
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
  @endif


  @if (auth()->user()->role == 'siswa')
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#absensi_create_modal">
        <i class="fas fa-fw fa-plus"></i>
        Lakukan Absensi
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
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Jabatan</th>
              <th scope="col">Mata Pelajaran</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($siswa as $barang)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $barang->name }}</td>
              <td>{{ Str::limit($barang->jabatan, 55, '...') }}</td>
              <td>{{ $barang->mata_pelajarans->name }}</td>
              @if($barang->condition === 1)
              <td>
                <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Hadir">Hadir</span>
              </td>
              @elseif($barang->condition === 2)
              <td>
                <span class="badge badge-pill badge-warning" data-toggle="tooltip" data-placement="top" title="Sakit">Sakit</span>
              </td>
              @else
              <td>
                <span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Tidak Hadir">Tidak Hadir</span>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection

@push('modal')
@include('absens.modal.create')
@include('absens.modal.edit')
@endpush

@push('js')
@include('absens._script')
@endpush