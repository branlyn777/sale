<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvCategorieController extends Component
{
    public function render()
    {
        $categories = "";
        return view('livewire.inventories.categories.categorie', [
            'categories' => $categories,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //Show Modal Categories
    public function showModalCategories()
    {
        $this->emit("show-modal-categories");
    }
}
