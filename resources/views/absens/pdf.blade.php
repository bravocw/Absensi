<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
  page {
    size: A4 landscape;
  }

  body {
    overflow-x: auto;
    font-size: 18px;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
    /* Menengahkan teks dalam body */
  }

  .title-section {
    text-align: center;
    /* Menengahkan teks di dalam title-section */
  }

  table.center {
    margin-left: auto;
    margin-right: auto;
  }

  .page-break {
    page-break-after: always;
  }
</style>


<body>
  <div class="title-section text-center">
    <div class="mx-auto d-inline-block">
      <img alt="image" src="{{ public_path('assets/img/logo.png') }}" class="rounded-circle" style="width: 250px; height: 250px; display: block; margin-left: auto; margin-right: auto;">
      <h2>Data Rekap Absensi</h2><br>
      <h2>Rekap Absensi 1 Semester</h2>
    </div>
  </div>


  <table class="center" border="1" cellpadding="10" cellspacing="0">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Lengkap</th>
        <th>Jabatan</th>
        <th>Mata Pelajaran</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Bukti Kehadiran</th>
      </tr>
    </thead>
    @foreach($commodities as $key => $commodity)
    <tbody>
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $commodity->name }}</td>
        <td>{{ $commodity->jabatan }}</td>
        <td>{{ $commodity->mata_pelajarans->name }}</td>
        @if($commodity->condition === 1)
        <td>
          Hadir
        </td>
        @elseif($commodity->condition === 2)
        <td>
          Sakit
        </td>
        @else
        <td>
          Tidak Hadir
        </td>
        @endif
        <td>{{ $commodity->note }}</td>
        <td>{{ $commodity->status }}</td>
      </tr>
      $barang
    </tbody>
    @endforeach
  </table>

  <br>
  @if ($key!=0)
  @if (($key+1) % 4==0)
  <div class="page-break"></div>
  @endif
  @endif

</body>

</html>