<?php

namespace App\Http\Livewire;

use App\Models\SisOwner;
use Livewire\Component;
use Livewire\WithPagination;

class SisOwnerController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar propietarios activas o inactivos
    public $status;
    // Guarda el id de la propietario
    public $owner_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->owner_id = 0;
        $this->status = "active";
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $owners = SisOwner::where("status", $this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $owners = SisOwner::where("status", $this->status)
            ->where(function ($query) {
                $query->where('owner_code', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('paternal_surname', 'like', '%' . $this->search . '%')
                    ->orWhere('maternal_surname', 'like', '%' . $this->search . '%')
                    ->orWhere('ci_number', 'like', '%' . $this->search . '%')
                    ->orWhere('nit_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);

        }

        return view('livewire.template.sis.owners.owner', [
            'owners' => $owners
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
