<?php

namespace App\Http\Livewire;

use App\Models\SisRuat;
use Livewire\Component;
use Livewire\WithPagination;

class SisRuatController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar propietarios activas o inactivos
    public $status;
    // Guarda el id de la propietario
    public $ruat_id;

    public $license_plate, $class, $mark, $vehicle_type, $vehicle_subtype, $engine_number, $chassis_number, $model, $service, $policy_type, $policy_date, $country, $customs_import, $policy_number, $tax_start_year, $origin, $displacement, $traction, $number_of_wheels, $number_of_doors, $color, $number_of_places, $fuel, $bodywork_type, $chassis_type, $motor_type, $motor_turbo, $weight, $towing_capacity, $observations;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->ruat_id = 0;
        $this->status = "active";
    }
    public function render()
    {

        if (strlen($this->search) == 0)
        {
            $ruats = SisRuat::where("status", $this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $ruats = SisRuat::where("status", $this->status)
            ->where(function ($query) {
                $query->where('license_plate', 'like', '%' . $this->search . '%')
                    ->orWhere('color', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);
        }
        
        return view('livewire.template.sis.ruats.ruat', [
            'ruats' => $ruats
        ])
        ->extends('layouts.theme.app')
        ->section('content');

    }
    // Muestra la ventana modal ruat (Para Crear o Actualizar)
    public function showModalRuat($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear un ruat, caso contrario se actualizará un ruat
        if ($id == 0)
        {
            // Restablecer los campos de entrada después de guardar
            $this->reset(['class', 'mark', 'vehicle_type', 'vehicle_subtype', 'engine_number', 'chassis_number', 'model', 'service', 'license_plate', 'policy_type', 'policy_date', 'country', 'customs_import', 'policy_number', 'tax_start_year', 'origin', 'displacement', 'traction', 'number_of_wheels', 'number_of_doors', 'color', 'number_of_places', 'fuel', 'bodywork_type', 'chassis_type', 'motor_type', 'motor_turbo', 'weight', 'towing_capacity', 'observations']);

            $this->ruat_id = 0;
        }
        else
        {
            // Obtiene el RUAT a actualizar y lo guarda en una variable
            $ruat = SisRuat::find($id);

            $this->ruat_id = $ruat->id;

            $this->license_plate = $ruat->license_plate;
            $this->class = $ruat->class;
            $this->mark = $ruat->mark;
            $this->vehicle_type = $ruat->vehicle_type;
            $this->vehicle_subtype = $ruat->vehicle_subtype;
            $this->engine_number = $ruat->engine_number;
            $this->chassis_number = $ruat->chassis_number;
            $this->model = $ruat->model;
            $this->service = $ruat->service;
            $this->policy_type = $ruat->policy_type;
            $this->policy_date = $ruat->policy_date;
            $this->country = $ruat->country;
            $this->customs_import = $ruat->customs_import;
            $this->policy_number = $ruat->policy_number;
            $this->tax_start_year = $ruat->tax_start_year;
            $this->origin = $ruat->origin;
            $this->displacement = $ruat->displacement;
            $this->traction = $ruat->traction;
            $this->number_of_wheels = $ruat->number_of_wheels;
            $this->number_of_doors = $ruat->number_of_doors;
            $this->color = $ruat->color;
            $this->number_of_places = $ruat->number_of_places;
            $this->fuel = $ruat->fuel;
            $this->bodywork_type = $ruat->bodywork_type;
            $this->chassis_type = $ruat->chassis_type;
            $this->motor_type = $ruat->motor_type;
            $this->motor_turbo = $ruat->motor_turbo;
            $this->weight = $ruat->weight;
            $this->towing_capacity = $ruat->towing_capacity;
            $this->observations = $ruat->observations;
            $this->status = $ruat->status;

            
            // Actualiza la variable global ruat_id a travez de la variable recibida
            $this->ruat_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-ruat");
    }
}
