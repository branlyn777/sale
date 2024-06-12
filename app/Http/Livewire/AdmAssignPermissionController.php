<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdmAssignPermissionController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar propietarios activas o inactivos
    public $status;
    // Guarda el id de la propietario
    public $role_id;
    // Guarda la lista de roles
    public $list_roles;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->role_id = 1;
        $this->status = "active";
        $this->list_roles = Role::orderBy("name")->get();
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $permissions = Permission::select('permissions.*', DB::raw('0 as checked'))
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $permissions = Permission::where(function ($query) {
                $query->where('section', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);
        }


        foreach ($permissions as $p)
        {
            $role = Role::find($this->role_id);
            if ($role->hasPermissionTo($p->name))
            {
                $p->checked = true;
            }
            else
            {
                $p->checked = false;
            }
        }


        return view('livewire.template.administration.assignpermission.assignpermission', [
            'permissions' => $permissions,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function syncPermission($state, $permissionName)
    {
        if ($this->role_id != 'Elegir')
        {
            $roleName = Role::find($this->role_id);
            if ($state)
            {
                $roleName->givePermissionTo($permissionName);
                // Emite un mensaje de tipo toast
                $this->emit("toast", [
                    'text' => "Permiso asignado exitosamente",
                    'timer' => 3000,
                    'icon' => "success"
                ]);
            }
            else
            {
                $roleName->revokePermissionTo($permissionName);
                // Emite un mensaje de tipo toast
                $this->emit("toast", [
                    'text' => "Permiso revocado exitosamente",
                    'timer' => 3000,
                    'icon' => "success"
                ]);
            }
        }
        else
        {
            $this->redirect('asignarpermisos');
        }
    }
}
