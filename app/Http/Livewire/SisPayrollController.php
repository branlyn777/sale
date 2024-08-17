<?php

namespace App\Http\Livewire;

use App\Imports\SisPayrollImport;
use Livewire\Component;
use App\Models\SisPayroll;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SisPayrollController extends Component
{
    public $client_id, $search;
    public $cliente, $numero_de_transporte, $propietario, 
    $placa, $tramo, $producto, $fecha_de_carga, $carguio, 
    $fecha_de_llegada, $volumen_descarguio, $cobros_al_100_de_la_merma, 
    $merma_cobrable, $precio_de_la_merma, $merma_por_cobrar, $flete, 
    $liquido_basico, $derecho_de_empresa, $liquido_facturado, $anticipo, $fecha_de_pago_anticipo,
    $fecha_de_pago_anticipo_literal, $saldo, $fecha_de_pago, $fecha_de_pago_saldo_literal, $total,
    $total_deuda, $factura_numero, $fecha, $it, $resolucion_internacional, $poliza_de_responsabilidad_civil, 
    $poliza_de_transporte, $iva, $gastos_administrativos_santa_cruz, $merma, $ibmetro, $rastreo_satelital, $otros_descuentos,
    $totales;

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
        if ($id == 0)
        {
            // Reset the input fields after saving
            $this->reset(['cliente', 'numero_de_transporte', 'propietario', 'placa','tramo','producto',
            'fecha_de_carga','carguio','fecha_de_llegada','volumen_descarguio','cobros_al_100_de_la_merma',
            'merma_cobrable','precio_de_la_merma','merma_por_cobrar','flete','liquido_basico','derecho_de_empresa',
            'liquido_facturado','anticipo','fecha_de_pago_anticipo','fecha_de_pago_anticipo_literal','saldo',
            'fecha_de_pago','fecha_de_pago_saldo_literal','total','total_deuda','factura_numero','fecha','it',
            'resolucion_internacional','poliza_de_responsabilidad_civil','poliza_de_transporte','iva','gastos_administrativos_santa_cruz',
            'merma','ibmetro','rastreo_satelital','otros_descuentos','totales',]);
            $this->client_id = 0;
            // $this->plate = "";
        }
        else
        {
            // Obteniene la cisterna a actualizar y lo guarda en una variable
            $payroll = SisPayroll::find($id);
            // Actualiza la variable global plate a travez de la variable cistern
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
            $this->fecha_de_pago_saldo_literal = $payroll->fecha_de_pago_saldo_literal;
            $this->total = $payroll->total;
            $this->total_deuda = $payroll->total_deuda;
            $this->factura_numero = $payroll->factura_numero;
            $this->fecha = $payroll->fecha;
            $this->it = $payroll->it;
            $this->resolucion_internacional = $payroll->resolucion_internacional;
            $this->poliza_de_responsabilidad_civil = $payroll->poliza_de_responsabilidad_civil;
            $this->poliza_de_transporte = $payroll->poliza_de_transporte;
            $this->iva = $payroll->iva;
            $this->gastos_administrativos_santa_cruz = $payroll->gastos_administrativos_santa_cruz;
            $this->merma = $payroll->merma;
            $this->ibmetro = $payroll->ibmetro;
            $this->rastreo_satelital = $payroll->rastreo_satelital;
            $this->otros_descuentos = $payroll->otros_descuentos;
            $this->totales = $payroll->totales;
            $this->status = $payroll->status;
            // Actualiza la variable global cistern_id a travez de la variable recibida
            $this->client_id = $id;
        }
        $this->emit("show-modal-payroll");
    }

    public function create_pago()
    {
        $payroll = SisPayroll::create([
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
            'fecha_de_pago' => $this->fecha_de_pago,
            'fecha_de_pago_saldo_literal' => $this->fecha_de_pago_saldo_literal,
            'total' => $this->total,
            'total_deuda' => $this->total_deuda,
            'factura_numero' => $this->factura_numero,
            'fecha' => $this->fecha,
            'it' => $this->it,
            'resolucion_internacional' => $this->resolucion_internacional,
            'poliza_de_responsabilidad_civil' => $this->poliza_de_responsabilidad_civil,
            'poliza_de_transporte' => $this->poliza_de_transporte,
            'iva' => $this->iva,
            'gastos_administrativos_santa_cruz' => $this->gastos_administrativos_santa_cruz,
            'merma' => $this->merma,
            'ibmetro' => $this->ibmetro,
            'rastreo_satelital' => $this->rastreo_satelital,
            'otros_descuentos' => $this->otros_descuentos,
            'totales' => $this->totales,
        ]);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Pago creado exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-ruat");

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
    
    // Genera el PDF
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
}
