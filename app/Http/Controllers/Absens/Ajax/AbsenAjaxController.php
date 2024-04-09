<?php

namespace App\Http\Controllers\Absens\Ajax;

use Carbon\Carbon;
use App\Absen;
use App\BarangLocation;
use App\Http\Controllers\Controller;
use App\MataPelajaran;
use App\SchoolOperationalAssistance;
use Illuminate\Http\Request;

class AbsenAjaxController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'mata_pelajarans_id' => '',
            'name' => '',
            'jabatan' => '',
            'condition' => '',
            'note' => '',
            'status' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $name = $request->name; // Mendapatkan nama user dari request
        $image = $request->file('status');
        $currentDate = date('Ymd'); // Mendapatkan tanggal dalam format TahunBulanTanggal

        // Memecah nama user berdasarkan spasi dan mengambil kata pertama
        $nameParts = explode(' ', $name);
        $firstName = $nameParts[0];

        // Membuat nama file dengan format buktikehadiranTanggalBulanTahun_namaUser1Kata_2AngkaRandom.extension
        $imgName = 'BuktiKehadiran_' . $currentDate . '_' . $firstName . '_' . rand(10, 99) . '.' . $image->extension();

        $destinationPath = public_path('/assets/img/dokumen'); // Direktori tujuan

        // Memeriksa apakah file dengan nama yang sama sudah ada di direktori tujuan
        if (!file_exists($destinationPath . '/' . $imgName)) {
            $image->move($destinationPath, $imgName); // Memindahkan file ke direktori tujuan dengan nama file baru
            $uploaded = $imgName;
        } else {
            // Jika sangat tidak mungkin terjadi karena penambahan rand(), tetapi Anda bisa menambahkan logika tambahan di sini jika diperlukan.
            $uploaded = 'already_exists_' . $imgName; // Menandai sebagai sudah ada, atau handle sesuai kebutuhan
        }




        $barangs = new Absen();
        $barangs->mata_pelajarans_id = $request->mata_pelajarans_id;
        $barangs->name = $request->name;
        $barangs->jabatan = $request->jabatan;
        $barangs->condition = $request->condition;
        $barangs->note = $request->note;
        $barangs->status = $uploaded;


        $barangs->save();

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $barangs], 200);
    }



    public function show($id)
    {
        $barang = Absen::findOrFail($id);

        $data = [
            'mata_pelajarans_id' => $barang->mata_pelajarans->name,
            'name' => $barang->name,
            'brand' => $barang->brand,
            'condition' => $barang->condition,
            'jabatan' => $barang->jabatan,
            'note' => $barang->note,
        ];

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $data], 200);
    }

    public function edit($id)
    {
        $barang = Absen::findOrFail($id);

        $barang = [
            'mata_pelajarans_id' => $barang->mata_pelajarans->name,
            'name' => $barang->name,
            'brand' => $barang->brand,
            'condition' => $barang->condition,
            'jabatan' => $barang->jabatan,
            'created_at' => Carbon::parse($barang->created_at)->isoFormat('dddd, D MMMM YYYY'),
            'note' => $barang->note,
            'status' => $barang->status,
        ];

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => [
            'barangs' => $barang,
            'mata_pelajarans' => MataPelajaran::all(),
            'conditions' => [
                'Hadir',
                'Sakit',
                'Tidak Hadir'
            ]
        ]], 200);
    }

    public function update(Request $request, $id)
    {
        $barangs = Absen::findOrFail($id);

        $barangs->condition = 3;
        $barangs->save();

        return response()->json(['status' => 200, 'message' => 'Success'], 200);
    }

    public function destroy($id)
    {
        Absen::findOrFail($id)->delete();

        return response()->json(['status' => 200, 'message' => 'Success'], 200);
    }
}
