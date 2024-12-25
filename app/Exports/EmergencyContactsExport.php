<?php

namespace App\Exports;

use App\Models\EmergencyContact;
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

class EmergencyContactsExport implements FromCollection,WithEvents,WithColumnWidths,WithHeadings,WithMapping

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
            'Employee Name',
            'Name',
            'Relation',
            'Contact Number',
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

    public function map($employee_data): array
    {
        $this->counter++;
        return [
            $this->counter,
            $employee_data->user?->name,
            $employee_data->name,
            $employee_data->relation,   
            $employee_data->number,   
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