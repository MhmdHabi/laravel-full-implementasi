<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::select(
            'name',
            'email',
            'gender',
            'age',
            'birth',
            'address',
        )->get();
        return $query;
    }

    public function handlings(): array
    {
        $heading = [
            'Nama',
            'Email',
            'Gender',
            'Umur',
            'Tanggal_lahir',
            'Alamat'
        ];
        return $heading;
    }
}
