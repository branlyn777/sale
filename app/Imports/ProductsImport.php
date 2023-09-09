<?php

namespace App\Imports;

use App\Models\InvProduct;
use App\Models\InvProductphp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = InvProduct::create([
            'name_product' =>  $row['nombre'],
            'description' =>  $row['descripcion'],
            'price' =>  $row['precio'],
            'image' =>  "sadf.png",
            'barcode' =>  $row['barcode'],
            'guarantee' =>  10,
            'minimum_stock' =>  10,
            'inv_categorie_id' =>  $row['categoria']
        ]);
        $product->save();
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
