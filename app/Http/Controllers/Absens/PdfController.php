<?php

namespace App\Http\Controllers\Absens;

use PDF;
use App\Absen;
use App\DataPinjams;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $commodities = Absen::all();
        $sekolah = env('NAMA_SEKOLAH', 'Barang Milik Sekolah');
        $pdf = PDF::loadView('absens.pdf', compact(['commodities', 'sekolah']))->setPaper('A3', 'landscape');

        return $pdf->download('daftar-rekap-absensi-' . date('d-m-Y') . '.pdf');
    }
}
