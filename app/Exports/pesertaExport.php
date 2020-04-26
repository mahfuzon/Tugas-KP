<?php

namespace App\Exports;

use App\peserta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class pesertaExport implements FromView
{
    public function view(): View
    {
        return view('excel.peserta', [
            'peserta' => peserta::all()
        ]);
    }
}
