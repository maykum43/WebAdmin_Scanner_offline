<?php

namespace App\Imports;

use App\SnProduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SNImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new SnProduk([
            'sn' => $row['sn'],
            'model' => $row['model'],
            'harga' => $row['harga'],
            'discount' => $row['disc'],
            'poin' => $row['poin'],
            'status' => $row['status'],
        ]);
    }
}
