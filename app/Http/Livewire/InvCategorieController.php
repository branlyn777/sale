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
    // Guarda true o false para eliminar o inactivar una categoria
    public $delete_cancel;
    // Guarda true o false para mostrar categorias activas o inactivas
    public $status;

    // Guardan un mensaje para una notificación de tipo toast
    public $toast_message;

    // Variable que almacena parametros de una alerta
    public $parameters_alert = [
        'title' => '',
        'message' => '',
        'button' => '',
    ];

    // Variable que almacena parametros de una alerta
    public $parameters_message_toast = [
        'text' => '',
        'timer' => '',
        'icon' => '',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->category_id = 0;
        $this->status = "active";
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $categories = InvCategory::where("status",$this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $categories = InvCategory::where("status",$this->status)
            ->where('name_category', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
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
        $productCount = InvProduct::where('inv_categorie_id', $category->id)->exists();
        if ($productCount)
        {
            $alert_title = "¿Inactivar Categoría?";
            $alert_message = "La categoría '" . $category->name_category . "' tiene productos que usan su nombre, por lo cual no puede ser eliminada.";
            $alert_button = "Inactivar";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Categoría?";
            $alert_message = "La categoría '" . $category->name_category . "' no tiene ningun producto a su nombre, por lo cual puede ser eliminada.";
            $alert_button = "Eliminar";
            $this->delete_cancel = true;
        }
        // Actualizando la variable category_id
        $this->category_id = $category->id;
        // Actualizando parámetros de la alerta
        $this->update_parameters_alert($alert_title, $alert_message, $alert_button);
        $this->emit("alert-category");
    }
    // Función que actualiza los valores del array asociativo parameters_alert (Mensaje de Alerta)
    public function update_parameters_alert($title, $message, $button)
    {
        $this->parameters_alert = [
            'title' => $title,
            'message' => $message,
            'button' => $button
        ];
    }
    // Función que actualiza los valores del array asociativo parameters_message_toast (Mensaje Toast)
    public function update_parameters_message_toast($text, $timer, $icon)
    {
        $this->parameters_message_toast = [
            'text' => $text,
            'timer' => $timer,
            'icon' => $icon
        ];
    }
    // Escucha eventos JavaScript de la vista para ejecutar métodos de este controlador
    protected $listeners = [
        'deleteCategory' => 'delete_category'
    ];
    public function delete_category()
    {
        $category = InvCategory::find($this->category_id);
        $name_category = $category->name_category;
        if($this->delete_cancel)
        {
            $category->delete();
            $text = "¡Categoria '" . $name_category . "' eliminada con éxito!";
        }
        else
        {
            $category->update([
                'status' => "inactive"
            ]);
            $category->save();
            $text = "¡Categoria '" . $name_category . "' inactivada con éxito!";
        }
        $timer = "3000";
        $icon = "success";
        // Actualizando parámetros del mensaje toast
        $this->update_parameters_message_toast($text, $timer, $icon);
        $this->emit("message-toast");
    }
}
