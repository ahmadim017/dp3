<?php

namespace App\Imports;


use App\Models\penyaluran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;


class penyaluranImport implements ToModel, WithStartRow, WithCustomCsvSettings

{

    protected $cadanganPanganId;

    public function __construct($cadanganPanganId)
    {
        $this->cadanganPanganId = $cadanganPanganId;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // if (!$this->validateData($row)) {
          //  throw new \Exception("Data tidak sesuai, impor dibatalkan!");
       // }


        // Kembalikan model penyaluran berdasarkan data baris
        return new penyaluran([
            'id_cadanganpangan' => $this->cadanganPanganId,
            'nik' => $row[0],
            'nama' => $row[1],
            'id_komoditas' => $row[2],
            'jumlah' => $row[3],
        ]);
    
    }

    private function validateData($row)
{
    // Memastikan bahwa nilai pada $row[1] adalah angka (numerik)
    if (!is_numeric($row[1])) {
        return false;
    }

    // Memastikan bahwa nilai pada $row[1] memiliki tepat 16 digit
    if (strlen($row[1]) !== 16) {
        return false;
    }

    // Jika validasi di atas berhasil, kembalikan true (data sesuai)
    return true;
}

}
