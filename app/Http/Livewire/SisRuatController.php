<?php

namespace App\Http\Livewire;

use App\Imports\SisRuatImport;
use App\Models\SisRuat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Fpdi;

class SisRuatController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search, $file_excel;
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
    $chassis_type, 
    $motor_type, 
    $motor_turbo, 
    $weight, 
    $towing_capacity, 
    $observations,
    $image,
    $file;

    public $d_license_plate,
    $d_class,
    $d_mark,
    $d_vehicle_type,
    $d_vehicle_subtype,
    $d_engine_number,
    $d_chassis_number,
    $d_model,
    $d_service,
    $d_policy_type,
    $d_policy_date,
    $d_country,
    $d_customs_import,
    $d_policy_number,
    $d_tax_start_year,
    $d_origin,
    $d_displacement,
    $d_traction,
    $d_number_of_wheels,
    $d_number_of_doors,
    $d_color,
    $d_number_of_places,
    $d_fuel,
    $d_chassis_type,
    $d_motor_type,
    $d_motor_turbo,
    $d_weight,
    $d_towing_capacity,
    $d_observations,
    $d_image,
    $d_file;





    use WithPagination, WithFileUploads;
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
            $ruats = SisRuat::orderBy("created_at","desc")
            ->paginate(100);
        }
        else
        {
            $this->resetPage();
            $ruats = SisRuat::where(function ($query) {
                $query->where('license_plate', 'like', '%' . $this->search . '%')
                    ->orWhere('color', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(100);
        }


        // Verifica que haya Ruat seleccionados para unir sus PDFs
        $ruatsCount = SisRuat::where("status", "active")
        ->where("is_print", "true")
        ->count();
        
        return view('livewire.template.sis.ruats.ruat', [
            'ruats' => $ruats,
            'ruatsCount' => $ruatsCount
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
            // Restablecer los campos de entrada
            $this->reset([
                'image', 'file', 'class', 'mark', 'vehicle_type', 'vehicle_subtype',
                'engine_number', 'chassis_number', 'model', 'service', 'license_plate',
                'policy_type', 'policy_number', 'policy_date', 'tax_start_year',
                'country', 'origin', 'customs_import', 'displacement', 'chassis_type',
                'traction', 'motor_type', 'number_of_wheels', 'motor_turbo',
                'number_of_doors', 'weight', 'number_of_places', 'towing_capacity',
                'fuel', 'color', 'observations'
            ]);

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
            'image' => 'required|image|max:2048', // 2MB Max
            'file' => 'max:5000', // 5MB Max
            'license_plate' => 'required|min:2|max:255|unique:sis_ruats,license_plate',
            'class' => 'required|min:2|max:255',
            'mark' => 'required|min:2|max:255',
            'vehicle_type' => 'nullable|min:2|max:255',
            'vehicle_subtype' => 'nullable|min:2|max:255',
            'engine_number' => 'required|min:2|max:255',
            'chassis_number' => 'nullable|min:2|max:255',
            'model' => 'nullable|min:2|max:255',
            'service' => 'nullable|min:2|max:255',
            'policy_type' => 'nullable|min:2|max:255',
            'policy_date' => 'required|date',
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
            'chassis_type' => 'nullable|min:2|max:255',
            'motor_type' => 'nullable|min:2|max:255',
            'motor_turbo' => 'nullable|boolean',
            'weight' => 'nullable|numeric|min:0',
            'towing_capacity' => 'nullable|numeric|min:0',
            'observations' => 'nullable|max:65535',
        ];
        
        $messages = [
            'image.required' => 'La imagen es requerida',
            'image.image' => 'Debe ser un archivo tipo imagen',
            'image.max' => 'El tamaño no debe pasar de 1MB',

            'file.max' => 'El tamaño no debe pasar de 5MB',

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
            'engine_number.min' => 'El número de motor debe tener al menos 2 caracteres',
            'engine_number.max' => 'El número de motor no debe pasar los 255 caracteres',
        
            'policy_date.required' => 'La fecha de póliza es requerida',
            'policy_date.date' => 'La fecha de póliza debe ser una fecha válida',
        
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

        $path = $this->image->store('ruats', 'public');

        $path_file = $this->file->store('ruats/pdf', 'public');


        // Crea el Ruat y guarda el objeto creado en una variable
        $ruat = SisRuat::create([
            'image' => $path,
            'file' => $path_file,
            'license_plate' => $this->license_plate,
            'class' => $this->class,
            'chassis_number' => $this->chassis_number,
            'mark' => $this->mark,
            'model' => $this->model,
            'vehicle_type' => $this->vehicle_type,
            'service' => $this->service,
            'vehicle_subtype' => $this->vehicle_subtype,
            'engine_number' => $this->engine_number,
            'policy_type' => $this->policy_type,
            'policy_number' => $this->policy_number,
            'policy_date' => $this->policy_date,
            'tax_start_year' => $this->tax_start_year,
            'country' => $this->country,
            'origin' => $this->origin,
            'customs_import' => $this->customs_import,
            'displacement' => $this->displacement,
            'chassis_type' => $this->chassis_type,
            'traction' => $this->traction,
            'motor_type' => $this->motor_type,
            'number_of_wheels' => $this->number_of_wheels,
            'motor_turbo' => $this->motor_turbo,
            'number_of_doors' => $this->number_of_doors,
            'weight' => $this->weight,
            'number_of_places' => $this->number_of_places,
            'towing_capacity' => $this->towing_capacity,
            'fuel' => $this->fuel,
            'color' => $this->color,
            'observations' => $this->observations,
        ]);
        
        // Aquí $ruat contendrá el objeto SisRuat recién creado con los datos proporcionados.
        






        // Texto que se verá en el mensaje de tipo toast
        $text = "Ruat con placa: '" . $ruat->license_plate . "' creada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-ruat");
    }
    // Muestra la ventana modal ruat para mostrar detalles de ese Ruat
    public function showModalRuatDetail($id)
    {
        // Obtiene el RUAT
        
        // $this->ruat_id = $ruat->id;
        
        $ruat = SisRuat::find($id);

        $this->d_license_plate = $ruat->license_plate;
        $this->d_class = $ruat->class;
        $this->d_mark = $ruat->mark;
        $this->d_vehicle_type = $ruat->vehicle_type;
        $this->d_vehicle_subtype = $ruat->vehicle_subtype;
        $this->d_engine_number = $ruat->engine_number;
        $this->d_chassis_number = $ruat->chassis_number;
        $this->d_model = $ruat->model;
        $this->d_service = $ruat->service;
        $this->d_policy_type = $ruat->policy_type;
        $this->d_policy_date = $ruat->policy_date;
        $this->d_country = $ruat->country;
        $this->d_customs_import = $ruat->customs_import;
        $this->d_policy_number = $ruat->policy_number;
        $this->d_tax_start_year = $ruat->tax_start_year;
        $this->d_origin = $ruat->origin;
        $this->d_displacement = $ruat->displacement;
        $this->d_traction = $ruat->traction;
        $this->d_number_of_wheels = $ruat->number_of_wheels;
        $this->d_number_of_doors = $ruat->number_of_doors;
        $this->d_color = $ruat->color;
        $this->d_number_of_places = $ruat->number_of_places;
        $this->d_fuel = $ruat->fuel;
        $this->d_chassis_type = $ruat->chassis_type;
        $this->d_motor_type = $ruat->motor_type;
        $this->d_motor_turbo = $ruat->motor_turbo;
        $this->d_weight = $ruat->weight;
        $this->d_towing_capacity = $ruat->towing_capacity;
        $this->d_observations = $ruat->observations;
        $this->d_image = $ruat->image;
        $this->d_file = $ruat->file;


            
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-ruat-detail");
    }
    // Añade o quita opcion para mandar a imprimir un Ruat
    public function addRemovePrint($value, $id)
    {
        $ruat = SisRuat::find($id);

        if ($ruat->is_print == "true")
        {
            $ruat->is_print = "false";
            $ruat->save();


            // Emite un mensaje de tipo toast
            $this->emit("toast", [
                'text' => 'Ruat con placa "'  . $ruat->license_plate .  '" desmarcada para imprimir',
                'timer' => 3000,
                'icon' => "success"
            ]);
        }
        else
        {
            // dd("es: " . $ruat->is_print);
            $ruat->is_print = "true";
            $ruat->save();
            // Emite un mensaje de tipo toast
            $this->emit("toast", [
                'text' => 'Ruat con placa "'  . $ruat->license_plate .  '" marcada para imprimir',
                'timer' => 3000,
                'icon' => "success"
            ]);
        }
    }
    public function openCombinedPdf()
    {
        $this->joinPdf();
    }
    // Une los PDFs seleccionados
    public function joinPdf()
    {
        $pathPdfs = SisRuat::select("file")->where("is_print", "true")->get();

        if ($pathPdfs->isEmpty()) {
            session()->flash('message', 'No hay PDFs para combinar.');
            return;
        }

        $pdf = new Fpdi();

        foreach ($pathPdfs as $pathPdf) {
            $fullPath = storage_path('app/public/' . $pathPdf->file);

            if (!file_exists($fullPath)) {
                session()->flash('message', "El archivo $fullPath no existe.");
                dd("ocurrio un error el archivo no existe");
                return;    
            }

            $pageCount = $pdf->setSourceFile($fullPath);

            // Importar y usar todas las páginas del archivo PDF
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);

                // Ajustar la orientación de la página
                if ($size['width'] > $size['height']) {
                    $pdf->AddPage('L', [$size['width'], $size['height']]);
                } else {
                    $pdf->AddPage('P', [$size['width'], $size['height']]);
                }

                $pdf->useTemplate($templateId);
            }
        }

        $outputPath = storage_path('app/public/combined.pdf');
        $pdf->Output($outputPath, 'F');
        $url = asset('storage/combined.pdf');
        $this->emit('openPdf', $url);

        session()->flash('message', 'Los PDFs se han combinado exitosamente.');
    }
    // Actualiza un Ruat
    public function update_ruat()
    {
        $rules = [
            'license_plate' => 'required|min:2|max:255',
            'class' => 'required|min:2|max:255',
            'mark' => 'required|min:2|max:255',
            'vehicle_type' => 'nullable|min:2|max:255',
            'vehicle_subtype' => 'nullable|min:2|max:255',
            'engine_number' => 'required|min:2|max:255',
            'chassis_number' => 'nullable|min:2|max:255',
            'model' => 'nullable|min:2|max:255',
            'service' => 'nullable|min:2|max:255',
            'policy_type' => 'nullable|min:2|max:255',
            'policy_date' => 'required|date',
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
            'chassis_type' => 'nullable|min:2|max:255',
            'motor_type' => 'nullable|min:2|max:255',
            'motor_turbo' => 'nullable|boolean',
            'weight' => 'nullable|numeric|min:0',
            'towing_capacity' => 'nullable|numeric|min:0',
            'observations' => 'nullable|max:65535',
        ];
        
        $messages = [

            'file.max' => 'El tamaño no debe pasar de 5MB',

            'license_plate.required' => 'La placa es requerida',
            'license_plate.min' => 'La placa debe tener al menos 2 caracteres',
            'license_plate.max' => 'La placa no debe pasar los 255 caracteres',
        
            'class.required' => 'La clase es requerida',
            'class.min' => 'La clase debe tener al menos 2 caracteres',
            'class.max' => 'La clase no debe pasar los 255 caracteres',
        
            'mark.required' => 'La marca es requerida',
            'mark.min' => 'La marca debe tener al menos 2 caracteres',
            'mark.max' => 'La marca no debe pasar los 255 caracteres',
        
            'engine_number.required' => 'El número de motor es requerido',
            'engine_number.min' => 'El número de motor debe tener al menos 2 caracteres',
            'engine_number.max' => 'El número de motor no debe pasar los 255 caracteres',
        
            'policy_date.required' => 'La fecha de póliza es requerida',
            'policy_date.date' => 'La fecha de póliza debe ser una fecha válida',
        
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


        // Busca el Ruat y lo guarda en una variable
        $ruat = SisRuat::find($this->ruat_id);

        if ($this->image)
        {
            $path = $this->image->store('ruats', 'public');
        }
        else
        {
            $path = $ruat->image;
        }
        if ($this->file)
        {
            $path_file = $this->file->store('ruats/pdf', 'public');
        }
        else
        {
            $path_file = $ruat->file;
        }




        // Actualiza el Ruat
        $ruat->update([
            'image' => $path,
            'file' => $path_file,
            'license_plate' => $this->license_plate,
            'class' => $this->class,
            'chassis_number' => $this->chassis_number,
            'mark' => $this->mark,
            'model' => $this->model,
            'vehicle_type' => $this->vehicle_type,
            'service' => $this->service,
            'vehicle_subtype' => $this->vehicle_subtype,
            'engine_number' => $this->engine_number,
            'policy_type' => $this->policy_type,
            'policy_number' => $this->policy_number,
            'policy_date' => $this->policy_date,
            'tax_start_year' => $this->tax_start_year,
            'country' => $this->country,
            'origin' => $this->origin,
            'customs_import' => $this->customs_import,
            'displacement' => $this->displacement,
            'chassis_type' => $this->chassis_type,
            'traction' => $this->traction,
            'motor_type' => $this->motor_type,
            'number_of_wheels' => $this->number_of_wheels,
            'motor_turbo' => $this->motor_turbo,
            'number_of_doors' => $this->number_of_doors,
            'weight' => $this->weight,
            'number_of_places' => $this->number_of_places,
            'towing_capacity' => $this->towing_capacity,
            'fuel' => $this->fuel,
            'color' => $this->color,
            'observations' => $this->observations,
        ]);
        $ruat->save();
        // Texto que se verá en el mensaje de tipo toast
        $text = 'Ruat con placa: "' . $ruat->license_plate . '" actualizado exitosamente';
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-ruat");
    }
    // Importa archivo Excel
    public function import_excel()
    {

        // dd($this->file_excel->path());
        Excel::import(new SisRuatImport, $this->file_excel->path());
    }
    
    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'delete' => 'delete_ruat'
    ];

    // Elimina un Ruat
    public function delete_ruat($ruat_id)
    {
        try
        {
            // Inicia una transacción
            DB::beginTransaction();
    
            // Encuentra el registro Ruat
            $ruat = SisRuat::find($ruat_id);
    
            if (!$ruat)
            {
                throw new \Exception('Ruat no encontrado');
            }
    
            // Eliminar archivos
            Storage::disk('public')->delete($ruat->image); 
            Storage::disk('public')->delete($ruat->file);
    
            // Guarda la placa del auto antes de eliminar el registro
            $license_plate = $ruat->license_plate;
            $ruat->delete();
    
            // Emite el mensaje de éxito
            $text = '¡Ruat con placa: "' . $license_plate . '" eliminado exitósamente!';
            $this->emit("toast", [
                'text' => $text,
                'timer' => 4000,
                'icon' => "success"
            ]);
    
            // Confirma la transacción
            DB::commit();
        }
        catch (\Throwable $th)
        {
            // Rollback en caso de error
            DB::rollBack();

            $text = "<b>Archivo:</b> " . $th->getFile() . "<br>"
            . "<b>Línea:</b> " . $th->getLine() . "<br>"
            . "<b>Código:</b> " . $th->getCode() . "<br>"
            . "<b>Mensaje:</b> " . $th->getMessage();

            $this->emit("message", [
                'text' => $text,
                'title' => "Se encontro un error",
                'icon' => "error"
            ]);
        }
    }
}
