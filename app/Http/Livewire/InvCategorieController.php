<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvProduct;
use GuzzleHttp\Psr7\Message;
use Livewire\Component;
use Livewire\WithPagination;

class InvCategorieController extends Component
{
    // Guarda los terminos de busqueda para encontrar una categoria
    public $search;
    // Guarda el nombre de la categoria para Crear o Editar
    public $name_category;
    // Guarda el id de la categoria
    public $category_id;

    // Guardan un mensaje para una notificación de tipo toast
    public $toast_message;

    // Variable que almacena parametros de una alerta
    public $parameters_alert = [
        'title' => '',
        'message' => '',
        'button' => '',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->category_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $categories = InvCategory::where("status","active")->orderBy("created_at","desc")->paginate(10);
        }
        else
        {
            $categories = InvCategory::where("status","active")->where('name_category', 'like', '%' . $this->search . '%')->orderBy("created_at","desc")->paginate(10);
        }
        return view('livewire.inventories.categories.categorie', [
            'categories' => $categories
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Categories (Para Crear o Actualizar)
    public function showModalCategories($id)
    {
        if ($id == 0)
        {
            $this->category_id = 0;
            $this->name_category = "";
        }
        else
        {
            $categorie = InvCategory::find($id);
            $this->name_category = $categorie->name_category;
            $this->category_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-categorie");
    }
    // Crea una nueva categoria
    public function create_category()
    {
        $rules = [
            'name_category' => 'required|min:2|max:255|unique:inv_categories,name_category',
        ];
        $messages = [
            'name_category.required' => 'El nombre de la categoría es requerido',
            'name_category.unique' => 'Ya existe el nombre de la categoría',
            'name_category.min' => 'El nombre de la categoría debe tener al menos 2 caracteres',
            'name_category.max' => 'El nombre de la categoría no debe pasar los 255 caracteres'
        ];
        $this->validate($rules, $messages); 
        // Elimina espacios en blanco extras y reemplaza multiples espacios por un solo espacio
        $this->name_category = trim(preg_replace('/\s+/', ' ', $this->name_category));
        InvCategory::create([
            'name_category' =>  $this->name_category
        ]);
        $this->emit("hide-modal-categorie");
    }
    // Actualiza una categoría
    public function update_category()
    {
        $category = InvCategory::find($this->category_id);
        $category->update([
            'name_category' => $this->name_category
        ]);
        $category->save();
        $this->emit("hide-modal-categorie");
    }
    // Verifica si una categoria tiene registros con su id y muestra una alerta para inactivar o eliminar la categoria
    public function check_category(InvCategory $category)
    {
        // Buscando productos que tengan el id de la categoria
        $products = InvProduct::where("inv_categorie_id", $category->id)->get();
        if ($products->count() > 0)
        {
            $alert_title = "¿Inactivar Categoría?";
            $alert_message = "La categoría '" . $category->name_category . "' tiene " . $products->count() . " productos que usan su nombre, por lo cual no puede ser eliminada.";
            $alert_button = "Inactivar";
        }
        else
        {
            $alert_title = "¿Eliminar Categoría?";
            $alert_message = "La categoría '" . $category->name_category . "' no tiene ningun producto a su nombre, por lo cual puede ser eliminada.";
            $alert_button = "Eliminar";
        }
        // Actualizando parámetros de la alerta
        $this->update_parameters_alert($alert_title, $alert_message, $alert_button);
        $this->emit("alert-category");
    }
    // Función que actualiza los valores del array asociativo parameters_alert
    public function update_parameters_alert($title, $message, $button)
    {
        $this->parameters_alert = [
            'title' => $title,
            'message' => $message,
            'button' => $button
        ];
    }
}
