<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvProduct;
use Livewire\Component;
use Livewire\WithPagination;

class InvCategorieController extends Component
{
    // Guarda el nombre de la categoria para Crear o Editar
    public $name_category;


    // Guardan un mensaje para una notificación de tipo toast
    public $toast_message;
    // Guardan un mensaje para una alerta
    public $alert_message;
    // Guarda el titulo para una alerta
    public $alert_title;
    // Guarda el nombre boton para una alerta
    public $alert_name_button;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $categories = InvCategory::where("status","active")->orderBy("created_at","desc")->paginate(10);
        return view('livewire.inventories.categories.categorie', [
            'categories' => $categories
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Categories
    public function showModalCategories()
    {
        $this->emit("show-modal-categorie");
    }
    // Crea una nueva categoria
    public function create_category()
    {
        $rules = [
            'name_category' => 'required|min:3|unique:inv_categories,name',
            'name_category' => 'required|max:255|unique:inv_categories,name'
        ];
        $messages = [
            'name_category.required' => 'El nombre de la categoría es requerido',
            'name_category.unique' => 'Ya existe el nombre de la categoría',
            'name_category.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name_category.max' => 'El nombre de la categoría no debe pasar los 255 caracteres'
        ];
        $this->validate($rules, $messages);

        InvCategory::create([
            'name' =>  $this->name_category
        ]);

        $this->emit("hide-modal-categorie");
    }
    // Verifica si una categoria tiene registros con su id
    public function check_category(InvCategory $category)
    {
        // Buscando productos que tengan el id de la categoria
        $products = InvProduct::where("inv_categorie_id", $category->id)->get();
        if($products->count() > 0)
        {
            $this->alert_title = "¿Inactivar Categoria?";
            $this->alert_name_button = "Inactivar";
            $this->alert_message = "La categoria '" . $category->name_category . "' tiene ". $products->count() ." productos a su nombre, por lo cual no puede ser eliminada, pero si puede ser inactivada.";
        }
        else
        {
            $this->alert_title = "¿Eliminar Categoria?";
            $this->alert_name_button = "Eliminar";
            $this->alert_message = "La categoria '" . $category->name_category . "' no tiene ningun producto a su nombre, por lo cual puede ser eliminada.";
        }
        $this->emit("alert-category");
    }
}
