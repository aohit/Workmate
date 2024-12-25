<?php

namespace App\Exports;

use App\Models\Language;
use App\Models\Skill;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Http\Request;


class DisciplinaryExport implements FromCollection,WithEvents,WithColumnWidths,WithHeadings,WithMapping

{
    private $counter = 0;
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

    
    public function collection()
    {
        return  $this->contacts;
    }

    public function headings(): array
    {
        return [
            'S.No.',
            'Title',
            'Issue date',
            'Action type',
            'Department',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,
        ];
    }

    public function map($disciplinarydata): array
    {
        $this->counter++;
        return [
            $this->counter,
            $disciplinarydata->title,
            $disciplinarydata->issue_date,
            $disciplinarydata->actionType?->action_type,
            $disciplinarydata->departments?->name,
       
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:O1')
                                ->getFont()
                                ->setBold(true);
                                $cellRange = 'A1:D1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
   
            },
        ];
    }

 
}
