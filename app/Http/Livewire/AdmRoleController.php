<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class AdmRoleController extends Component
{

    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar propietarios activas o inactivos
    public $status;
    // Guarda el id de la propietario
    public $role_id;


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->role_id = 0;
        $this->status = "active";
    }
    public function render()
    {

        if (strlen($this->search) == 0)
        {
            $roles = Role::orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $roles = Role::where(function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);

        }

        return view('livewire.template.administration.role.role', [
            'roles' => $roles,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
