<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CatalogueController extends Component
{
    public function render()
    {
        $data = "";
        return view('livewire.catalogue', [
            'data' => $data,
        ])
        ->extends('layouts.catalogue.app')
        ->section('content');
    }
}
