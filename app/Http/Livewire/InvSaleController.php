<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvSaleController extends Component
{
    public function render()
    {
        $products = "";
        return view('livewire.template.sale.sale.sale', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
