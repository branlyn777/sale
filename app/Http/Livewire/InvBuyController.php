<?php

namespace App\Http\Livewire;

use App\Models\AdmSupplier;
use App\Models\invBuy;
use App\Models\invBuyDetail;
use App\Models\InvCategory;
use App\Models\InvProduct;
use App\Models\InvWarehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
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
    // Guarda el id de un producto
    public $product_id;
    // Guarda las categorias para los productos
    public $list_categories;

    // Variables para crear un proveedor
    public $name_supplier, $address, $phone_number_a, $phone_number_b, $mail, $other_details;
    // Variables para crear un producto
    public $name_product, $description, $price, $image, $barcode, $guarantee, $minimum_stock, $category_id;

    // Variables para el total cantidad y total bs del Shopping Cart
    public $total_items, $total_money;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        // Inicializa la colección como una instancia de Illuminate\Support\Collection
        $this->shoppingCart = collect([]);
        // Listando todas las sucursales
        $this->list_branches = $this->get_branches();
        $this->branch_id = $this->get_branch_id(Auth()->user()->id);
        $this->warehouse_id = 0;
        // Estableciendo el id del proveedor No definido
        $this->supplier_id = 1;
        // Estableciendo el id del proveedor No definido
        $this->product_id = 0;
        // Obtiniendo todas las categorias para crear un producto
        $this->list_categories = InvCategory::where("status","active")->orderBy("name_category")->get();
    }

    public function render()
    {
        $this->list_suppliers = AdmSupplier::where("status", "active")->get();
        // Listando los almacenes dependiendo de la sucursal seleccionada
        if ($this->branch_id != 0)
        {
            $this->list_warehouses = InvWarehouse::where("status", "active")
            ->where("inv_branch_id", $this->branch_id)
            ->get();

            // Verifica que el id seleccionado del almacen exista en la lista de almacenes
            $check_warehouse = false;
            // Buscando que el id alamcen seleccionado exista en la lista de almacenes
            if ($this->warehouse_id != 0)
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
                    $this->warehouse_id = 0;
                }
            }
        }
        else
        {
            $this->list_warehouses = InvWarehouse::where("status", "active")
            ->get();
        }
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
        foreach ($this->shoppingCart as $c)
        {
            $this->total_items = $this->total_items + $c['quantity'];
            $this->total_money = $this->total_money + ($c['quantity'] * $c['cost']);
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
    // Crea una nuevo proveedor
    public function create_supplier()
    {
        // Elimina espacios en blanco extras y reemplaza multiples espacios en blanco por un solo espacio
        $this->name_supplier = trim(preg_replace('/\s+/', ' ', $this->name_supplier));
        $this->mail = trim(preg_replace('/\s+/', ' ', $this->mail));
        $rules = [
            'name_supplier' => 'required|min:2|max:255|unique:adm_suppliers,name_supplier',
            'address' => 'max:255',
            'phone_number_a' => 'max:100',
            'phone_number_b' => 'max:100',
            'mail' => 'nullable|email|max:100',
            'other_details' => 'max:500'
        ];
        $messages = [
            'name_supplier.required' => 'El nombre del proveedor es requerido',
            'name_supplier.unique' => 'Ya existe el nombre del proveedor',
            'name_supplier.min' => 'El nombre del proveedor debe tener al menos 2 caracteres',
            'name_supplier.max' => 'El nombre del proveedor no debe pasar los 255 caracteres',
            'address.max' => 'El nombre del proveedor no debe pasar los 255 caracteres',
            'phone_number_a.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'phone_number_b.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'mail.email' => 'Inserte un correo válido',
            'mail.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'name_supplier.max' => 'El nombre del proveedor no debe pasar los 500 caracteres',
        ];
        $this->validate($rules, $messages);
        // Crea al proveedor y guarda el objeto creado en una variable
        $supplier = AdmSupplier::create([
            'name_supplier' =>  $this->name_supplier,
            'address' =>  $this->address,
            'phone_number_a' =>  $this->phone_number_a,
            'phone_number_b' =>  $this->phone_number_b,
            'mail' =>  $this->mail,
            'other_details' =>  $this->other_details
        ]);
        // Seleccionando el proveedor que se acaba de crear
        $this->supplier_id = $supplier->id;
        // Texto que se verá en el mensaje de tipo toast
        $text = "Proveedor '" . $supplier->name_supplier . "' creado y seleccionado exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Regresando las variables a su estado original
        $this->name_supplier = "";
        $this->address = null;
        $this->phone_number_a = null;
        $this->phone_number_b = null;
        $this->mail = null;
        $this->other_details = null;

        // Cierra la ventana modal
        $this->emit("hide-modal-supplier");
    }
    // Crea un producto
    public function create_product()
    {
        $rules = [
            'name_product' => 'required|min:2|max:255|unique:inv_products,name_product',
            'category_id' => 'not_in:0',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
            'barcode' => 'nullable|max:50',
            'guarantee' => 'nullable|numeric|max:1000|not_in:0',
            'minimum_stock' => 'nullable|numeric|max:30000|not_in:0'
        ];
        $messages = [
            'name_product.required' => 'El nombre del producto es requerido',
            'name_product.unique' => 'Ya existe el nombre del producto',
            'name_product.min' => 'El nombre del producto debe tener al menos 2 caracteres',
            'name_product.max' => 'El nombre del producto no debe pasar los 255 caracteres',
            'category_id.not_in' => 'Seleccione categoría',
            'price.required' => 'Precio requerido',
            'price.max' => 'Máximo 10 caracteres',
            'barcode.max' => 'Máximo 50 caracteres',
            'guarantee.numeric' => 'Debe ser un numero',
            'guarantee.max' => 'Máximo 1000 dias',
            'guarantee.not_in' => '0 no es un dato válido',
            'minimum_stock.numeric' => 'Debe ser un numero',
            'minimum_stock.max' => 'Máximo 30000 unidades',
            'minimum_stock.not_in' => '0 no es un dato válido',
        ];
        $this->validate($rules, $messages);

        // Elimina espacios en blanco extras y reemplaza multiples espacios por un solo espacio
        $this->name_product = trim(preg_replace('/\s+/', ' ', $this->name_product));
        $product = InvProduct::create([
            'name_product' =>  $this->name_product,
            'description' =>  $this->description,
            'price' =>  $this->price,
            'image' =>  $this->image,
            'barcode' =>  $this->barcode,
            'guarantee' =>  $this->guarantee,
            'minimum_stock' =>  $this->minimum_stock,
            'inv_categorie_id' =>  $this->category_id
        ]);
        // Verificando si se selecciono una imagen
        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/invProducts', $customFileName);
            $product->image  = $customFileName;
            $product->save();
        }
        else
        {
            $product->image  = "no-image.png";
            $product->save();
        }
        $this->image = null;
        $this->product_id = 0;
        $this->name_product = "";
        $this->description = "";
        $this->price = "";
        $this->barcode = "";
        $this->guarantee = null;
        $this->minimum_stock = null;
        $this->category_id = 0;
        // Añadiendo el producto al Shopping Cart
        $this->cart_add($product->id);
        $this->emit("hide-modal-product");
    }
    // Realiza la compra
    public function buy()
    {
        // Creando la compra
        $buy = invBuy::create([
            'total' =>  $this->total_money,
            'items' =>  $this->total_items,
            'inv_branch_id' => $this->branch_id,
            'adm_supplier_id' =>  $this->supplier_id,
            'user_id' =>  Auth()->user()->id
        ]);
        foreach ($this->shoppingCart as $b)
        {
            // Creando detalle de la compra
            $buy_details = invBuyDetail::create([
                'cost' =>  $b['cost'],
                'price' =>  $b['price'],
                'quantity' =>  $b['quantity'],
                'inv_product_id' =>  $b['id'],
                'inv_buy_id' =>  $buy->id
            ]);
        }
        // Cerrando la ventana modal
        $this->emit("hide-modal-finalize-buy");
    }
}
