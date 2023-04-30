<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LandingHomeController extends Component
{
    public function render()
    {
        $data = "";
        return view('livewire.landing.home', [
            'data' => $data,
        ])
        ->extends('layouts.landing.app')
        ->section('content');
    }
}
