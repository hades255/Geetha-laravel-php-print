<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ContactOpeningBalanceExport implements FromView,WithTitle
{
    
    public $data; 
    

    public function __construct(
        $data
    ){
        $this->data = $data;

    }


    public function view(): View
    {  
        return view('contact.Export.ContactOpeningBalanceExport',[
            
            'data'=> $this->data
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Contact-Opening-Balance';
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setEncoding('UTF-8');
            },
        ];
    }

}