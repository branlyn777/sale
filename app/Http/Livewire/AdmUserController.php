<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdmUserController extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.template.administration.user.user', [
            'users' => $users,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
