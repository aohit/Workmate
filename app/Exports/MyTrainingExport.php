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

class MyTrainingExport implements FromCollection,WithEvents,WithColumnWidths,WithHeadings,WithMapping

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
            'Name',
            'Department',
            'Job title',
            'Item',
            'Training status',
            'Training objective',
            'Institution/ Training Provider Name',
            'Start time',
            'End time',
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
            'F' => 40,
            'G' => 25,
            'H' => 25,
            'I' => 25,
            'J' => 25,
        ];
    }

    public function map($employee_data): array
    {
        $this->counter++;
         $status = $employee_data->status;
         if($status == 0){
            $statuss = "In-Progress";
         }elseif($status == 1){
            $statuss = "Complted";
         }elseif($status == 2){
            $statuss = "Delayed";
         }
         
        return [
            $this->counter,
            $employee_data->user->name,
            $employee_data->user?->department->name,
            $employee_data->user?->job_title,
            $employee_data->description,
            $statuss,   
            $employee_data->description,   
            $employee_data->institution_or_training_provider,   
            $employee_data->start_time,   
            $employee_data->end_time,   
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:O1')
                                ->getFont()
                                ->setBold(true);
                                $cellRange = 'A1:H1'; 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
   
            },
        ];
    }

 
}
