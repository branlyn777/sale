<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Livewire\Component;

class LandingCatalogueController extends Component
{
    public function render()
    {
        $products = InvProduct::all();
        return view('livewire.landing.catalogue', [
            'products' => $products,
        ])
        ->extends('layouts.landing.app')
        ->section('content');
    }
}
