<?php

namespace App\Exports;

use App\Models\sosialisasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class sosialisasiExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $ta;

    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A4:E4'; // All headers
                $font = 'Calibri';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont($font)->setSize(14);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                           
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle('A4:E4')->applyFromArray($styleArray);

            },
        ];
        
        
    }

    

     public function __construct($ta)
    {

     $this->ta = $ta;  

    }

      
    public function view(): View
    {
        return view('sosialisasipsat.export', [
            'sosialisasi' => sosialisasi::whereYear('created_at','like','%'. $this->ta .'%')->get()
        ]);
    }
}
