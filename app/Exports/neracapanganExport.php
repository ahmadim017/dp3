<?php

namespace App\Exports;

use App\Models\neracapangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class neracapanganExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $tahun;
    protected $minggu;
    protected $bulan;
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A4:J4'; // All headers
                $font = 'Calibri';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont($font)->setSize(14);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                           
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle('A4:J4')->applyFromArray($styleArray);

            },
        ];
        
        
    }

    

     public function __construct($tahun, $minggu, $bulan)
    {

     $this->tahun = $tahun; 
     $this->minggu = $minggu;  
     $this->bulan = $bulan;   

    }

      
    public function view(): View
    {
        return view('neracapangan.export', [
            'neracapangan' => neracapangan::where('minggu','%'.$this->minggu.'%')
            ->where('id_bulan','like','%'.$this->bulan.'%')
            ->where('tahun', 'like','%'.$this->tahun.'%')
            ->get()
        ]);
    }

}
