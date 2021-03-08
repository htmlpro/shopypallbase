<?php

namespace App\Exports;

use App\Models\Core\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExports implements FromCollection ,  WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('first_name','last_name','email','phone')->where('role_id','2')->get();
    }
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Phone',
        ];
    }
}
