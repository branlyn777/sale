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

    public $license_plate, 
    $class, 
    $mark, 
    $vehicle_type, 
    $vehicle_subtype, 
    $engine_number, 
    $chassis_number, 
    $model, 
    $service, 
    $policy_type, 
    $policy_date, 
    $country, 
    $customs_import, 
    $policy_number, 
    $tax_start_year, 
    $origin, 
    $displacement, 
    $traction, 
    $number_of_wheels, 
    $number_of_doors, 
    $color, 
    $number_of_places, 
    $fuel, 
    $bodywork_type, 
    $chassis_type, 
    $motor_type, 
    $motor_turbo, 
    $weight, 
    $towing_capacity, 
    $observations;

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
    // Crea una nuevo Ruat
    public function create_ruat()
    {
        $rules = [
            'license_plate' => 'required|min:2|max:255|unique:sis_ruats,license_plate',
            'class' => 'required|min:2|max:255',
            'mark' => 'required|min:2|max:255',
            'vehicle_type' => 'nullable|min:2|max:255',
            'vehicle_subtype' => 'nullable|min:2|max:255',
            'engine_number' => 'required|min:2|max:255|unique:sis_ruats,engine_number',
            'chassis_number' => 'nullable|min:2|max:255',
            'model' => 'nullable|min:2|max:255',
            'service' => 'nullable|min:2|max:255',
            'policy_type' => 'nullable|min:2|max:255',
            'policy_date' => 'required|date|unique:sis_ruats,policy_date',
            'country' => 'nullable|min:2|max:255',
            'customs_import' => 'nullable|min:2|max:255',
            'policy_number' => 'nullable|min:2|max:255',
            'tax_start_year' => 'nullable|digits:4',
            'origin' => 'nullable|min:2|max:255',
            'displacement' => 'nullable|numeric|min:0',
            'traction' => 'nullable|min:2|max:255',
            'number_of_wheels' => 'nullable|integer|min:0',
            'number_of_doors' => 'nullable|integer|min:0',
            'color' => 'nullable|min:2|max:255',
            'number_of_places' => 'nullable|integer|min:0',
            'fuel' => 'nullable|min:2|max:255',
            'bodywork_type' => 'nullable|min:2|max:255',
            'chassis_type' => 'nullable|min:2|max:255',
            'motor_type' => 'nullable|min:2|max:255',
            'motor_turbo' => 'nullable|boolean',
            'weight' => 'nullable|numeric|min:0',
            'towing_capacity' => 'nullable|numeric|min:0',
            'observations' => 'nullable|max:65535',
        ];
        
        $messages = [
            'license_plate.required' => 'La placa es requerida',
            'license_plate.unique' => 'Ya existe una placa con ese nombre',
            'license_plate.min' => 'La placa debe tener al menos 2 caracteres',
            'license_plate.max' => 'La placa no debe pasar los 255 caracteres',
        
            'class.required' => 'La clase es requerida',
            'class.min' => 'La clase debe tener al menos 2 caracteres',
            'class.max' => 'La clase no debe pasar los 255 caracteres',
        
            'mark.required' => 'La marca es requerida',
            'mark.min' => 'La marca debe tener al menos 2 caracteres',
            'mark.max' => 'La marca no debe pasar los 255 caracteres',
        
            'engine_number.required' => 'El número de motor es requerido',
            'engine_number.unique' => 'Ya existe un número de motor con ese nombre',
            'engine_number.min' => 'El número de motor debe tener al menos 2 caracteres',
            'engine_number.max' => 'El número de motor no debe pasar los 255 caracteres',
        
            'policy_date.required' => 'La fecha de póliza es requerida',
            'policy_date.date' => 'La fecha de póliza debe ser una fecha válida',
            'policy_date.unique' => 'Ya existe una fecha de póliza con ese nombre',
        
            'vehicle_type.min' => 'El tipo de vehículo debe tener al menos 2 caracteres',
            'vehicle_type.max' => 'El tipo de vehículo no debe pasar los 255 caracteres',
        
            'vehicle_subtype.min' => 'El subtipo de vehículo debe tener al menos 2 caracteres',
            'vehicle_subtype.max' => 'El subtipo de vehículo no debe pasar los 255 caracteres',
        
            'chassis_number.min' => 'El número de chasis debe tener al menos 2 caracteres',
            'chassis_number.max' => 'El número de chasis no debe pasar los 255 caracteres',
        
            'model.min' => 'El modelo debe tener al menos 2 caracteres',
            'model.max' => 'El modelo no debe pasar los 255 caracteres',
        
            'service.min' => 'El servicio debe tener al menos 2 caracteres',
            'service.max' => 'El servicio no debe pasar los 255 caracteres',
        
            'policy_type.min' => 'El tipo de póliza debe tener al menos 2 caracteres',
            'policy_type.max' => 'El tipo de póliza no debe pasar los 255 caracteres',
        
            'country.min' => 'El país debe tener al menos 2 caracteres',
            'country.max' => 'El país no debe pasar los 255 caracteres',
        
            'customs_import.min' => 'La importación aduanera debe tener al menos 2 caracteres',
            'customs_import.max' => 'La importación aduanera no debe pasar los 255 caracteres',
        
            'policy_number.min' => 'El número de póliza debe tener al menos 2 caracteres',
            'policy_number.max' => 'El número de póliza no debe pasar los 255 caracteres',
        
            'tax_start_year.digits' => 'El año de inicio de impuestos debe ser un año válido de 4 dígitos',
        
            'origin.min' => 'El origen debe tener al menos 2 caracteres',
            'origin.max' => 'El origen no debe pasar los 255 caracteres',
        
            'displacement.numeric' => 'El desplazamiento debe ser un número',
            'displacement.min' => 'El desplazamiento debe ser un valor positivo',
        
            'traction.min' => 'La tracción debe tener al menos 2 caracteres',
            'traction.max' => 'La tracción no debe pasar los 255 caracteres',
        
            'number_of_wheels.integer' => 'El número de ruedas debe ser un número entero',
            'number_of_wheels.min' => 'El número de ruedas debe ser un valor positivo',
        
            'number_of_doors.integer' => 'El número de puertas debe ser un número entero',
            'number_of_doors.min' => 'El número de puertas debe ser un valor positivo',
        
            'color.min' => 'El color debe tener al menos 2 caracteres',
            'color.max' => 'El color no debe pasar los 255 caracteres',
        
            'number_of_places.integer' => 'El número de lugares debe ser un número entero',
            'number_of_places.min' => 'El número de lugares debe ser un valor positivo',
        
            'fuel.min' => 'El combustible debe tener al menos 2 caracteres',
            'fuel.max' => 'El combustible no debe pasar los 255 caracteres',
        
            'bodywork_type.min' => 'El tipo de carrocería debe tener al menos 2 caracteres',
            'bodywork_type.max' => 'El tipo de carrocería no debe pasar los 255 caracteres',
        
            'chassis_type.min' => 'El tipo de chasis debe tener al menos 2 caracteres',
            'chassis_type.max' => 'El tipo de chasis no debe pasar los 255 caracteres',
        
            'motor_type.min' => 'El tipo de motor debe tener al menos 2 caracteres',
            'motor_type.max' => 'El tipo de motor no debe pasar los 255 caracteres',
        
            'motor_turbo.boolean' => 'El turbo del motor debe ser un valor booleano',
        
            'weight.numeric' => 'El peso debe ser un número',
            'weight.min' => 'El peso debe ser un valor positivo',
        
            'towing_capacity.numeric' => 'La capacidad de remolque debe ser un número',
            'towing_capacity.min' => 'La capacidad de remolque debe ser un valor positivo',
        
            'observations.max' => 'Las observaciones no deben pasar los 65535 caracteres',
        ];
        
        $this->validate($rules, $messages);
        
        // Limpia espacios en blanco extras para todos los campos
        $this->license_plate = trim(preg_replace('/\s+/', ' ', $this->license_plate));
        $this->class = trim(preg_replace('/\s+/', ' ', $this->class));
        $this->mark = trim(preg_replace('/\s+/', ' ', $this->mark));
        $this->vehicle_type = trim(preg_replace('/\s+/', ' ', $this->vehicle_type));
        $this->vehicle_subtype = trim(preg_replace('/\s+/', ' ', $this->vehicle_subtype));
        $this->engine_number = trim(preg_replace('/\s+/', ' ', $this->engine_number));
        $this->chassis_number = trim(preg_replace('/\s+/', ' ', $this->chassis_number));
        $this->model = trim(preg_replace('/\s+/', ' ', $this->model));
        $this->service = trim(preg_replace('/\s+/', ' ', $this->service));
        $this->policy_type = trim(preg_replace('/\s+/', ' ', $this->policy_type));
        $this->policy_date = trim(preg_replace('/\s+/', ' ', $this->policy_date));
        $this->country = trim(preg_replace('/\s+/', ' ', $this->country));
        $this->customs_import = trim(preg_replace('/\s+/', ' ', $this->customs_import));
        $this->policy_number = trim(preg_replace('/\s+/', ' ', $this->policy_number));
        $this->tax_start_year = trim(preg_replace('/\s+/', ' ', $this->tax_start_year));
        $this->origin = trim(preg_replace('/\s+/', ' ', $this->origin));
        $this->displacement = trim(preg_replace('/\s+/', ' ', $this->displacement));
        $this->traction = trim(preg_replace('/\s+/', ' ', $this->traction));
        $this->number_of_wheels = trim(preg_replace('/\s+/', ' ', $this->number_of_wheels));
        $this->number_of_doors = trim(preg_replace('/\s+/', ' ', $this->number_of_doors));
        $this->color = trim(preg_replace('/\s+/', ' ', $this->color));
        $this->number_of_places = trim(preg_replace('/\s+/', ' ', $this->number_of_places));
        $this->fuel = trim(preg_replace('/\s+/', ' ', $this->fuel));
        $this->bodywork_type = trim(preg_replace('/\s+/', ' ', $this->bodywork_type));
        $this->chassis_type = trim(preg_replace('/\s+/', ' ', $this->chassis_type));
        $this->motor_type = trim(preg_replace('/\s+/', ' ', $this->motor_type));
        $this->motor_turbo = trim(preg_replace('/\s+/', ' ', $this->motor_turbo));
        $this->weight = trim(preg_replace('/\s+/', ' ', $this->weight));
        $this->towing_capacity = trim(preg_replace('/\s+/', ' ', $this->towing_capacity));
        $this->observations = trim(preg_replace('/\s+/', ' ', $this->observations));
        // Crea la categoría y guarda el objeto creado en una variable
        $category = InvCategory::create([
            'name_category' =>  $this->name_category
        ]);
        // Texto que se verá en el mensaje de tipo toast
        $text = "Categoría '" . $category->name_category . "' creada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-categorie");
    }
}
