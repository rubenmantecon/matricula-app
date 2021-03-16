<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersImport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }


    /*public function model(array $row)
    {
        return new Term([
            'name' => $row['NOM_CICLE_FORMATIU'],
            
        ]);
    }*/
}
