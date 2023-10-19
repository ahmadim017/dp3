<?php

namespace App\Imports;

use App\Models\fsva;
use App\Models\fsvatahun;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class fsvaImport implements ToModel,WithStartRow, WithCustomCsvSettings
{
    protected $id_tahun;

    public function __construct($id_tahun)
    {
        $this->id_tahun = $id_tahun;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 3;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function model(array $row)
    {
        return new fsva([
            'id_tahun' => $this->id_tahun,
            'kelurahan' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai
            'indexprioritas' => $row[1],
            'penyediaanpangan' =>$row[2],
            'kesejahteraanrendah' =>$row[3],
            'aksespenghubung' =>$row[4],
            'aksesairbersih' =>$row[5],
            'jmltenagakesehatan' =>$row[6],
        ]);
    }
}
