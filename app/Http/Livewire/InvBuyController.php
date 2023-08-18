<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Livewire\Component;
use Livewire\WithPagination;

class InvBuyController extends Component
{
    // Guarda los terminos de busqueda para encontrar un producto
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if (strlen($this->search) > 0)
        {
            $products = InvProduct::where("status", "active")
            ->where('name_product', 'like', '%' . $this->search . '%')
            ->paginate(5);
        }
        else
        {
            $products = InvProduct::where("status", "activo")->paginate(5);
        }



        return view('livewire.template.inventory.buy.buy', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
