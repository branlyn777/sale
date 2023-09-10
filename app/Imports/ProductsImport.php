<?php

namespace App\Imports;

use App\Models\InvProduct;
use App\Models\InvProductphp;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithCalculatedFormulas
{
    protected $importedProducts;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct()
    {
        $this->importedProducts = new Collection();
    }
    public function model(array $row)
    {
        // Crear un producto y agregarlo a la colección $importedProducts
        $this->importedProducts->push([
            'name_product' => $row['nombre'],
            'description' => $row['descripcion'],
            'price' => $row['precio'],
            'barcode' => $row['barcode'],
            'category' => $row['categoria'],
            'warehouses' => $row['almacen'],
            'quantity' => $row['cantidad']
        ]);
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function getImportedProducts(): Collection
    {
        return $this->importedProducts;
    }
}
