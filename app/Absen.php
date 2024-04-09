<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $guarded = [];

    public function mata_pelajarans()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function school_operational_assistance()
    {
        return $this->belongsTo(SchoolOperationalAssistance::class);
    }

    public function data_pinjams()
    {
        return $this->belongsTo(DataPinjams::class);
    }

    public function indonesian_format_date($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function indonesian_currency($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
