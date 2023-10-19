<?php

namespace App\Exports;

use App\Models\prognosa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class prognosaExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $tahun;
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

    

     public function __construct($tahun,$bulan)
    {

     $this->tahun = $tahun; 
     $this->bulan = $bulan;   

    }

      
    public function view(): View
    {
        //dd($this->bulan, $this->tahun);
        return view('prognosa.export', [
            'prognosa' => prognosa::when($this->bulan, function ($query, $bulan) {
                return $query->where('id_bulan', $bulan);
            })
            ->when($this->tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->get()
        ]);
    }
}
