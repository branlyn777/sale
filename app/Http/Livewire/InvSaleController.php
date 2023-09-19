<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use App\Models\TxnPaymentsType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InvSaleController extends MethodsController
{
    // Guarda los terminos de busqueda para encontrar un producto
    public $search;
    // Guarda los tipos de pagos disponibles
    public $list_payments_types;
    // Guarda el id de la sucursal
    public $branch_id;
    // Guarda el id del tipo de pago seleccionado
    public $payment_type_id;
    // Variables para el total cantidad y total bs del Shopping Cart
    public $total_items, $total_money;
    // Variable que guardará los productos para vender
    public $salesCart;
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        
        // Inicializa la colección como una instancia de Illuminate\Support\Collection
        $this->salesCart = collect([]);

        // Obtieniendo la sucursal del usuario
        $this->branch_id = $this->get_branch_id(Auth()->user()->id);
        // Obteniendo los tipos de pagos disponibles
        $this->list_payments_types = TxnPaymentsType::join("txn_cash_registers as cr", "cr.id","txn_payments_types.txn_cash_registers_id")
        ->where("cr.inv_branch_id", $this->branch_id
        )->get();
    }
    public function render()
    {

        // Mostrando los productos dependiendo los términos de búsqueda
        $products = [];
        if (strlen($this->search) > 0)
        {
            $products = InvProduct::where("status", "active")
            ->where('name_product', 'like', '%' . $this->search . '%')
            ->paginate(10);
        }
        // Obteniendo el total cantidad y total bs del Shopping Cart
        $this->total_items = 0;
        $this->total_money = 0;
        foreach ($this->salesCart as $c)
        {
            $this->total_items = $this->total_items + $c['quantity'];
            $this->total_money = $this->total_money + ($c['quantity'] * $c['price']);
        }
        return view('livewire.template.sale.sale.sale', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Añade un producto al Shopping Cart
    public function cart_add($id)
    {
        // Verificando que el producto esté en el Shopping Cart
        $existingProduct = $this->salesCart->firstWhere('id', $id);
        // Si el producto existe se actualizará la cantidad
        if ($existingProduct)
        {
            $productIndex = $this->salesCart->search(function ($item) use ($id)
            {
                return $item['id'] === $id;
            });
        
            if ($productIndex !== false)
            {
                // $productIndex contiene el índice (array key) del producto en la colección
                $product_backup = $this->salesCart[$productIndex];
                // Eliminando el producto
                $this->salesCart->forget($productIndex);

                $new_quantity = $product_backup['quantity'] + 1;

                // Añadiendo el producto al Shopping Cart
                $this->salesCart->push([
                    'id' => $product_backup['id'],
                    'name_product' => $product_backup['name_product'],
                    'quantity' => $new_quantity,
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
            $this->salesCart->push([
                'id' => $product->id,
                'name_product' => $product->name_product,
                'quantity' => 1,
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
     // Decrementa la cantidad de un producto del Shopping Cart
     public function cart_decrease($id)
     {
         // Verificando que el producto esté en el Shopping Cart
         $existingProduct = $this->salesCart->firstWhere('id', $id);
         // Si el producto existe se actualizará la cantidad
         if ($existingProduct)
         {
             $productIndex = $this->salesCart->search(function ($item) use ($id)
             {
                 return $item['id'] === $id;
             });
         
             if ($productIndex !== false)
             {
                 // $productIndex contiene el índice (array key) del producto en la colección
                 $product_backup = $this->salesCart[$productIndex];
                 // Eliminando el producto
                 $this->salesCart->forget($productIndex);
 
                 $new_quantity = $product_backup['quantity'] - 1;
                 // El producto no se añadirá si la cantidad es menor a 1
                 if ($new_quantity > 0)
                 {
                     // Añadiendo el producto al Shopping Cart
                     $this->salesCart->push([
                         'id' => $product_backup['id'],
                         'name_product' => $product_backup['name_product'],
                         'quantity' => $new_quantity,
                         'price' => $product_backup['price'],
                         'image' => $product_backup['image'],
                         'created_at' => $product_backup['created_at'],
                     ]);
                 }
             }
             // Texto que se mostrará en un mensaje toast
             $text = "Se decremento 1 unidad";
             // Emite un mensaje de tipo toast
             $this->emit("toast", [
                 'text' => $text,
                 'timer' => 3000,
                 'icon' => "success"
             ]);
         }
     }
     // Eliminsa un producto del Shopping Cart
     public function cart_delete($id)
     {
         // Buscando el producto en el Shopping Cart
         $product = $this->salesCart->firstWhere('id', $id);
 
         $productIndex = $this->salesCart->search(function ($item) use ($id)
         {
             return $item['id'] === $id;
         });
     
         if ($productIndex !== false)
         {
             $this->salesCart->forget($productIndex);
             // Emite un mensaje de tipo toast
             $this->emit("toast", [
                 'text' => "¡" . $product['name_product'] . " eliminado exitosamente!",
                 'timer' => 3000,
                 'icon' => "success"
             ]);
         }
            
     }
     // Cambia la cantidad de un producto del Shopping Cart
     public function change_quantity($id, $new_quantity)
     {
         // Verificando que el valor recibido sea mayor a 0
         if ($new_quantity > 0)
         {
             // Verificando que el producto esté en el Shopping Cart
             $existingProduct = $this->salesCart->firstWhere('id', $id);
             // Si el producto existe se actualizará la cantidad
             if ($existingProduct)
             {
                 $productIndex = $this->salesCart->search(function ($item) use ($id)
                 {
                     return $item['id'] === $id;
                 });
             
                 if ($productIndex !== false)
                 {
                     // $productIndex contiene el índice (array key) del producto en la colección
                     $product_backup = $this->salesCart[$productIndex];
                     // Eliminando el producto
                     $this->salesCart->forget($productIndex);
                     // Añadiendo el producto al Shopping Cart
                     $this->salesCart->push([
                         'id' => $product_backup['id'],
                         'name_product' => $product_backup['name_product'],
                         'quantity' => $new_quantity,
                         'price' => $product_backup['price'],
                         'image' => $product_backup['image'],
                         'created_at' => $product_backup['created_at'],
                     ]);
                     // Emite un mensaje de tipo toast
                     $this->emit("toast", [
                         'text' => "¡Cantidad Actualizada! Producto: " . $product_backup['name_product'],
                         'timer' => 3000,
                         'icon' => "success"
                     ]);
                 }
             }
         }
     }
     // Cambia el precio de un producto del Shopping Cart
     public function change_price($id, $new_price)
     {
         // Verificando que el valor recibido sea mayor a 0
         if ($new_price > 0)
         {
             // Verificando que el producto esté en el Shopping Cart
             $existingProduct = $this->salesCart->firstWhere('id', $id);
             // Si el producto existe se actualizará la cantidad
             if ($existingProduct)
             {
                 $productIndex = $this->salesCart->search(function ($item) use ($id)
                 {
                     return $item['id'] === $id;
                 });
 
                 if ($productIndex !== false)
                 {
                     // $productIndex contiene el índice (array key) del producto en la colección
                     $product_backup = $this->salesCart[$productIndex];
                     // Eliminando el producto
                     $this->salesCart->forget($productIndex);
                     // Añadiendo el producto al Shopping Cart
                     $this->salesCart->push([
                         'id' => $product_backup['id'],
                         'name_product' => $product_backup['name_product'],
                         'quantity' => $product_backup['quantity'],
                         'price' => $new_price,
                         'image' => $product_backup['image'],
                         'created_at' => $product_backup['created_at'],
                     ]);
                     // Emite un mensaje de tipo toast
                     $this->emit("toast", [
                         'text' => "Precio Actualizado! Producto: " . $product_backup['name_product'],
                         'timer' => 3000,
                         'icon' => "success"
                     ]);
                 }
             }
         }
     }
     // Escucha eventos javascript de la vista
     protected $listeners = [
         'clean-cart' => 'cart_clean',
     ];
     // Vacia el Shopping Cart
     public function cart_clean()
     {
         $this->salesCart = collect([]);
          // Emite un mensaje de tipo toast
          $this->emit("toast", [
             'text' => "¡Carrito de Compras vaciado exitósamente!",
             'timer' => 3000,
             'icon' => "success"
         ]);
     }
}
