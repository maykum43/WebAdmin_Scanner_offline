<?php

namespace App\Exports;

use App\SnProduk;
use Maatwebsite\Excel\Concerns\FromCollection;

class SNExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SNCashback::all();
    }
}
