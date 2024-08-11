<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SisPayrollImport;

class ImportPayroll extends Component
{
    public $file_excel_payroll;

    public function import_excel_payroll()
    {
        // Validar el archivo
        $this->validate([
            'file_excel_payroll' => 'required|file|mimes:xls,xlsx'
        ]);

        // Guardar el archivo subido
        $path = $this->file_excel_payroll->store('uploads');

        // Importar los datos del archivo
        Excel::import(new SisPayrollImport, storage_path('app/' . $path));

        // Limpiar el archivo subido
        $this->file_excel_payroll = null;

        // Emitir un evento o mostrar un mensaje de éxito
        session()->flash('success', 'Datos importados correctamente.');
    }















    public function render()
    {
        return view('livewire.import-payroll');
    }
}
