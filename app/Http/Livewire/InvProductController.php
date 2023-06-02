<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class InvProductController extends Component
{
    // Guarda los terminos de busqueda para encontrar una categoria
    public $search;
    // Variables para crear o editar un producto
    public $name_product, $description, $price, $image, $barcode, $guarantee, $minimum_stock, $category_id;
    // Guarda el id de un producto
    public $product_id;
    // Guarda true o false para mostrar productos activos o inactivos
    public $status;
    // Guarda las categorias para los productos
    public $list_categories;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->product_id = 0;
        $this->status = "active";
        $this->category_id = 0;
        $this->list_categories = InvCategory::where("status","active")->get();
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $products = InvProduct::where("status",$this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $products = InvProduct::where("status",$this->status)
            ->where('name_product', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        return view('livewire.inventories.products.invproduct', [
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
        }
        else
        {
            $product = InvProduct::find($id);
            $this->name_product = $product->name_product;
            $this->price = $product->price;
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
            'price' => 'required',
        ];
        $messages = [
            'name_product.required' => 'El nombre del producto es requerido',
            'name_product.unique' => 'Ya existe el nombre del producto',
            'name_product.min' => 'El nombre del producto debe tener al menos 2 caracteres',
            'name_product.max' => 'El nombre del producto no debe pasar los 255 caracteres',
            'category_id.not_in' => 'Seleccione categoría',
            'price.required' => 'Precio requerido'
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
    // Resetea todas las variables
    public function resetUi()
    {
        $this->image = null;
    }
}
