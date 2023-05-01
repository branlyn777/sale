<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaleController extends Component
{
    public function render()
    {
        $products = "";
        return view('livewire.sale.pos.sale', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
