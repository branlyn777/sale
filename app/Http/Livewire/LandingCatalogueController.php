<?php

namespace App\Http\Livewire;

use App\Models\InvCategory;
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
        // Variable que almacenará las categorias de los productos y los propios productos
        $categories_products = InvCategory::select("inv_categories.*", DB::raw("0 as products"))
        ->where("status", "active")
        ->orderBy("created_at", "desc")
        ->get();

        foreach ($categories_products as $c)
        {
            $c->products = InvProduct::select("inv_products.*")
            ->where("inv_categorie_id", $c->id)
            ->where("status", "active")
            ->orderBy("created_at", "desc")
            ->get();
        }



        // $products = InvProduct::select("inv_products.*", DB::raw("0 as description_catalogue"))
        // ->where("status", "active")
        // ->orderBy("created_at", "desc")
        // ->get();
        // foreach($products as $p)
        // {
        //     if (mb_strlen($p->description) > $this->character_limit)
        //     {
        //         $p->description_catalogue = mb_substr($p->description, 0, $this->character_limit) . "...";
        //     }
        //     else
        //     {
        //         $p->description_catalogue = $p->description;
        //     }
        // }



        return view('livewire.landing.catalogue.catalogue', [
            'categories_products' => $categories_products
        ])
        ->extends('layouts.landing.app')
        ->section('content');
    }
}
