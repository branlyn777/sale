<?php

namespace App\Http\Livewire;

use App\Models\InvBranch;
use App\Models\User;
use Livewire\Component;

class AdmUserController extends Component
{
    // Guarda el id de un Usuario
    public $user_id;
    // Guarda el nombre de un Usuario
    public $user_name;
    // Guarda la lista de Sucursales
    public $list_branches;
    public function mount()
    {
        $this->list_branches = InvBranch::where("status","active")->get();
    }
    public function render()
    {
        $users = User::all();
        return view('livewire.template.administration.user.user', [
            'users' => $users,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Usuarios (Para Crear o Actualizar)
    public function showModalUser($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear un ususario, caso contrario se actualizará un ususario
        if ($id == 0)
        {
            $this->user_id = 0;
            $this->user_name = "";
        }
        else
        {
            // Obteniene la categoría a actualizar y lo guarda en una variable
            $user = InvCategory::find($id);
            // Actualiza la variable global user_name a travez de la variable user
            $this->user_name = $user->user_name;
            // Actualiza la variable global user_id a travez de la variable recibida
            $this->user_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-user");
    }
}
