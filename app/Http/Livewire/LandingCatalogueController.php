<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LandingCatalogueController extends Component
{
    public $character_limit;
    public function mount()
    {
        $this->character_limit = 100;
    }
    public function render()
    {
        $products = InvProduct::select("inv_products.*", DB::raw("0 as description_catalogue"))
        ->where("status", "active")
        ->orderBy("created_at", "desc")
        ->get();
        foreach($products as $p)
        {
            if (mb_strlen($p->description) > $this->character_limit)
            {
                $p->description_catalogue = mb_substr($p->description, 0, $this->character_limit) . "...";
            }
            else
            {
                $p->description_catalogue = $p->description;
            }
        }



        return view('livewire.landing.catalogue.catalogue', [
            'products' => $products,
        ])
        ->extends('layouts.landing.app')
        ->section('content');
    }
}
