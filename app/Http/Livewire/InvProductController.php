<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvInventory;
use App\Models\InvProduct;
use App\Models\InvWarehouse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class InvProductController extends MethodsController
{
    // Guarda los terminos de busqueda para encontrar una categoria
    public $search;
    // Variables para crear o editar un producto
    public $name_product, $description, $price, $image, $barcode, $guarantee, $minimum_stock, $category_id;
    // Guarda el id de un producto
    public $product_id;
    // Guarda el id de la sucursal seleccionada
    public $branch_id;
    // Guarda el id del almacen seleccionado
    public $warehouse_id;
    // Guarda true o false para mostrar productos activos o inactivos
    public $status;
    // Guarda las categorias para los productos
    public $list_categories;
    // Guarda las sucursales activas
    public $list_branches;
    // Guarda los almacenes activos
    public $list_warehouses;
    // Guarda true o false para eliminar o inactivar un producto
    public $delete_cancel;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->product_id = 0;
        $this->status = "active";
        $this->category_id = 0;
        $this->list_categories = InvCategory::where("status","active")->orderBy("name_category")->get();
        $this->branch_id = $this->get_branch_id(Auth()->user()->id);
        $this->warehouse_id = "all";
        $this->list_branches = $this->get_branches();
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

        if (strlen($this->search) == 0)
        {
            $products = InvProduct::select("inv_products.*", DB::raw('0 as quantity'))
            ->where("status", $this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $products = InvProduct::select("inv_products.*", DB::raw('0 as quantity'))
            ->where("status", $this->status)
            ->where('name_product', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
        }

        // Obteniendo la cantidad del producto
        foreach($products as $p)
        {
            $p->quantity = $this->get_quantity($p->id);
        }

        return view('livewire.template.inventory.product.product', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Product (Para Crear o Actualizar)
    public function showModalProduct($id)
    {
        if ($id == 0)
        {
            $this->product_id = 0;
            $this->name_product = "";
            $this->description = "";
            $this->price = "";
            $this->barcode = "";
            $this->guarantee = null;
            $this->minimum_stock = null;
            $this->category_id = 0;
        }
        else
        {
            $product = InvProduct::find($id);
            $this->name_product = $product->name_product;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->barcode = $product->barcode;
            $this->guarantee = $product->guarantee;
            $this->minimum_stock = $product->minimum_stock;
            // Verificando que el producto del producto no esté inactivada
            $category = InvCategory::find($product->inv_categorie_id);
            // Si el producto esta inactivada se añade a la lista de categorias
            if ($category->status == "inactive")
            {
                $this->list_categories->push($category);
            }
            else
            {
                $this->list_categories = InvCategory::where("status","active")->orderBy("name_category")->get();
            }
            $this->category_id = $product->inv_categorie_id;
            $this->product_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-product");
    }
    // Crea un producto
    public function create_product()
    {
        $rules = [
            'name_product' => 'required|min:2|max:255|unique:inv_products,name_product',
            'category_id' => 'not_in:0',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
            'barcode' => 'nullable|max:50',
            'guarantee' => 'nullable|numeric|max:1000'
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
            'guarantee.max' => 'Máximo 1000 caracteres',
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
        $this->resetUi();
        $this->emit("hide-modal-product");
    }
    // Actualiza un producto
    public function update_product()
    {
        $rules = [
            'name_product' => 'required|min:2|max:255',
            'category_id' => 'not_in:0',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
            'barcode' => 'nullable|max:50',
            'guarantee' => 'nullable|numeric|max:1000'
        ];
        $messages = [
            'name_product.required' => 'El nombre del producto es requerido',
            'name_product.min' => 'El nombre del producto debe tener al menos 2 caracteres',
            'name_product.max' => 'El nombre del producto no debe pasar los 255 caracteres',
            'category_id.not_in' => 'Seleccione categoría',
            'price.required' => 'Precio requerido',
            'price.max' => 'Máximo 10 caracteres',
            'barcode.max' => 'Máximo 50 caracteres',
            'guarantee.numeric' => 'Debe ser un numero',
            'guarantee.max' => 'Máximo 1000 caracteres',
        ];
        $this->validate($rules, $messages);

        // Elimina espacios en blanco extras y reemplaza multiples espacios por un solo espacio
        $this->name_product = trim(preg_replace('/\s+/', ' ', $this->name_product));
        // Busca el producto y lo guarda en una variable
        $product = InvProduct::find($this->product_id);
        // Actualiza el producto
        $product->update([
            'name_product' =>  $this->name_product,
            'description' =>  $this->description,
            'price' =>  $this->price,
            'barcode' =>  $this->barcode,
            'guarantee' =>  $this->guarantee,
            'minimum_stock' =>  $this->minimum_stock,
            'inv_categorie_id' =>  $this->category_id
        ]);
        $product->save();
         // Verificando si se selecciono una imagen
         if($this->image)
         {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/invProducts', $customFileName);
            $product->image  = $customFileName;
            $product->save();
         }
        // Texto que se verá en el mensaje de tipo toast
        $text = "Categoriá '" . $product->name_category . "' actualizada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-product");
    }
    // Verifica si un producto tiene registros con su id y muestra una alerta para inactivar o eliminar el producto
    public function check_product(InvProduct $product)
    {
        // Buscando productos que tengan el id del producto en los inventarios
        $productCount = InvInventory::where('inv_product_id', $product->id)->exists();
        // Buscando que el producto no tenga ventas a su nombre
        // ------------------------------------
        // Cambia los parámetros de la alerta dependiendo si la variable productCount tiene registros
        if ($productCount)
        {
            $alert_title = "¿Inactivar Producto?";
            $alert_text = "El producto '" . $product->name_product . "' tiene registros que usan su nombre, por lo cual no puede ser eliminada, pero puede ser inactivada para que ya no pueda ser usado.";
            $alert_confirmButtonText = "Inactivar";
            $alert_icon = "warning";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Producto?";
            $alert_text = "El producto '" . $product->name_product . "' no es usado en ningun registro por lo cual puede ser eliminado.";
            $alert_confirmButtonText = "Eliminar";
            $alert_icon = "question";
            $this->delete_cancel = true;
        }
        // Emite un mensaje de tipo alerta
        $this->emit("alert", [
            'title' => $alert_title,
            'text' => $alert_text,
            'icon' => $alert_icon,
            'confirmButtonText' => $alert_confirmButtonText,
            'cancelButtonText' => "Cancelar",
            'id' => $product->id
        ]);
    }
    // Obtiene la cantidad disponoble de un determinado producto (Dependiendo de la sucursal y el almacen)
    public function get_quantity($product_id)
    {
        if ($this->branch_id != "all")
        {
            if ($this->warehouse_id == "all")
            {
                $quantity = InvInventory::join("inv_warehouses as w", "w.id", "inv_inventories.inv_warehouse_id")
                ->select("inv_inventories.quantity as quantity")
                ->where("w.inv_branch_id", $this->branch_id)
                ->where("inv_inventories.inv_product_id", $product_id)
                ->get();
            }
            else
            {
                $quantity = InvInventory::join("inv_warehouses as w", "w.id", "inv_inventories.inv_warehouse_id")
                ->select("inv_inventories.quantity as quantity")
                ->where("w.inv_branch_id", $this->branch_id)
                ->where("inv_inventories.inv_warehouse_id", $this->warehouse_id)
                ->where("inv_inventories.inv_product_id", $product_id)
                ->get();
            }
        }
        else
        {
            if ($this->warehouse_id == "all")
            {
                $quantity = InvInventory::join("inv_warehouses as w", "w.id", "inv_inventories.inv_warehouse_id")
                ->select("inv_inventories.quantity as quantity")
                ->where("inv_inventories.inv_product_id", $product_id)
                ->get();
            }
            else
            {
                $quantity = InvInventory::join("inv_warehouses as w", "w.id", "inv_inventories.inv_warehouse_id")
                ->select("inv_inventories.quantity as quantity")
                ->where("inv_inventories.inv_warehouse_id", $this->warehouse_id)
                ->where("inv_inventories.inv_product_id", $product_id)
                ->get();
            }
        }

        $total_quantity = $quantity->sum('quantity');

        if ($total_quantity == 0)
        {
            $total_quantity = "Agotado";
        }

        return $total_quantity;
    }
    // Resetea todas las variables
    public function resetUi()
    {
        $this->image = null;
    }
    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'deleteProduct' => 'delete_product'
    ];
    // Elimina o inactiva una categoría
    public function delete_product($product_id)
    {
        $product = InvProduct::find($product_id);
        $name_product = $product->name_product;
        if ($this->delete_cancel)
        {
            $product->delete();
            $text = "¡Producto '" . $name_product . "' eliminado exitósamente!";

            // Eliminando la imagen del producto (si lo tuviera)
            $imageTemp = $product->image;
            if ($imageTemp != null)
            {
                if (file_exists('storage/invProducts/' . $imageTemp))
                {
                    unlink('storage/invProducts/' . $imageTemp);
                }
            }
        }
        else
        {
            $product->update([
                'status' => "inactive"
            ]);
            $product->save();
            $text = "¡Producto '" . $name_product . "' inactivado exitósamente!";
        }
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
    }
}
