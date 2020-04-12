<?php

namespace App\Exports;

use App\Greetingimg;
use Maatwebsite\Excel\Concerns\FromCollection;

class GreetingimgExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Greetingimg::get(["id","title"]);
    }
}