<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Livewire\Component;
use Livewire\WithPagination;

class InvProductController extends Component
{
    // Guarda los terminos de busqueda para encontrar una categoria
    public $search;
    // Guarda true o false para mostrar productos activos o inactivos
    public $status;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        // $this->category_id = 0;
        $this->status = "active";
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $products = InvProduct::where("status",$this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $products = InvProduct::where("status",$this->status)
            ->where('name_category', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        return view('livewire.inventories.products.invproduct', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
