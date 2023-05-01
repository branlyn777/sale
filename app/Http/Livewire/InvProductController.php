<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvProduct;
use Livewire\Component;
use Livewire\WithPagination;

class InvProductController extends Component
{
    // Guarda los terminos de busqueda para encontrar una categoria
    public $search;
    // Guarda el nombre de un producto para Crear o Editar
    public $name_product;
    // Guarda el id de un producto
    public $product_id;
    // Guarda true o false para mostrar productos activos o inactivos
    public $status;
    // Guarda las categorias para los productos
    public $list_categories;
    // Guarda el id de una categoria
    public $category_id;

    use WithPagination;
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
        ];
        $messages = [
            'name_product.required' => 'El nombre del producto es requerido',
            'name_product.unique' => 'Ya existe el nombre del producto',
            'name_product.min' => 'El nombre del producto debe tener al menos 2 caracteres',
            'name_product.max' => 'El nombre del producto no debe pasar los 255 caracteres',
            'category_id.not_in' => 'Seleccione Categoría'
        ];
        $this->validate($rules, $messages);
    }
}
