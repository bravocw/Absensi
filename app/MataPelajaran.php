<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $guarded = [];

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }
}
