<?php

namespace App\Http\Livewire;

use App\Models\SisCistern;
use App\Models\SisDriver;
use Livewire\Component;
use Livewire\WithPagination;

class SisCisternController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar cisternas activas o inactivas
    public $status;
    // Guarda el id de la cisterna
    public $cistern_id;
    // Guarda true o false para eliminar o inactivar una cisterna
    public $delete_cancel;

    public $plate, $chassis_number, $engine, $axle_model;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->cistern_id = 0;
        $this->status = "active";
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $cisterns = SisCistern::where("status",$this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $cisterns = SisCistern::where("status", $this->status)
            ->where(function ($query) {
                $query->where('plate', 'like', '%' . $this->search . '%')
                      ->orWhere('chassis_number', 'like', '%' . $this->search . '%')
                      ->orWhere('engine', 'like', '%' . $this->search . '%')
                      ->orWhere('axle_model', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);
        }

        return view('livewire.template.sis.cisterns.cistern', [
            'cisterns' => $cisterns
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // Muestra la ventana modal cistern (Para Crear o Actualizar)
    public function showModalCistern($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear una cisterna, caso contrario se actualizará una cisterna
        if ($id == 0)
        {
            // Reset the input fields after saving
            $this->reset(['plate', 'chassis_number', 'engine', 'axle_model']);
            $this->cistern_id = 0;
            // $this->plate = "";
        }
        else
        {
            // Obteniene la cisterna a actualizar y lo guarda en una variable
            $cistern = SisCistern::find($id);
            // Actualiza la variable global plate a travez de la variable cistern
            $this->plate = $cistern->plate;
            $this->chassis_number = $cistern->chassis_number;
            $this->engine = $cistern->engine;
            $this->axle_model = $cistern->axle_model;
            $this->status = $cistern->status;
            // Actualiza la variable global cistern_id a travez de la variable recibida
            $this->cistern_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-cistern");
    }
    // Crea una nueva cisterna
    public function create_cistern()
    {
       // Reglas de validación
        $rules = [
            'plate' => 'required|min:2|max:255|unique:sis_cisterns,plate',
            'chassis_number' => 'required|min:5|max:255|unique:sis_cisterns,chassis_number',
            'engine' => 'required|min:2|max:255',
            'axle_model' => 'required|min:2|max:255',
        ];

        // Mensajes de validación
        $messages = [
            'plate.required' => 'La placa es requerida',
            'plate.unique' => 'Ya existe una cisterna con esa placa',
            'plate.min' => 'La placa debe tener al menos 2 caracteres',
            'plate.max' => 'La placa no debe pasar los 255 caracteres',

            'chassis_number.required' => 'El número de chasis es requerido',
            'chassis_number.unique' => 'Ya existe una cisterna con ese número de chasis',
            'chassis_number.min' => 'El número de chasis debe tener al menos 5 caracteres',
            'chassis_number.max' => 'El número de chasis no debe pasar los 255 caracteres',

            'engine.required' => 'El motor es requerido',
            'engine.min' => 'El motor debe tener al menos 2 caracteres',
            'engine.max' => 'El motor no debe pasar los 255 caracteres',

            'axle_model.required' => 'El modelo de ejes es requerido',
            'axle_model.min' => 'El modelo de ejes debe tener al menos 2 caracteres',
            'axle_model.max' => 'El modelo de ejes no debe pasar los 255 caracteres',
        ];

        $this->validate($rules, $messages); 

        // Elimina espacios en blanco extras y reemplaza multiples espacios en blanco por un solo espacio
        $this->plate = trim(preg_replace('/\s+/', ' ', $this->plate));

        // Crea la cisterna y guarda el objeto creado en una variable
        $cistern = SisCistern::create([
            'plate' => $this->plate,
            'chassis_number' => $this->chassis_number,
            'engine' => $this->engine,
            'axle_model' => $this->axle_model
        ]);

        // Reset the input fields after saving
        $this->reset(['plate', 'chassis_number', 'engine', 'axle_model']);
        
        // Texto que se verá en el mensaje de tipo toast
        $text = "Cisterna '" . $cistern->plate . "' creada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-cistern");
    }

    // Verifica si una cisterna tiene registros con su id y muestra una alerta para inactivar o eliminar la cisterna
    public function check_cistern(SisCistern $cistern)
    {
        // Buscando conductores que tengan el id de la cisterna
        $driveCount = SisDriver::where('cistern_id', $cistern->id)->exists();
        // Cambia los parámetros de la alerta dependiendo si la variable driveCount tiene registros
        if ($driveCount)
        {
            $alert_title = "¿Inactivar Cisterna?";
            $alert_text = "La Cisterna con placa:'" . $cistern->plate . "' tiene conductores que usan su nombre, por lo cual no puede ser eliminada, pero puede ser inactivada para que ya no pueda ser usada.";
            $alert_confirmButtonText = "Inactivar";
            $alert_icon = "warning";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Cisterna?";
            $alert_text = "La cisterna con placa: '" . $cistern->plate . "' sera eliminada.";
            $alert_confirmButtonText = "Eliminar";
            $alert_icon = "question";
            $this->delete_cancel = true;
        }
        // Emite un mensaje de tipo alerta
        $this->emit("alert", [
            'title' => $alert_title,
            'text' => $alert_text,
            'icon' => $alert_icon,
            'confirmButtonText' => $alert_confirmButtonText,
            'cancelButtonText' => "Cancelar",
            'id' => $cistern->id
        ]);
    }

    // Actualiza una cisterna
    public function update_cistern()
    {
        // Reglas de validación
        $rules = [
            'plate' => 'required|min:2|max:255',
            'chassis_number' => 'required|min:5|max:255',
            'engine' => 'required|min:2|max:255',
            'axle_model' => 'required|min:2|max:255',
        ];

        // Mensajes de validación
        $messages = [
            'plate.required' => 'La placa es requerida',
            'plate.min' => 'La placa debe tener al menos 2 caracteres',
            'plate.max' => 'La placa no debe pasar los 255 caracteres',

            'chassis_number.required' => 'El número de chasis es requerido',
            'chassis_number.min' => 'El número de chasis debe tener al menos 5 caracteres',
            'chassis_number.max' => 'El número de chasis no debe pasar los 255 caracteres',

            'engine.required' => 'El motor es requerido',
            'engine.min' => 'El motor debe tener al menos 2 caracteres',
            'engine.max' => 'El motor no debe pasar los 255 caracteres',

            'axle_model.required' => 'El modelo de ejes es requerido',
            'axle_model.min' => 'El modelo de ejes debe tener al menos 2 caracteres',
            'axle_model.max' => 'El modelo de ejes no debe pasar los 255 caracteres',
        ];

        $this->validate($rules, $messages); 


        // Busca la cisterna y lo guarda en una variable
        $cistern = SisCistern::find($this->cistern_id);
        // Actualiza la cisterna
        $cistern->update([
            'plate' => $this->plate,
            'chassis_number' => $this->chassis_number,
            'engine' => $this->plate,
            'axle_model' => $this->axle_model
        ]);
        $cistern->save();
        // Texto que se verá en el mensaje de tipo toast
        $text = "Cisterna con placa: '" . $cistern->plate . "' actualizada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-cistern");
    }

    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'deleteCistern' => 'delete_cistern'
    ];

    // Elimina o inactiva una Cisterna
    public function delete_cistern($cistern_id)
    {
        $cistern = SisCistern::find($cistern_id);
        $plate = $cistern->plate;
        if ($this->delete_cancel)
        {
            $cistern->delete();
            $text = "¡Cisterna con placa: '" . $plate . "' eliminada exitósamente!";
        }
        else
        {
            $cistern->update([
                'status' => "inactive"
            ]);
            $cistern->save();
            $text = "¡Cisterna con placa: '" . $plate . "' inactivada exitósamente!";
        }
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
    }
}
