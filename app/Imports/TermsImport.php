<?php

namespace App\Imports;

use App\Term;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class TermsImport implements FromCollection
{
    public function collection()
    {
        return Term::all();
    }


    /*public function model(array $row)
    {
        return new Term([
            'name' => $row['NOM_CICLE_FORMATIU'],
            
        ]);
    }*/
}
