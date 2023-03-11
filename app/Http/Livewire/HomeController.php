<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        $data = "";
        return view('livewire.home.home', [
            'data' => $data,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
