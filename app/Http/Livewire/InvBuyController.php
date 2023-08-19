<?php

namespace App\Http\Livewire;

use App\Models\AdmSupplier;
use App\Models\InvProduct;
use App\Models\InvWarehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InvBuyController extends MethodsController
{
    // Guarda los terminos de busqueda para encontrar un producto
    public $search;
    // Variable que guardará los productos para comprar
    public $shoppingCart;
    // Guarda las sucursales activas
    public $list_branches;
    // Guarda el id de la sucursal seleccionada
    public $branch_id;
    // Guarda el id del almacen seleccionado
    public $warehouse_id;
    // Guarda los almacenes activos
    public $list_warehouses;
    // Guarda los proveedores activos
    public $list_suppliers;
    // Guarda el id del proveedor seleccionado
    public $supplier_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        // Inicializa la colección como una instancia de Illuminate\Support\Collection
        $this->shoppingCart = collect([]);
        // Listando todas las sucursales
        $this->list_branches = $this->get_branches();
        $this->branch_id = $this->get_branch_id(Auth()->user()->id);
        $this->warehouse_id = "all";
        $this->list_suppliers = AdmSupplier::where("status", "active")->get();
        $this->supplier_id = 0;
    }

    public function render()
    {
        // Listando los almacenes dependiendo de la sucursal seleccionada
        if ($this->branch_id != "all")
        {
            $this->list_warehouses = InvWarehouse::where("status", "active")
            ->where("inv_branch_id", $this->branch_id)
            ->get();

            // Verifica que el id seleccionado del almacen exista en la lista de almacenes
            $check_warehouse = false;
            // Buscando que el id alamcen seleccionado exista en la lista de almacenes
            if ($this->warehouse_id != "all")
            {
                foreach ($this->list_warehouses as $w)
                {
                    if ($w->id == $this->warehouse_id)
                    {
                        $check_warehouse = true;
                    }
                }
                // Si el id almacen no existe en la lista de almacenes se pondrá la selección Todos
                if (!$check_warehouse)
                {
                    $this->warehouse_id = "all";
                }
            }
        }
        else
        {
            $this->list_warehouses = InvWarehouse::where("status", "active")
            ->get();
        }
        if (strlen($this->search) > 0)
        {
            $products = InvProduct::where("status", "active")
            ->where('name_product', 'like', '%' . $this->search . '%')
            ->paginate(5);
        }
        else
        {
            $products = InvProduct::where("status", "activo")->paginate(5);
        }

        return view('livewire.template.inventory.buy.buy', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Añade un producto al Shopping Cart
    public function cart_add($id)
    {
        // Verificando que el producto esté en el Shopping Cart
        $existingProduct = $this->shoppingCart->firstWhere('id', $id);
        // Si el producto existe se actualizará la cantidad
        if ($existingProduct)
        {
            $productIndex = $this->shoppingCart->search(function ($item) use ($id)
            {
                return $item['id'] === $id;
            });
        
            if ($productIndex !== false)
            {
                // $productIndex contiene el índice (array key) del producto en la colección
                $product_backup = $this->shoppingCart[$productIndex];
                
                $this->shoppingCart->forget($productIndex);

                $new_quantity = $product_backup['quantity'] + 1;

                // Añadiendo el producto al Shopping Cart
                $this->shoppingCart->push([
                    'id' => $product_backup['id'],
                    'name_product' => $product_backup['name_product'],
                    'quantity' => $new_quantity,
                    'cost' => $product_backup['cost'],
                    'price' => $product_backup['price'],
                    'image' => $product_backup['image'],
                    'created_at' => $product_backup['created_at'],
                ]);
                
            }
            // Texto que se mostrará en un mensaje toast
            $text = "Producto actualizado exitosamente";
        }
        else
        {
            // Buscando el producto
            $product = InvProduct::find($id);
            // Añadiendo el producto al Shopping Cart
            $this->shoppingCart->push([
                'id' => $product->id,
                'name_product' => $product->name_product,
                'quantity' => 1,
                'cost' => 10,
                'price' => $product->price,
                'image' => $product->image,
                'created_at' => Carbon::parse(Carbon::now())->format('Y-m-d H:i:s'),
            ]);
            // Texto que se mostrará en un mensaje toast
            $text = "Producto añadido exitosamente";
        }

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
    }
    // Eliminsa un producto del Shopping Cart
    public function cart_delete($id)
    {
        // Buscando el producto en el Shopping Cart
        $product = $this->shoppingCart->firstWhere('id', $id);

        $productIndex = $this->shoppingCart->search(function ($item) use ($id)
        {
            return $item['id'] === $id;
        });
    
        if ($productIndex !== false)
        {
            $this->shoppingCart->forget($productIndex);
            // Emite un mensaje de tipo toast
            $this->emit("toast", [
                'text' => "¡" . $product['name_product'] . " eliminado exitosamente!",
                'timer' => 3000,
                'icon' => "success"
            ]);
        }
           
    }
}
