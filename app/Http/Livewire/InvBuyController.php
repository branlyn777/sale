<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InvBuyController extends Component
{
    // Guarda los terminos de busqueda para encontrar un producto
    public $search;
    // Variable que guardará los productos para comprar
    public $shoppingCart;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        // Inicializa la colección como una instancia de Illuminate\Support\Collection
        $this->shoppingCart = new Collection();
    }

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
    // Añade un producto al shopping cart
    public function cart_add()
    {
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => "Producto añadido exitosamente",
            'timer' => 3000,
            'icon' => "success"
        ]);
    }
}
