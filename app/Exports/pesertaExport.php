<?php

namespace App\Exports;

use App\peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class pesertaExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return peserta::all();
    }

    public function map($peserta): array
    {
        return [
            $peserta->lampiran->nama_peserta,
            $peserta->lampiran->asal_sekolah
        ];
    }
}
