<?php

namespace App\Http\Livewire;

use App\Models\SisCistern;
use App\Models\SisDriver;
use Livewire\Component;
use Livewire\WithPagination;

class SisDriverController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda true o false para mostrar conductores activos o inactivos
    public $status;
    // Guarda el id de la conductor
    public $driver_id;
    // Guarda true o false para eliminar o inactivar una conductor
    public $delete_cancel;

    public $name, $paternal_surname, $maternal_surname, $ci_number, $license_number, $start_date, $end_date, $photo_path, $cistern_id;

    // Lista las conductors para el select
    public $list_cisterns;


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->driver_id = 0;
        $this->status = "active";

        
        $this->list_cisterns = SisCistern::where("status", "active")->orderBy("created_at","desc")->get();
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $drivers = SisDriver::where("status",$this->status)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $this->resetPage();
            $drivers = SisDriver::where("status", $this->status)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('paternal_surname', 'like', '%' . $this->search . '%')
                    ->orWhere('maternal_surname', 'like', '%' . $this->search . '%')
                    ->orWhere('ci_number', 'like', '%' . $this->search . '%')
                    ->orWhere('license_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(10);

        }

        return view('livewire.template.sis.drivers.driver', [
            'drivers' => $drivers
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal cistern (Para Crear o Actualizar)
    public function showModalDriver($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear una conductor, caso contrario se actualizará una conductor
        if ($id == 0)
        {
            // Reset the input fields after saving
            $this->reset(['name', 'paternal_surname', 'maternal_surname', 'ci_number', 'license_number', 'start_date', 'end_date', 'photo_path']);
            $this->driver_id = 0;
            // $this->plate = "";
        }
        else
        {
            // Obtiene el conductor a actualizar y lo guarda en una variable
            $driver = SisDriver::find($id);

            // Actualiza las variables globales a través de la variable driver
            $this->name = $driver->name;
            $this->paternal_surname = $driver->paternal_surname;
            $this->maternal_surname = $driver->maternal_surname;
            $this->ci_number = $driver->ci_number;
            $this->license_number = $driver->license_number;
            $this->start_date = $driver->start_date;
            $this->end_date = $driver->end_date;
            $this->photo_path = $driver->photo_path;
            $this->cistern_id = $driver->cistern_id;

            // Actualiza la variable global driver_id a través de la variable recibida
            $this->driver_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-driver");
    }
    // Crea una nuevo conductor
    public function create_driver()
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'paternal_surname' => 'nullable|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'ci_number' => 'nullable|string|max:255|unique:sis_drivers,ci_number',
            'license_number' => 'nullable|string|max:255|unique:sis_drivers,license_number',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'photo_path' => 'nullable|string|max:255',
            'cistern_id' => 'required',
        ];

        // Mensajes de validación
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no debe pasar los 255 caracteres',

            'paternal_surname.max' => 'El apellido paterno no debe pasar los 255 caracteres',

            'maternal_surname.max' => 'El apellido materno no debe pasar los 255 caracteres',

            'ci_number.unique' => 'Ya existe un conductor con ese número de C.I.',
            'ci_number.max' => 'El número de C.I. no debe pasar los 255 caracteres',

            'license_number.unique' => 'Ya existe un conductor con ese número de licencia',
            'license_number.max' => 'El número de licencia no debe pasar los 255 caracteres',

            'start_date.date' => 'La fecha de inicio debe ser una fecha válida',

            'end_date.date' => 'La fecha de fin debe ser una fecha válida',

            'photo_path.max' => 'La ruta de la foto no debe pasar los 255 caracteres',

            'cistern_id.required' => 'El ID de la conductor asignada es requerido',
        ];

        $this->validate($rules, $messages);


        // Elimina espacios en blanco extras y reemplaza múltiples espacios en blanco por un solo espacio
        $this->name = trim(preg_replace('/\s+/', ' ', $this->name));
        $this->paternal_surname = trim(preg_replace('/\s+/', ' ', $this->paternal_surname));
        $this->maternal_surname = trim(preg_replace('/\s+/', ' ', $this->maternal_surname));
        $this->ci_number = trim(preg_replace('/\s+/', ' ', $this->ci_number));
        $this->license_number = trim(preg_replace('/\s+/', ' ', $this->license_number));

        // Crea el conductor y guarda el objeto creado en una variable
        $driver = SisDriver::create([
            'name' => $this->name,
            'paternal_surname' => $this->paternal_surname,
            'maternal_surname' => $this->maternal_surname,
            'ci_number' => $this->ci_number,
            'license_number' => $this->license_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'photo_path' => $this->photo_path,
            'cistern_id' => $this->cistern_id
        ]);

        // Reset the input fields after saving
        $this->reset(['name', 'paternal_surname', 'maternal_surname', 'ci_number', 'license_number', 'start_date', 'end_date', 'photo_path', 'cistern_id']);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Conductor '" . $driver->name . " " . $driver->paternal_surname . "' creado exitosamente";

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);

        // Cierra la ventana modal
        $this->emit("hide-modal-driver");

    }

    // Verifica si un conductor tiene registros con su id y muestra una alerta para inactivar o eliminar la conductor
    public function check_driver(SisDriver $driver)
    {
        // Buscando conductores que tengan el id de la conductor
        $driveCount = false;
        // Cambia los parámetros de la alerta dependiendo si la variable driveCount tiene registros
        if ($driveCount)
        {
            $alert_title = "¿Inactivar Conductor?";
            $alert_text = "La Conductor con placa:'" . $driver->plate . "' tiene conductores que usan su nombre, por lo cual no puede ser eliminada, pero puede ser inactivada para que ya no pueda ser usada.";
            $alert_confirmButtonText = "Inactivar";
            $alert_icon = "warning";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Conductor?";
            $alert_text = "El conductor '" . $driver->name . " " . $driver->paternal_surname . " " . $driver->maternal_surname . "' sera eliminado.";
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
            'id' => $driver->id
        ]);
    }

    // Actualiza un conductor
    public function update_driver()
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'paternal_surname' => 'nullable|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'ci_number' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'photo_path' => 'nullable|string|max:255',
            'cistern_id' => 'required|exists:sis_cisterns,id',
        ];

        // Mensajes de validación
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no debe pasar los 255 caracteres',

            'paternal_surname.max' => 'El apellido paterno no debe pasar los 255 caracteres',

            'maternal_surname.max' => 'El apellido materno no debe pasar los 255 caracteres',

            'ci_number.max' => 'El número de C.I. no debe pasar los 255 caracteres',

            'license_number.max' => 'El número de licencia no debe pasar los 255 caracteres',

            'start_date.date' => 'La fecha de inicio debe ser una fecha válida',

            'end_date.date' => 'La fecha de fin debe ser una fecha válida',

            'photo_path.max' => 'La ruta de la foto no debe pasar los 255 caracteres',

            'cistern_id.required' => 'El ID de la conductor asignada es requerido',
            'cistern_id.exists' => 'El ID de la conductor asignada debe existir en la tabla de conductors',
        ];

        $this->validate($rules, $messages);

        // Busca el conductor y lo guarda en una variable
        $driver = SisDriver::find($this->driver_id);

        // Actualiza el conductor
        $driver->update([
            'name' => $this->name,
            'paternal_surname' => $this->paternal_surname,
            'maternal_surname' => $this->maternal_surname,
            'ci_number' => $this->ci_number,
            'license_number' => $this->license_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'photo_path' => $this->photo_path,
            'cistern_id' => $this->cistern_id
        ]);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Conductor '" . $driver->name . " " . $driver->paternal_surname . "' actualizado exitosamente";

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);

        // Cierra la ventana modal
        $this->emit("hide-modal-driver");
    }


    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'deleteDriver' => 'delete_driver'
    ];

    // Elimina o inactiva un Conductor
    public function delete_driver($driver_id)
    {
        $driver = SisDriver::find($driver_id);
        $name = $driver->name . ' ' . $driver->paternal_surname . ' ' . $driver->maternal_surname;

        if ($this->delete_cancel) {
            $driver->delete();
            $text = "¡Conductor '" . $name . "' eliminado exitósamente!";
        } else {
            $driver->update([
                'status' => "inactive"
            ]);
            $text = "¡Conductor '" . $name . "' inactivado exitósamente!";
        }

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
    }

}
