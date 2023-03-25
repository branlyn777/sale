<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
use Livewire\Component;

class InvCategorieController extends Component
{
    //Guarda el nombre de la cetegoria (Crear o editar)
    public $name_category;

    public function render()
    {
        $categories = InvCategory::where("status","active")->orderBy("created_at","desc")->get();
        return view('livewire.inventories.categories.categorie', [
            'categories' => $categories
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //Muestra la ventana modal Categories
    public function showModalCategories()
    {
        $this->emit("show-modal-categorie");
    }
    //Crea una nueva categoria
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
}
