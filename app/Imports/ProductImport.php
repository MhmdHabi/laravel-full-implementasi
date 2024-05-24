<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    protected $user;
    /**
     * @param Collection $collection
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection(collection $collection)
    {
        foreach ($collection as $row) {
            Product::create([
                'image' => '/storage/images/1715963104_60316.jpg',
                'user_id' => $this->user->id,
                'name' => $row['nama_produk'],
                'weight' => $row['berat'],
                'stock' => $row['stok'],
                'price' => $row['harga'],
                'condition' => $row['kondisi'],
                'description' => $row['deskripsi'],
            ]);
        }
        return $collection;
    }
}
