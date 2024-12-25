<?php

namespace App\Exports;

use App\Models\Language;
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

class EmployeesExport implements FromCollection,WithEvents,WithColumnWidths,WithHeadings,WithMapping

{
    private $counter = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return User::with('department', 'languagesEmp',  'reportingTo', 'manager','skills','education','county','EmergencyContact')
                   ->get();
       
    }

    public function headings(): array
    {
        return [
            'S.No.',
            'Name',
            'Email',
            'Department',
            'Employment start',
            'Reporting to',
            'Manager id',
            'd_o_b',
            'Employee code',
            'Phone number',
            'Gender',
            'Nationality',
            'Emergency contact',
            'Language id',
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
            'F' => 25,
            'G' => 25,
            'H' => 25,
            'I' => 25,
            'J' => 25,
            'K' => 25,
            'L' => 25,
            'M' => 25,
            'N' => 25,
            'O' => 25,
        ];
    }

    public function map($employee_data): array
    { 
        $this->counter++;


       $lan_name = [];
       foreach($employee_data->languagesEmp as $value){
         $lan_name[] = $value->name;
        
        } 
        $data = implode(',',$lan_name);
    
        return [
            $this->counter,
            $employee_data->name,
            $employee_data->email,
            @$employee_data->department->name,
            @$employee_data->employment_start,
            $employee_data->reportingTo->name,
            @$employee_data->manager->name,
            $employee_data->d_o_b,
            $employee_data->employee_code,
            $employee_data->phone_number,
            $employee_data->gender,
            @$employee_data->county->name,
            $data
         
        ];
    }

  

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:O1')
                                ->getFont()
                                ->setBold(true);
                                $cellRange = 'A1:N1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
   
            },
        ];
    }

 
}
