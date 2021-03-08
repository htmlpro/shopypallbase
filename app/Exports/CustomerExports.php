<?php

namespace App\Exports;

use App\Models\Core\Customers;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customers::all();
    }
}
