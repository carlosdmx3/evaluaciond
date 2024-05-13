<?php

namespace App\Imports;

use App\Models\Registros;
use Maatwebsite\Excel\Concerns\ToModel;

class RegistrosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Registros([
            //
        ]);
    }
}
