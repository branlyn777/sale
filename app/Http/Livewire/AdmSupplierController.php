<?php

namespace App\Http\Livewire;

use App\Models\AdmSupplier;
use App\Models\invBuy;
use Livewire\Component;
use Livewire\WithPagination;

class AdmSupplierController extends Component
{
    // Guarda los terminos de busqueda para encontrar un proveedor
    public $search;
    // Datos para crear o actualizar un proveedor
    public $name_supplier, $address, $phone_number_a, $phone_number_b, $mail, $other_details;
    // Guarda el id del proveedor
    public $supplier_id;
    // Guarda true o false para eliminar o inactivar un proveedor
    public $delete_cancel;
    // Guarda true o false para mostrar proveedores activos o inactivos
    public $status;
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->supplier_id = 0;
        $this->status = "active";
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $suppliers = AdmSupplier::where("status",$this->status)
            ->where("id", "<>", 1)
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $suppliers = AdmSupplier::where("status",$this->status)
            ->where("id", "<>", 1)
            ->where('name_supplier', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
        }
        return view('livewire.template.administration.supplier.supplier', [
            'suppliers' => $suppliers
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Proveedores (Para Crear o Actualizar)
    public function showModalSupplier($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear un proveedor, caso contrario se actualizará un proveedor
        if ($id == 0)
        {
            $this->supplier_id = 0;
            $this->name_supplier = "";
            $this->address = null;
            $this->phone_number_a = null;
            $this->phone_number_b = null;
            $this->mail = null;
            $this->other_details = null;
        }
        else
        {
            // Obteniene el proveedor a actualizar y lo guarda en una variable
            $supplier = AdmSupplier::find($id);
            // Actualiza las variables para actualizar el proveedor
            $this->name_supplier = $supplier->name_supplier;
            $this->address = $supplier->address;
            $this->phone_number_a = $supplier->phone_number_a;
            $this->phone_number_b = $supplier->phone_number_b;
            $this->mail = $supplier->mail;
            $this->other_details = $supplier->other_details;
            // Actualiza la variable global supplier_id a travez de la variable recibida
            $this->supplier_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-supplier");
    }
    // Crea una nuevo proveedor
    public function create_supplier()
    {
        // Elimina espacios en blanco extras y reemplaza multiples espacios en blanco por un solo espacio
        $this->name_supplier = trim(preg_replace('/\s+/', ' ', $this->name_supplier));
        $this->mail = trim(preg_replace('/\s+/', ' ', $this->mail));
        $rules = [
            'name_supplier' => 'required|min:2|max:255|unique:adm_suppliers,name_supplier',
            'address' => 'max:255',
            'phone_number_a' => 'max:100',
            'phone_number_b' => 'max:100',
            'mail' => 'nullable|email|max:100',
            'other_details' => 'max:500'
        ];
        $messages = [
            'name_supplier.required' => 'El nombre del proveedor es requerido',
            'name_supplier.unique' => 'Ya existe el nombre del proveedor',
            'name_supplier.min' => 'El nombre del proveedor debe tener al menos 2 caracteres',
            'name_supplier.max' => 'El nombre del proveedor no debe pasar los 255 caracteres',
            'address.max' => 'El nombre del proveedor no debe pasar los 255 caracteres',
            'phone_number_a.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'phone_number_b.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'mail.email' => 'Inserte un correo válido',
            'mail.max' => 'El nombre del proveedor no debe pasar los 100 caracteres',
            'name_supplier.max' => 'El nombre del proveedor no debe pasar los 500 caracteres',
        ];
        $this->validate($rules, $messages);
        // Crea al proveedor y guarda el objeto creado en una variable
        $supplier = AdmSupplier::create([
            'name_supplier' =>  $this->name_supplier,
            'address' =>  $this->address,
            'phone_number_a' =>  $this->phone_number_a,
            'phone_number_b' =>  $this->phone_number_b,
            'mail' =>  $this->mail,
            'other_details' =>  $this->other_details
        ]);
        // Texto que se verá en el mensaje de tipo toast
        $text = "Proveedor '" . $supplier->name_supplier . "' creado exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-supplier");
    }
    // Verifica si un proveedor tiene registros con su id y muestra una alerta para inactivar o eliminar el proveedor
    public function check_supplier(AdmSupplier $supplier)
    {
        // Buscando compras que tengan el id del proveedor
        $supplierCount = invBuy::where('adm_supplier_id', $supplier->id)->exists();
        // Cambia los parámetros de la alerta dependiendo si la variable supplierCount tiene registros
        if ($supplierCount)
        {
            $alert_title = "¿Inactivar Proveedor?";
            $alert_text = "El proveedor '" . $supplier->name_supplier . "' tiene compras a su nombre, por lo cual no puede ser eliminado, pero puede ser inactivado para que ya no pueda ser usado.";
            $alert_confirmButtonText = "Inactivar";
            $alert_icon = "warning";
            $this->delete_cancel = false;
        }
        else
        {
            $alert_title = "¿Eliminar Proveedor?";
            $alert_text = "El proveedor '" . $supplier->name_supplier . "' no es usado en ninguna compra por lo cual puede ser eliminado.";
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
            'id' => $supplier->id
        ]);
    }
     // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
     protected $listeners = [
        'deleteSupplier' => 'delete_supplier'
    ];
    // Elimina o inactiva un proveedor
    public function delete_supplier($supplier_id)
    {
        $supplier = AdmSupplier::find($supplier_id);
        $name_supplier = $supplier->name_supplier;
        if ($this->delete_cancel)
        {
            $supplier->delete();
            $text = "¡Proveedor '" . $name_supplier . "' eliminado exitósamente!";
        }
        else
        {
            $supplier->update([
                'status' => "inactive"
            ]);
            $supplier->save();
            $text = "¡Proveedor '" . $name_supplier . "' inactivado exitósamente!";
        }
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
    }
}