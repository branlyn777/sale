<?php

namespace App\Http\Livewire;

use App\Imports\SisPayrollImport;
use Livewire\Component;
use App\Models\SisPayroll;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SisPayrollController extends Component
{
    public $client_id, $search;
    public $payroll_id;
    public $cliente;
    public $numero_de_transporte;
    public $propietario;
    public $placa;
    public $tramo;
    public $producto;
    public $fecha_de_carga;
    public $carguio;
    public $fecha_de_llegada;
    public $volumen_descarguio;
    public $cobros_al_100_de_la_merma;
    public $merma_cobrable;
    public $precio_de_la_merma;
    public $merma_por_cobrar;
    public $flete;
    public $liquido_basico;
    public $derecho_de_empresa;
    public $liquido_facturado;
    public $anticipo;
    public $fecha_de_pago_anticipo;
    public $fecha_de_pago_anticipo_literal;
    public $saldo;
    public $fecha_de_pago;
    public $fecha_literal_de_pago;


    // Para guardar el excel
    public $file_excel_payroll;

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $payrolls = "";

        if (strlen($this->search) == 0)
        {
            $payrolls = SisPayroll::orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $payrolls = SisPayroll::orderBy("created_at","desc")
            ->where('placa', 'like', '%' . $this->search . '%')
            ->paginate(10);
        }


        return view('livewire.template.sis.payrolls.payroll', [
            'payrolls' => $payrolls
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function showModalPayroll($id)
    {
        if ($id == 0) {
            // Restablece las variables
            // $this->reset([
            //     'cliente', 'numero_de_transporte', 'propietario', 'placa', 'tramo', 'producto',
            //     'fecha_de_carga', 'carguio', 'fecha_de_llegada', 'volumen_descarguio', 'cobros_al_100_de_la_merma',
            //     'merma_cobrable', 'precio_de_la_merma', 'merma_por_cobrar', 'flete', 'liquido_basico', 'derecho_de_empresa',
            //     'liquido_facturado', 'anticipo', 'fecha_de_pago_anticipo', 'fecha_de_pago_anticipo_literal', 'saldo',
            //     'fecha_de_pago', 'fecha_de_pago_saldo_literal', 'total', 'total_deuda', 'factura_numero', 'fecha', 'it',
            //     'resolucion_internacional', 'poliza_de_responsabilidad_civil', 'poliza_de_transporte', 'iva', 'gastos_administrativos_santa_cruz',
            //     'merma', 'ibmetro', 'rastreo_satelital', 'otros_descuentos', 'totales'
            // ]);
            
            $this->payroll_id = 0; // Asegúrate de tener esta variable para identificar el ID de la planilla
        } else {
            // Carga los datos de la planilla para la edición
            $payroll = SisPayroll::find($id);
    
            if ($payroll) {
                $this->cliente = $payroll->cliente;
                $this->numero_de_transporte = $payroll->numero_de_transporte;
                $this->propietario = $payroll->propietario;
                $this->placa = $payroll->placa;
                $this->tramo = $payroll->tramo;
                $this->producto = $payroll->producto;
                $this->fecha_de_carga = $payroll->fecha_de_carga;
                $this->carguio = $payroll->carguio;
                $this->fecha_de_llegada = $payroll->fecha_de_llegada;
                $this->volumen_descarguio = $payroll->volumen_descarguio;
                $this->cobros_al_100_de_la_merma = $payroll->cobros_al_100_de_la_merma;
                $this->merma_cobrable = $payroll->merma_cobrable;
                $this->precio_de_la_merma = $payroll->precio_de_la_merma;
                $this->merma_por_cobrar = $payroll->merma_por_cobrar;
                $this->flete = $payroll->flete;
                $this->liquido_basico = $payroll->liquido_basico;
                $this->derecho_de_empresa = $payroll->derecho_de_empresa;
                $this->liquido_facturado = $payroll->liquido_facturado;
                $this->anticipo = $payroll->anticipo;
                $this->fecha_de_pago_anticipo = $payroll->fecha_de_pago_anticipo;
                $this->fecha_de_pago_anticipo_literal = $payroll->fecha_de_pago_anticipo_literal;
                $this->saldo = $payroll->saldo;
                $this->fecha_de_pago = $payroll->fecha_de_pago;
                // $this->fecha_de_pago_saldo_literal = $payroll->fecha_de_pago_saldo_literal;
                // $this->total = $payroll->total;
                // $this->total_deuda = $payroll->total_deuda;
                // $this->factura_numero = $payroll->factura_numero;
                // $this->fecha = $payroll->fecha;
                // $this->it = $payroll->it;
                // $this->resolucion_internacional = $payroll->resolucion_internacional;
                // $this->poliza_de_responsabilidad_civil = $payroll->poliza_de_responsabilidad_civil;
                // $this->poliza_de_transporte = $payroll->poliza_de_transporte;
                // $this->iva = $payroll->iva;
                // $this->gastos_administrativos_santa_cruz = $payroll->gastos_administrativos_santa_cruz;
                // $this->merma = $payroll->merma;
                // $this->ibmetro = $payroll->ibmetro;
                // $this->rastreo_satelital = $payroll->rastreo_satelital;
                // $this->otros_descuentos = $payroll->otros_descuentos;
                // $this->totales = $payroll->totales;
    
                $this->payroll_id = $payroll->id; // Guarda el ID de la planilla para referencia
            }
        }
    
        $this->emit("show-modal-payroll");
    }
    

    // Crea una nueva planilla de pagos
    public function create_payroll()
    {
        $rules = [
            'cliente' => 'required|min:2|max:255',
            'numero_de_transporte' => 'required|min:2|max:255',
            'propietario' => 'required|min:2|max:255',
            'placa' => 'required|min:2|max:10',
            'tramo' => 'required|min:2|max:255',
            'producto' => 'required|min:2|max:255',
            'fecha_de_carga' => 'required|date',
            'carguio' => 'required|min:2|max:255',
            'fecha_de_llegada' => 'required|date',
            'volumen_descarguio' => 'required|numeric|min:0',
            'cobros_al_100_de_la_merma' => 'required|numeric|min:0',
            'merma_cobrable' => 'required|numeric|min:0',
            'precio_de_la_merma' => 'required|numeric|min:0',
            'merma_por_cobrar' => 'required|numeric|min:0',
            'flete' => 'required|numeric|min:0',
            'liquido_basico' => 'required|numeric|min:0',
            'derecho_de_empresa' => 'required|numeric|min:0',
            'liquido_facturado' => 'required|numeric|min:0',
            'anticipo' => 'required|numeric|min:0',
            'fecha_de_pago_anticipo' => 'required|date',
            'fecha_de_pago_anticipo_literal' => 'required|string|max:255',
            'saldo' => 'required|numeric|min:0',
            'fecha_de_pago' => 'required|date',
            'fecha_literal_de_pago' => 'required|string|max:255',
        ];

        $messages = [
            'required' => 'Este campo es requerido',
            'min' => 'Este campo debe tener al menos :min caracteres o valor mínimo de :min',
            'max' => 'Este campo no debe pasar los :max caracteres',
            'numeric' => 'Este campo debe ser numérico',
            'date' => 'Este campo debe ser una fecha válida',
            'string' => 'Este campo debe ser una cadena de texto'
        ];

        $this->validate($rules, $messages);

        // Crea la planilla y guarda el objeto creado en una variable
        $payroll = SisPayroll::create([
            'cliente' => trim(preg_replace('/\s+/', ' ', $this->cliente)),
            'numero_de_transporte' => trim(preg_replace('/\s+/', ' ', $this->numero_de_transporte)),
            'propietario' => trim(preg_replace('/\s+/', ' ', $this->propietario)),
            'placa' => trim(preg_replace('/\s+/', ' ', $this->placa)),
            'tramo' => trim(preg_replace('/\s+/', ' ', $this->tramo)),
            'producto' => trim(preg_replace('/\s+/', ' ', $this->producto)),
            'fecha_de_carga' => $this->fecha_de_carga,
            'carguio' => trim(preg_replace('/\s+/', ' ', $this->carguio)),
            'fecha_de_llegada' => $this->fecha_de_llegada,
            'volumen_descarguio' => $this->volumen_descarguio,
            'cobros_al_100_de_la_merma' => $this->cobros_al_100_de_la_merma,
            'merma_cobrable' => $this->merma_cobrable,
            'precio_de_la_merma' => $this->precio_de_la_merma,
            'merma_por_cobrar' => $this->merma_por_cobrar,
            'flete' => $this->flete,
            'liquido_basico' => $this->liquido_basico,
            'derecho_de_empresa' => $this->derecho_de_empresa,
            'liquido_facturado' => $this->liquido_facturado,
            'anticipo' => $this->anticipo,
            'fecha_de_pago_anticipo' => $this->fecha_de_pago_anticipo,
            'fecha_de_pago_anticipo_literal' => trim(preg_replace('/\s+/', ' ', $this->fecha_de_pago_anticipo_literal)),
            'saldo' => $this->saldo,
            'fecha_de_pago' => $this->fecha_de_pago,
            'fecha_literal_de_pago' => trim(preg_replace('/\s+/', ' ', $this->fecha_literal_de_pago)),
        ]);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Planilla de pagos para '" . $payroll->cliente . "' creada exitosamente";

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);

        // Cierra la ventana modal
        $this->emit("hide-modal-payroll");
    }


    // Actualiza una planilla
    public function update_payroll()
    {
        // Busca la planilla y la guarda en una variable
        $payroll = SisPayroll::find($this->payroll_id);

        // Si no se encuentra la planilla, emite un mensaje de error
        if (!$payroll) {
            $this->emit("toast", [
                'text' => 'Planilla no encontrada',
                'timer' => 3000,
                'icon' => 'error'
            ]);
            return;
        }

        // Actualiza la planilla
        $payroll->update([
            'cliente' => $this->cliente,
            'numero_de_transporte' => $this->numero_de_transporte,
            'propietario' => $this->propietario,
            'placa' => $this->placa,
            'tramo' => $this->tramo,
            'producto' => $this->producto,
            'fecha_de_carga' => $this->fecha_de_carga,
            'carguio' => $this->carguio,
            'fecha_de_llegada' => $this->fecha_de_llegada,
            'volumen_descarguio' => $this->volumen_descarguio,
            'cobros_al_100_de_la_merma' => $this->cobros_al_100_de_la_merma,
            'merma_cobrable' => $this->merma_cobrable,
            'precio_de_la_merma' => $this->precio_de_la_merma,
            'merma_por_cobrar' => $this->merma_por_cobrar,
            'flete' => $this->flete,
            'liquido_basico' => $this->liquido_basico,
            'derecho_de_empresa' => $this->derecho_de_empresa,
            'liquido_facturado' => $this->liquido_facturado,
            'anticipo' => $this->anticipo,
            'fecha_de_pago_anticipo' => $this->fecha_de_pago_anticipo,
            'fecha_de_pago_anticipo_literal' => $this->fecha_de_pago_anticipo_literal,
            'saldo' => $this->saldo,
            'fecha_de_pago' => $this->fecha_de_pago
        ]);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Planilla '" . $payroll->cliente . "' actualizada exitosamente";

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);

        // Cierra la ventana modal
        $this->emit("hide-modal-payroll");
    }


    public function import_excel_payroll()
    {
        $import = new SisPayrollImport();
        $filePath = $this->file_excel_payroll->path();
        
        try
        {
            Excel::import($import, $filePath);
            
            // Obtener la colección y mostrarla con dd()
            $collection = $import->getCollection();
    
            // Eliminar el archivo después de la importación
            if (file_exists($filePath))
            {
                unlink($filePath);
            }

            // Realizar el insert de todos los registros en la tabla
            foreach ($collection as $row)
            {
                SisPayroll::create($row); // Aquí $row ya es un array
            }
    
            // dd($collection->toArray());
            
        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }
    
    // Genera el PDF - Boleta de Pago
    public function paymentSlipPDF($id)
    {
        $payroll = SisPayroll::find($id);
        
        // Datos que se pasan al PDF
        $data = [
            'placa' => $payroll->placa, // Este campo existe en la migración
            'tramo' => $payroll->tramo, // Este campo existe en la migración
            
            'fechaCarguio' => $payroll->fecha_de_carga, // Este campo existe en la migración como 'fecha_de_carga'
            
            // Este campo existe en la migración
            'volumenCarguio' => $payroll->carguio, 
            
            'volumenDescarguio' => $payroll->volumen_descarguio, // Este campo existe en la migración
            
            // diferencia = carguio - volumen_descarguio
            'diferencia' => $payroll->carguio - $payroll->volumen_descarguio,
            
            'flete' => $payroll->flete, // Este campo existe en la migración
            
            // Este campo 'liquidoFacturar' viene de la migración como 'liquido_facturado'
            'liquidoFacturar' => $payroll->liquido_basico, 
            
            'derechoEmpresa' => $payroll->derecho_de_empresa, // Este campo existe en la migración
            
            // Este campo 'totalFlete'debes usar 'liquido_basico' - 'derecho_de_empresa'
            'totalFlete' => $payroll->liquido_basico - $payroll->derecho_de_empresa,
            
            // Este campo 'gastosOperativos' viene de la migración como 'it', 'resolucion_internacional', 'poliza_de_responsabilidad_civil', 'poliza_de_transporte', 'iva', 'gastos_administrativos_santa_cruz', 'merma', 'ibmetro', 'rastreo_satelital'
            'gastosOperativos' => $payroll->it + $payroll->resolucion_internacional + $payroll->poliza_de_responsabilidad_civil + $payroll->poliza_de_transporte + $payroll->iva + $payroll->gastos_administrativos_santa_cruz + $payroll->merma + $payroll->ibmetro + $payroll->rastreo_satelital,
            
            // Este campo 'anticiposCancelados' viene de la migración como 'anticipo'
            'anticiposCancelados' => $payroll->anticipo,
            
            // Este campo 'importeCancelado' viene de la migración como 'saldo'
            'importeCancelado' => $payroll->saldo,
            
            // Este campo 'recibidoPor' viene de la migración como 'propietario'
            'recibidoPor' => $payroll->propietario,
            
            // Este campo 'ci' no existe en la migración
            'ci' => 'NO SE ENCUENTRA', 
            
            // Este campo 'fecha' existe en la migración como 'fecha'
            'fecha' => $payroll->fecha,

            // Este campo 'fechaDescarguio' viene de la migración como 'fecha_de_llegada'
            'fechaDescarguio' => $payroll->fecha_de_llegada,

            // Este campo 'cliente' viene de la migración como 'cliente'
            'cliente' => $payroll->cliente,

            // Este campo 'id' viene de la migración como 'id'
            'id' => $payroll->id,
            // Este campo existe en la migración
            'producto' => $payroll->producto, 

        ];
    
        // Renderizar la vista con los datos
        $html = view('livewire.template.sis.payrolls.pdf_payment_slip', $data)->render();
    
        // Generar el PDF con el contenido del modal
        $pdf = SnappyPdf::loadHTML($html);
    
        // Guardar el PDF temporalmente en el almacenamiento público o temporal
        $pdfPath = 'pdfs/payment_slip.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());
    
        // Emitir evento para abrir el PDF en una nueva pestaña
        $this->emit('openPdf', Storage::url($pdfPath));
    }
    // Genera el PDF - Planilla de Gastos Operativos
    public function expensesSheetPDF($id)
    {
        $payroll = SisPayroll::find($id);
        
        // Asignar valores a partir del objeto $payroll
        $data = [
            'placa' => $payroll->placa,
            'tramo' => $payroll->tramo,
            'fechaCarguio' => $payroll->fecha_de_carga,
            'volumenCarguio' => $payroll->carguio,
            'volumenDescarguio' => $payroll->volumen_descarguio,
            'diferencia' => $payroll->carguio - $payroll->volumen_descarguio,
            'flete' => $payroll->flete,
            'liquidoFacturar' => $payroll->liquido_basico,
            'derechoEmpresa' => $payroll->derecho_de_empresa,
            'totalFlete' => $payroll->liquido_basico - $payroll->derecho_de_empresa,
            'gastosOperativos' => $payroll->it + $payroll->resolucion_internacional + $payroll->poliza_de_responsabilidad_civil + $payroll->poliza_de_transporte + $payroll->iva + $payroll->gastos_administrativos_santa_cruz + $payroll->merma + $payroll->ibmetro + $payroll->rastreo_satelital,
            'anticiposCancelados' => $payroll->anticipo,
            'importeCancelado' => $payroll->saldo,
            'recibidoPor' => $payroll->propietario,
            'ci' => $payroll->ci ?? 'NO SE ENCUENTRA', // Verifica si existe 'ci' en $payroll, si no, usa un valor genérico
            'fecha' => $payroll->fecha,
            'fechaDescarguio' => $payroll->fecha_de_llegada,
            'cliente' => $payroll->cliente,
            'producto' => $payroll->producto,
            'numeroDeTransporte' => $payroll->numero_de_transporte, // Nuevo campo
            'cobrosAl100DeLaMerma' => $payroll->cobros_al_100_de_la_merma, // Nuevo campo
            'mermaCobrable' => $payroll->merma_cobrable, // Nuevo campo
            'precioDeLaMerma' => $payroll->precio_de_la_merma, // Nuevo campo
            'mermaPorCobrar' => $payroll->merma_por_cobrar, // Nuevo campo
            'liquidoFacturado' => $payroll->liquido_facturado, // Nuevo campo
            'fechaDePagoAnticipo' => $payroll->fecha_de_pago_anticipo, // Nuevo campo
            'fechaDePagoAnticipoLiteral' => $payroll->fecha_de_pago_anticipo_literal, // Nuevo campo
            'fechaDePago' => $payroll->fecha_de_pago, // Nuevo campo
            'fechaDePagoSaldoLiteral' => $payroll->fecha_de_pago_saldo_literal, // Nuevo campo
            'total' => $payroll->total, // Nuevo campo
            'totalDeuda' => $payroll->total_deuda, // Nuevo campo
            'facturaNumero' => $payroll->factura_numero, // Nuevo campo
            'otrosDescuentos' => $payroll->otros_descuentos, // Nuevo campo
            'totales' => $payroll->totales, // Nuevo campo
        ];

        // Variables genéricas añadidas
        $data['precioMerma'] = $payroll->precio_de_la_merma ?? 0; // Si no se obtiene del modelo, poner un valor genérico
        $data['it'] = $payroll->it ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['resolucionInternacional'] = $payroll->resolucion_internacional ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['polizaResponsabilidadCivil'] = $payroll->poliza_de_responsabilidad_civil ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['polizaTransporte'] = $payroll->poliza_de_transporte ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['iva'] = $payroll->iva ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['gastosAdministrativosSantaCruz'] = $payroll->gastos_administrativos_santa_cruz ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['merma'] = $payroll->merma ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['ibmetro'] = $payroll->ibmetro ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['rastreoSatelital'] = $payroll->rastreo_satelital ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['importePorCobrar'] = $payroll->importe_por_cobrar ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico
        $data['id'] = $payroll->id ?? 0; // Verifica si existe en $payroll, si no, usa un valor genérico

        // Renderizar la vista con los datos
        $html = view('livewire.template.sis.payrolls.pdf_expenses_sheet', $data)->render();

        // Generar el PDF con el contenido del modal
        $pdf = SnappyPdf::loadHTML($html);

        // Guardar el PDF temporalmente en el almacenamiento público o temporal
        $pdfPath = 'pdfs/payment_slip.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Emitir evento para abrir el PDF en una nueva pestaña
        $this->emit('openPdf', Storage::url($pdfPath));
    }
    // Genera el PDF - Pago de Anticipo
    public function advancePaymentPDF($id)
    {
        $payroll = SisPayroll::find($id);
        
        // Asignar valores a partir del objeto $payroll
        $data['numero_de_transporte'] = $payroll->numero_de_transporte;

        // Renderizar la vista con los datos
        $html = view('livewire.template.sis.payrolls.pdf_advance_payment', $data)->render();

        // Generar el PDF con el contenido del modal
        $pdf = SnappyPdf::loadHTML($html);

        // Guardar el PDF temporalmente en el almacenamiento público o temporal
        $pdfPath = 'pdfs/advance_payment.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Emitir evento para abrir el PDF en una nueva pestaña
        $this->emit('openPdf', Storage::url($pdfPath));
    }

    protected $listeners = [
        'delete' => 'delete_payroll'
    ];
    
    // Elimina una planilla
    public function delete_payroll($payroll_id)
    {
        try
        {
            // Inicia una transacción
            DB::beginTransaction();
    
            // Encuentra el registro de la planilla
            $payroll = SisPayroll::find($payroll_id);
    
            if (!$payroll)
            {
                throw new \Exception('Planilla no encontrada');
            }
    
            // Elimina el registro
            $payroll->delete();
    
            // Texto que se verá en el mensaje de tipo toast
            $text = '¡Planilla con ID: "' . $payroll_id . '" eliminada exitosamente!';
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
                'title' => "Se encontró un error",
                'icon' => "error"
            ]);
        }
    }
    
}
