<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::select('id','name','email','phone_number','address')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Họ tên',
            'Email',
            'Số điện thoại',
            'Địa chỉ'
        ];
    }
}
