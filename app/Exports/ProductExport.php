<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Product::select('id', 'name', 'price', 'stock', 'weight', 'condition', 'description')->get();
        return $query;
    }

    public function handlings(): array
    {
        $heading = [
            'ID',
            'Nama',
            'Harga',
            'Stok',
            'Berat',
            'Kondisi',
            'Deskripsi'
        ];
        return $heading;
    }
}
