<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InvSaleController extends Component
{
    protected $shopping_cart;
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->shopping_cart = new Collection();
    }
    public function render()
    {
        $products = InvProduct::where("status", "active")->paginate(5);
        return view('livewire.template.sale.sale.sale', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
