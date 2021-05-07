<?php

namespace App\Imports;

use App\Models\Registry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class RegistryImport implements ToModel, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Registry([
            'company_name' => $row[0],
            'address' => $row[1],
            'postcode' => $row[2],
            'city' => $row[3],
            'district' => $row[4],
            'region' => $row[5],
            'email' => $row[6],
        ]);
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

    public function rules(): array
    {
        return [
            // 0 => (['email']),
            // 'company_name' => ['required', 'min:2', 'max:150'],
            // 'address' => ['required', 'min:5', 'max:255'],
            // 'postcode' => ['required', 'min:5', 'max:25'], //Hp. string supposed European Customer
            // 'city' => ['required', 'min:2', 'max:50'],
            // 'district' => ['required', 'min:2', 'max:150'],
            // 'region' => ['required', 'min:2', 'max:150'],
            // 'email' => ['required', 'email', 'min:7', 'max:150', 'un/ique:App\Models\Registry,email'],
        ];
    }
}
