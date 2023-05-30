<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use App\Models\InvProduct;
use Livewire\WithPagination;

use App\Http\Livewire\MethodsController;

class InvCategorieController extends MethodsController
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

    // Variable que almacena parametros para una alerta
    public $alert = [
        'title' => '',
        'text' => '',
        'icon' => '',
        'confirmButtonText' => '',
        'cancelButtonText' => '',
    ];

    // Variable que almacena parametros para un mensaje de tipo toast
    public $toast = [
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
        // Si el id recibido es igual a cero significa que se va a crear una categoria, caso contrario se actualizará una categoría
        if ($id == 0)
        {
            $this->category_id = 0;
            $this->name_category = "";
        }
        else
        {
            // Obteniene la categoría a actualizar y lo guarda en una variable
            $categorie = InvCategory::find($id);
            // Actualiza la variable global name_category a travez de la variable categorie
            $this->name_category = $categorie->name_category;
            // Actualiza la variable global category_id a travez de la variable recibida
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
        // Elimina espacios en blanco extras y reemplaza multiples espacios en blanco por un solo espacio
        $this->name_category = trim(preg_replace('/\s+/', ' ', $this->name_category));
        // Crea la categoría y guarda el objeto creado en una variable
        $category = InvCategory::create([
            'name_category' =>  $this->name_category
        ]);
        // Texto que se verá en el mensaje de tipo toast
        $text = "Categoría '" . $category->name_category . "' creada exitosamente";
        // Actualizando parámetros del mensaje toast
        $this->toast = $this->update_toast($text, "3000", "success");
        // Muestra el mensaje de tipo toast
        $this->emit("toast");
        // Cierra la ventana modal
        $this->emit("hide-modal-categorie");
    }
    // Actualiza una categoría
    public function update_category()
    {
        // Busca la categoría y lo guarda en una variable
        $category = InvCategory::find($this->category_id);
        // Actualiza la categoría
        $category->update([
            'name_category' => $this->name_category
        ]);
        $category->save();
        // Texto que se verá en el mensaje de tipo toast
        $text = "Categoriá '" . $category->name_category . "' actualizada exitosamente";
        // Actualiza parámetros del mensaje toast
        $this->toast = $this->update_toast($text, "3000", "success");
        // Muestra el mensaje de tipo toast
        $this->emit("toast");
        // Cierra la ventana modal
        $this->emit("hide-modal-categorie");
    }
    // Verifica si una categoria tiene registros con su id y muestra una alerta para inactivar o eliminar la categoria
    public function check_category(InvCategory $category)
    {
        // Buscando productos que tengan el id de la categoria
        $productCount = InvProduct::where('inv_categorie_id', $category->id)->exists();
        // Cambia los parámetros de la alerta dependiendo si la variable productCount tiene registros
        if ($productCount)
        {
            $alert_title = "¿Inactivar Categoría?";
            $alert_text = "La categoría '" . $category->name_category . "' tiene productos que usan su nombre, por lo cual no puede ser eliminada, pero puede ser inactivada para que ya no pueda ser usada.";
            $alert_confirmButtonText = "Inactivar";
            $alert_icon = "warning";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Categoría?";
            $alert_text = "La categoría '" . $category->name_category . "' no es usado por ningún producto por lo cual puede ser eliminado.";
            $alert_confirmButtonText = "Eliminar";
            $alert_icon = "info";
            $this->delete_cancel = true;
        }
        // Actualizando la variable category_id
        $this->category_id = $category->id;
        // Actualizando parámetros de la alerta
        // $this->update_alert($alert_title, $alert_text,$alert_icon, $alert_confirmButtonText, "Cancelar");
        $this->alert = $this->update_alert($alert_title, $alert_text,$alert_icon, $alert_confirmButtonText, "Cancelar");
        $this->emit("alert-category");
    }
    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'deleteCategory' => 'delete_category'
    ];
    // Elimina o inactiva una categoría
    public function delete_category()
    {
        $category = InvCategory::find($this->category_id);
        $name_category = $category->name_category;
        if ($this->delete_cancel)
        {
            $category->delete();
            $text = "¡Categoria '" . $name_category . "' eliminada exitósamente!";
        }
        else
        {
            $category->update([
                'status' => "inactive"
            ]);
            $category->save();
            $text = "¡Categoria '" . $name_category . "' inactivada exitósamente!";
        }
        // Actualiza parámetros del mensaje toast
        $this->toast = $this->update_toast($text, "3000", "success");
        // Muestra el mensaje de tipo toast
        $this->emit("toast");
    }
}
