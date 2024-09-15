<?php

namespace App\Http\Livewire;

use App\Models\SisCistern;
use App\Models\SisDriver;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SisCisternController extends Component
{
    // Guarda los terminos de busqueda para encontrar
    public $search;
    // Guarda el id de la cisterna
    public $cistern_id;
   
    public $fecha, $placa_1, $placa_2, $tracto, $cisterna, $ruat, $certificado_de_fabricacion_del_tanque, 
       $poliza_de_seguro, $certificado_hermeticidad, $tarjeta_de_cubicacion, $nit, $posterior, 
       $superior, $lateral_izquierdo, $lateral_derecho, $frontal_con_equipos_de_seguridad, 
       $plaqueta_cisterna, $foto_valvulas, $plaqueta, $precintos, $stickers_afericion, 
       $licencia_conductor_principal, $licencia_conductor_reemplazo, $vigencia_poder, $marca, 
       $clase, $forma, $compartimiento_litros_1, $compartimiento_litros_2, $compartimiento_galones_1, 
       $compartimiento_galones_2, $norma_de_fabricacion, $numero_de_rompeolas, $presion_de_diseno, 
       $presion_de_prueba, $compartimiento_1, $compartimiento_2, $largo_1, $largo_2, $ancho_1, 
       $ancho_2, $alto_1, $alto_2, $distancia_entre_ejes_1, $distancia_entre_ejes_2, $tara, 
       $corrosion, $valvulas_de_descarga, $tapas_externas_con_valvulas_de_admision_o_escotillas, 
       $sistemas_de_recuperacion_de_gases_o_vapores, $sistema_de_sensor_de_llenado_o_sobrellenado, 
       $sistema_de_puesta_a_tierra, $sistema_de_carga_por_fondo, $fecha_de_fabricacion, 
       $numero_de_chasis, $numero_de_serie, $numero_de_ejes, $numero_de_llantas, $material, 
       $tipo_de_soldadura_a, $color_cisterna, $tipo_de_soldadura_b, $conductor_de_descarga, 
       $cabeza, $tapas, $manto, $antivuelque, $numero_de_hojas;


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->cistern_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $cisternas = SisCistern::orderBy("created_at","desc")
            ->paginate(100);
        }
        else
        {
            $this->resetPage();
            $cisternas = SisCistern::where(function ($query) {
                $query->where('placa_1', 'like', '%' . $this->search . '%')
                      ->orWhere('placa_1', 'like', '%' . $this->search . '%');
            })
            ->orderBy("created_at", "desc")
            ->paginate(100);
        }

        return view('livewire.template.sis.cisterns.cistern', [
            'cisternas' => $cisternas
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // Muestra la ventana modal cistern (Para Crear o Actualizar)
    public function showModalCistern($id)
    {
        if ($id == 0)
        {
            // Restablece todos los campos de entrada después de guardar
            $this->reset([
                'fecha',
                'placa_1',
                'placa_2',
                'tracto',
                'cisterna',
                'ruat',
                'certificado_de_fabricacion_del_tanque',
                'poliza_de_seguro',
                'certificado_hermeticidad',
                'tarjeta_de_cubicacion',
                'nit',
                'posterior',
                'superior',
                'lateral_izquierdo',
                'lateral_derecho',
                'frontal_con_equipos_de_seguridad',
                'plaqueta_cisterna',
                'foto_valvulas',
                'plaqueta',
                'precintos',
                'stickers_afericion',
                'licencia_conductor_principal',
                'licencia_conductor_reemplazo',
                'vigencia_poder',
                'marca',
                'clase',
                'forma',
                'compartimiento_litros_1',
                'compartimiento_litros_2',
                'compartimiento_galones_1',
                'compartimiento_galones_2',
                'norma_de_fabricacion',
                'numero_de_rompeolas',
                'presion_de_diseno',
                'presion_de_prueba',
                'compartimiento_1',
                'compartimiento_2',
                'largo_1',
                'largo_2',
                'ancho_1',
                'ancho_2',
                'alto_1',
                'alto_2',
                'distancia_entre_ejes_1',
                'distancia_entre_ejes_2',
                'tara',
                'corrosion',
                'valvulas_de_descarga',
                'tapas_externas_con_valvulas_de_admision_o_escotillas',
                'sistemas_de_recuperacion_de_gases_o_vapores',
                'sistema_de_sensor_de_llenado_o_sobrellenado',
                'sistema_de_puesta_a_tierra',
                'sistema_de_carga_por_fondo',
                'fecha_de_fabricacion',
                'numero_de_chasis',
                'numero_de_serie',
                'numero_de_ejes',
                'numero_de_llantas',
                'material',
                'tipo_de_soldadura_a',
                'color_cisterna',
                'tipo_de_soldadura_b',
                'conductor_de_descarga',
                'cabeza',
                'tapas',
                'manto',
                'antivuelque',
                'numero_de_hojas',
            ]);
            
            $this->cistern_id = 0;
        } else {
            // Obtiene la cisterna a actualizar y lo guarda en una variable
            $cistern = SisCistern::find($id);

            // Asigna los valores del modelo a las propiedades del componente
            $this->fecha = $cistern->fecha;
            $this->placa_1 = $cistern->placa_1;
            $this->placa_2 = $cistern->placa_2;
            $this->tracto = $cistern->tracto;
            $this->cisterna = $cistern->cisterna;
            $this->ruat = $cistern->ruat;
            $this->certificado_de_fabricacion_del_tanque = $cistern->certificado_de_fabricacion_del_tanque;
            $this->poliza_de_seguro = $cistern->poliza_de_seguro;
            $this->certificado_hermeticidad = $cistern->certificado_hermeticidad;
            $this->tarjeta_de_cubicacion = $cistern->tarjeta_de_cubicacion;
            $this->nit = $cistern->nit;
            $this->posterior = $cistern->posterior;
            $this->superior = $cistern->superior;
            $this->lateral_izquierdo = $cistern->lateral_izquierdo;
            $this->lateral_derecho = $cistern->lateral_derecho;
            $this->frontal_con_equipos_de_seguridad = $cistern->frontal_con_equipos_de_seguridad;
            $this->plaqueta_cisterna = $cistern->plaqueta_cisterna;
            $this->foto_valvulas = $cistern->foto_valvulas;
            $this->plaqueta = $cistern->plaqueta;
            $this->precintos = $cistern->precintos;
            $this->stickers_afericion = $cistern->stickers_afericion;
            $this->licencia_conductor_principal = $cistern->licencia_conductor_principal;
            $this->licencia_conductor_reemplazo = $cistern->licencia_conductor_reemplazo;
            $this->vigencia_poder = $cistern->vigencia_poder;
            $this->marca = $cistern->marca;
            $this->clase = $cistern->clase;
            $this->forma = $cistern->forma;
            $this->compartimiento_litros_1 = $cistern->compartimiento_litros_1;
            $this->compartimiento_litros_2 = $cistern->compartimiento_litros_2;
            $this->compartimiento_galones_1 = $cistern->compartimiento_galones_1;
            $this->compartimiento_galones_2 = $cistern->compartimiento_galones_2;
            $this->norma_de_fabricacion = $cistern->norma_de_fabricacion;
            $this->numero_de_rompeolas = $cistern->numero_de_rompeolas;
            $this->presion_de_diseno = $cistern->presion_de_diseno;
            $this->presion_de_prueba = $cistern->presion_de_prueba;
            $this->compartimiento_1 = $cistern->compartimiento_1;
            $this->compartimiento_2 = $cistern->compartimiento_2;
            $this->largo_1 = $cistern->largo_1;
            $this->largo_2 = $cistern->largo_2;
            $this->ancho_1 = $cistern->ancho_1;
            $this->ancho_2 = $cistern->ancho_2;
            $this->alto_1 = $cistern->alto_1;
            $this->alto_2 = $cistern->alto_2;
            $this->distancia_entre_ejes_1 = $cistern->distancia_entre_ejes_1;
            $this->distancia_entre_ejes_2 = $cistern->distancia_entre_ejes_2;
            $this->tara = $cistern->tara;
            $this->corrosion = $cistern->corrosion;
            $this->valvulas_de_descarga = $cistern->valvulas_de_descarga;
            $this->tapas_externas_con_valvulas_de_admision_o_escotillas = $cistern->tapas_externas_con_valvulas_de_admision_o_escotillas;
            $this->sistemas_de_recuperacion_de_gases_o_vapores = $cistern->sistemas_de_recuperacion_de_gases_o_vapores;
            $this->sistema_de_sensor_de_llenado_o_sobrellenado = $cistern->sistema_de_sensor_de_llenado_o_sobrellenado;
            $this->sistema_de_puesta_a_tierra = $cistern->sistema_de_puesta_a_tierra;
            $this->sistema_de_carga_por_fondo = $cistern->sistema_de_carga_por_fondo;
            $this->fecha_de_fabricacion = $cistern->fecha_de_fabricacion;
            $this->numero_de_chasis = $cistern->numero_de_chasis;
            $this->numero_de_serie = $cistern->numero_de_serie;
            $this->numero_de_ejes = $cistern->numero_de_ejes;
            $this->numero_de_llantas = $cistern->numero_de_llantas;
            $this->material = $cistern->material;
            $this->tipo_de_soldadura_a = $cistern->tipo_de_soldadura_a;
            $this->color_cisterna = $cistern->color_cisterna;
            $this->tipo_de_soldadura_b = $cistern->tipo_de_soldadura_b;
            $this->conductor_de_descarga = $cistern->conductor_de_descarga;
            $this->cabeza = $cistern->cabeza;
            $this->tapas = $cistern->tapas;
            $this->manto = $cistern->manto;
            $this->antivuelque = $cistern->antivuelque;
            $this->numero_de_hojas = $cistern->numero_de_hojas;

            // Establece el ID de la cisterna
            $this->cistern_id = $id;
        }

        // Abre el modal para crear o actualizar
        $this->emit("show-modal-cistern");
    }


    // Crea una nueva cisterna
    public function create_cistern()
    {
       // Reglas de validación
        $rules = [
            'fecha' => 'required|date',
            'placa_1' => 'required|string|max:255',
            'placa_2' => 'required|string|max:255',
            'tracto' => 'required|string|max:255',
            'cisterna' => 'required|string|max:255',
            'ruat' => 'required|in:ok,corregir,falta',
            'certificado_de_fabricacion_del_tanque' => 'required|in:ok,corregir,falta',
            'poliza_de_seguro' => 'required|in:ok,corregir,falta',
            'certificado_hermeticidad' => 'required|in:ok,corregir,falta',
            'tarjeta_de_cubicacion' => 'required|in:ok,corregir,falta',
            'nit' => 'required|in:ok,corregir,falta',
            'posterior' => 'required|in:ok,corregir,falta',
            'superior' => 'required|in:ok,corregir,falta',
            'lateral_izquierdo' => 'required|in:ok,corregir,falta',
            'lateral_derecho' => 'required|in:ok,corregir,falta',
            'frontal_con_equipos_de_seguridad' => 'required|in:ok,corregir,falta',
            'plaqueta_cisterna' => 'required|in:ok,corregir,falta',
            'foto_valvulas' => 'required|in:ok,corregir,falta',
            'plaqueta' => 'required|in:ok,corregir,falta',
            'precintos' => 'required|in:ok,corregir,falta',
            'stickers_afericion' => 'required|in:ok,corregir,falta',
            'licencia_conductor_principal' => 'required|in:ok,corregir,falta',
            'licencia_conductor_reemplazo' => 'required|in:ok,corregir,falta',
            'vigencia_poder' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'clase' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
            'compartimiento_litros_1' => 'required|integer|min:0',
            'compartimiento_litros_2' => 'required|integer|min:0',
            'compartimiento_galones_1' => 'required|integer|min:0',
            'compartimiento_galones_2' => 'required|integer|min:0',
            'norma_de_fabricacion' => 'required|string|max:255',
            'numero_de_rompeolas' => 'required|integer|min:0',
            'presion_de_diseno' => 'required|numeric|min:0',
            'presion_de_prueba' => 'required|numeric|min:0',
            'compartimiento_1' => 'required|integer|min:0',
            'compartimiento_2' => 'required|integer|min:0',
            'largo_1' => 'required|numeric|min:0',
            'largo_2' => 'required|numeric|min:0',
            'ancho_1' => 'required|numeric|min:0',
            'ancho_2' => 'required|numeric|min:0',
            'alto_1' => 'required|numeric|min:0',
            'alto_2' => 'required|numeric|min:0',
            'distancia_entre_ejes_1' => 'required|numeric|min:0',
            'distancia_entre_ejes_2' => 'required|numeric|min:0',
            'tara' => 'required|numeric|min:0',
            'corrosion' => 'required|numeric|min:0',
            'valvulas_de_descarga' => 'required|integer|min:0',
            'tapas_externas_con_valvulas_de_admision_o_escotillas' => 'required|string|max:255',
            'sistemas_de_recuperacion_de_gases_o_vapores' => 'required|in:si,no',
            'sistema_de_sensor_de_llenado_o_sobrellenado' => 'required|in:si,no',
            'sistema_de_puesta_a_tierra' => 'required|in:si,no',
            'sistema_de_carga_por_fondo' => 'required|in:si,no',
            'fecha_de_fabricacion' => 'required|date',
            'numero_de_chasis' => 'required|string|max:255',
            'numero_de_serie' => 'required|string|max:255',
            'numero_de_ejes' => 'required|integer|min:0',
            'numero_de_llantas' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'tipo_de_soldadura_a' => 'required|string|max:255',
            'color_cisterna' => 'required|string|max:255',
            'tipo_de_soldadura_b' => 'required|string|max:255',
            'conductor_de_descarga' => 'required|string|max:255',
            'cabeza' => 'required|numeric|min:0',
            'tapas' => 'required|numeric|min:0',
            'manto' => 'required|numeric|min:0',
            'antivuelque' => 'required|numeric|min:0',
            'numero_de_hojas' => 'required|integer|min:0',
        ];

        // Mensajes de validación
        $messages = [
            'fecha.required' => 'La fecha es requerida',
            'fecha.date' => 'La fecha debe ser una fecha válida',
            'placa_1.required' => 'La placa 1 es requerida',
            'placa_1.string' => 'La placa 1 debe ser un texto',
            'placa_1.max' => 'La placa 1 no debe exceder los 255 caracteres',
            'placa_2.required' => 'La placa 2 es requerida',
            'placa_2.string' => 'La placa 2 debe ser un texto',
            'placa_2.max' => 'La placa 2 no debe exceder los 255 caracteres',
            'tracto.required' => 'El tracto es requerido',
            'tracto.string' => 'El tracto debe ser un texto',
            'tracto.max' => 'El tracto no debe exceder los 255 caracteres',
            'cisterna.required' => 'El cisterna es requerido',
            'cisterna.string' => 'El cisterna debe ser un texto',
            'cisterna.max' => 'El cisterna no debe exceder los 255 caracteres',
            'ruat.required' => 'El RUAT es requerido',
            'ruat.in' => 'El RUAT debe ser uno de los siguientes valores: ok, corregir, falta',
            'certificado_de_fabricacion_del_tanque.required' => 'El certificado de fabricación del tanque es requerido',
            'certificado_de_fabricacion_del_tanque.in' => 'El certificado de fabricación del tanque debe ser uno de los siguientes valores: ok, corregir, falta',
            'poliza_de_seguro.required' => 'La póliza de seguro es requerida',
            'poliza_de_seguro.in' => 'La póliza de seguro debe ser uno de los siguientes valores: ok, corregir, falta',
            'certificado_hermeticidad.required' => 'El certificado de hermeticidad es requerido',
            'certificado_hermeticidad.in' => 'El certificado de hermeticidad debe ser uno de los siguientes valores: ok, corregir, falta',
            'tarjeta_de_cubicacion.required' => 'La tarjeta de cubicación es requerida',
            'tarjeta_de_cubicacion.in' => 'La tarjeta de cubicación debe ser uno de los siguientes valores: ok, corregir, falta',
            'nit.required' => 'El NIT es requerido',
            'nit.in' => 'El NIT debe ser uno de los siguientes valores: ok, corregir, falta',
            'posterior.required' => 'La fotografía posterior es requerida',
            'posterior.in' => 'La fotografía posterior debe ser uno de los siguientes valores: ok, corregir, falta',
            'superior.required' => 'La fotografía superior es requerida',
            'superior.in' => 'La fotografía superior debe ser uno de los siguientes valores: ok, corregir, falta',
            'lateral_izquierdo.required' => 'La fotografía lateral izquierdo es requerida',
            'lateral_izquierdo.in' => 'La fotografía lateral izquierdo debe ser uno de los siguientes valores: ok, corregir, falta',
            'lateral_derecho.required' => 'La fotografía lateral derecho es requerida',
            'lateral_derecho.in' => 'La fotografía lateral derecho debe ser uno de los siguientes valores: ok, corregir, falta',
            'frontal_con_equipos_de_seguridad.required' => 'La fotografía frontal con equipos de seguridad es requerida',
            'frontal_con_equipos_de_seguridad.in' => 'La fotografía frontal con equipos de seguridad debe ser uno de los siguientes valores: ok, corregir, falta',
            'plaqueta_cisterna.required' => 'La plaqueta del cisterna es requerida',
            'plaqueta_cisterna.in' => 'La plaqueta del cisterna debe ser uno de los siguientes valores: ok, corregir, falta',
            'foto_valvulas.required' => 'La foto de las válvulas es requerida',
            'foto_valvulas.in' => 'La foto de las válvulas debe ser uno de los siguientes valores: ok, corregir, falta',
            'plaqueta.required' => 'La plaqueta es requerida',
            'plaqueta.in' => 'La plaqueta debe ser uno de los siguientes valores: ok, corregir, falta',
            'precintos.required' => 'Los precintos son requeridos',
            'precintos.in' => 'Los precintos deben ser uno de los siguientes valores: ok, corregir, falta',
            'stickers_afericion.required' => 'Los stickers de aferición son requeridos',
            'stickers_afericion.in' => 'Los stickers de aferición deben ser uno de los siguientes valores: ok, corregir, falta',
            'licencia_conductor_principal.required' => 'La licencia del conductor principal es requerida',
            'licencia_conductor_principal.in' => 'La licencia del conductor principal debe ser uno de los siguientes valores: ok, corregir, falta',
            'licencia_conductor_reemplazo.required' => 'La licencia del conductor de reemplazo es requerida',
            'licencia_conductor_reemplazo.in' => 'La licencia del conductor de reemplazo debe ser uno de los siguientes valores: ok, corregir, falta',
            'vigencia_poder.required' => 'La vigencia del poder es requerida',
            'vigencia_poder.string' => 'La vigencia del poder debe ser un texto',
            'vigencia_poder.max' => 'La vigencia del poder no debe exceder los 255 caracteres',
            'marca.required' => 'La marca es requerida',
            'marca.string' => 'La marca debe ser un texto',
            'marca.max' => 'La marca no debe exceder los 255 caracteres',
            'clase.required' => 'La clase es requerida',
            'clase.string' => 'La clase debe ser un texto',
            'clase.max' => 'La clase no debe exceder los 255 caracteres',
            'forma.required' => 'La forma es requerida',
            'forma.string' => 'La forma debe ser un texto',
            'forma.max' => 'La forma no debe exceder los 255 caracteres',
            'compartimiento_litros_1.required' => 'El compartimiento litros 1 es requerido',
            'compartimiento_litros_1.integer' => 'El compartimiento litros 1 debe ser un número entero',
            'compartimiento_litros_1.min' => 'El compartimiento litros 1 debe ser al menos 0',
            'compartimiento_litros_2.required' => 'El compartimiento litros 2 es requerido',
            'compartimiento_litros_2.integer' => 'El compartimiento litros 2 debe ser un número entero',
            'compartimiento_litros_2.min' => 'El compartimiento litros 2 debe ser al menos 0',
            'compartimiento_galones_1.required' => 'El compartimiento galones 1 es requerido',
            'compartimiento_galones_1.integer' => 'El compartimiento galones 1 debe ser un número entero',
            'compartimiento_galones_1.min' => 'El compartimiento galones 1 debe ser al menos 0',
            'compartimiento_galones_2.required' => 'El compartimiento galones 2 es requerido',
            'compartimiento_galones_2.integer' => 'El compartimiento galones 2 debe ser un número entero',
            'compartimiento_galones_2.min' => 'El compartimiento galones 2 debe ser al menos 0',
            'norma_de_fabricacion.required' => 'La norma de fabricación es requerida',
            'norma_de_fabricacion.string' => 'La norma de fabricación debe ser un texto',
            'norma_de_fabricacion.max' => 'La norma de fabricación no debe exceder los 255 caracteres',
            'numero_de_rompeolas.required' => 'El número de rompeolas es requerido',
            'numero_de_rompeolas.integer' => 'El número de rompeolas debe ser un número entero',
            'numero_de_rompeolas.min' => 'El número de rompeolas debe ser al menos 0',
            'presion_de_diseno.required' => 'La presión de diseño es requerida',
            'presion_de_diseno.numeric' => 'La presión de diseño debe ser un número',
            'presion_de_diseno.min' => 'La presión de diseño debe ser al menos 0',
            'presion_de_prueba.required' => 'La presión de prueba es requerida',
            'presion_de_prueba.numeric' => 'La presión de prueba debe ser un número',
            'presion_de_prueba.min' => 'La presión de prueba debe ser al menos 0',
            'compartimiento_1.required' => 'El compartimiento 1 es requerido',
            'compartimiento_1.integer' => 'El compartimiento 1 debe ser un número entero',
            'compartimiento_1.min' => 'El compartimiento 1 debe ser al menos 0',
            'compartimiento_2.required' => 'El compartimiento 2 es requerido',
            'compartimiento_2.integer' => 'El compartimiento 2 debe ser un número entero',
            'compartimiento_2.min' => 'El compartimiento 2 debe ser al menos 0',
            'largo_1.required' => 'El largo 1 es requerido',
            'largo_1.numeric' => 'El largo 1 debe ser un número',
            'largo_1.min' => 'El largo 1 debe ser al menos 0',
            'largo_2.required' => 'El largo 2 es requerido',
            'largo_2.numeric' => 'El largo 2 debe ser un número',
            'largo_2.min' => 'El largo 2 debe ser al menos 0',
            'ancho_1.required' => 'El ancho 1 es requerido',
            'ancho_1.numeric' => 'El ancho 1 debe ser un número',
            'ancho_1.min' => 'El ancho 1 debe ser al menos 0',
            'ancho_2.required' => 'El ancho 2 es requerido',
            'ancho_2.numeric' => 'El ancho 2 debe ser un número',
            'ancho_2.min' => 'El ancho 2 debe ser al menos 0',
            'alto_1.required' => 'El alto 1 es requerido',
            'alto_1.numeric' => 'El alto 1 debe ser un número',
            'alto_1.min' => 'El alto 1 debe ser al menos 0',
            'alto_2.required' => 'El alto 2 es requerido',
            'alto_2.numeric' => 'El alto 2 debe ser un número',
            'alto_2.min' => 'El alto 2 debe ser al menos 0',
            'distancia_entre_ejes_1.required' => 'La distancia entre ejes 1 es requerida',
            'distancia_entre_ejes_1.numeric' => 'La distancia entre ejes 1 debe ser un número',
            'distancia_entre_ejes_1.min' => 'La distancia entre ejes 1 debe ser al menos 0',
            'distancia_entre_ejes_2.required' => 'La distancia entre ejes 2 es requerida',
            'distancia_entre_ejes_2.numeric' => 'La distancia entre ejes 2 debe ser un número',
            'distancia_entre_ejes_2.min' => 'La distancia entre ejes 2 debe ser al menos 0',
            'tara.required' => 'La tara es requerida',
            'tara.numeric' => 'La tara debe ser un número',
            'tara.min' => 'La tara debe ser al menos 0',
            'corrosion.required' => 'La corrosión es requerida',
            'corrosion.numeric' => 'La corrosión debe ser un número',
            'corrosion.min' => 'La corrosión debe ser al menos 0',
            'valvulas_de_descarga.required' => 'Las válvulas de descarga son requeridas',
            'valvulas_de_descarga.integer' => 'Las válvulas de descarga deben ser un número entero',
            'valvulas_de_descarga.min' => 'Las válvulas de descarga deben ser al menos 0',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.required' => 'Las tapas externas con válvulas de admisión o escotillas son requeridas',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.string' => 'Las tapas externas con válvulas de admisión o escotillas deben ser un texto',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.max' => 'Las tapas externas con válvulas de admisión o escotillas no deben exceder los 255 caracteres',
            'sistemas_de_recuperacion_de_gases_o_vapores.required' => 'El sistema de recuperación de gases o vapores es requerido',
            'sistemas_de_recuperacion_de_gases_o_vapores.in' => 'El sistema de recuperación de gases o vapores debe ser uno de los siguientes valores: si, no',
            'sistema_de_sensor_de_llenado_o_sobrellenado.required' => 'El sistema de sensor de llenado o sobrellenado es requerido',
            'sistema_de_sensor_de_llenado_o_sobrellenado.in' => 'El sistema de sensor de llenado o sobrellenado debe ser uno de los siguientes valores: si, no',
            'sistema_de_puesta_a_tierra.required' => 'El sistema de puesta a tierra es requerido',
            'sistema_de_puesta_a_tierra.in' => 'El sistema de puesta a tierra debe ser uno de los siguientes valores: si, no',
            'sistema_de_carga_por_fondo.required' => 'El sistema de carga por fondo es requerido',
            'sistema_de_carga_por_fondo.in' => 'El sistema de carga por fondo debe ser uno de los siguientes valores: si, no',
            'fecha_de_fabricacion.required' => 'La fecha de fabricación es requerida',
            'fecha_de_fabricacion.date' => 'La fecha de fabricación debe ser una fecha válida',
            'numero_de_chasis.required' => 'El número de chasis es requerido',
            'numero_de_chasis.string' => 'El número de chasis debe ser un texto',
            'numero_de_chasis.max' => 'El número de chasis no debe exceder los 255 caracteres',
            'numero_de_serie.required' => 'El número de serie es requerido',
            'numero_de_serie.string' => 'El número de serie debe ser un texto',
            'numero_de_serie.max' => 'El número de serie no debe exceder los 255 caracteres',
            'numero_de_ejes.required' => 'El número de ejes es requerido',
            'numero_de_ejes.integer' => 'El número de ejes debe ser un número entero',
            'numero_de_ejes.min' => 'El número de ejes debe ser al menos 0',
            'numero_de_llantas.required' => 'El número de llantas es requerido',
            'numero_de_llantas.integer' => 'El número de llantas debe ser un número entero',
            'numero_de_llantas.min' => 'El número de llantas debe ser al menos 0',
            'material.required' => 'El material es requerido',
            'material.string' => 'El material debe ser un texto',
            'material.max' => 'El material no debe exceder los 255 caracteres',
            'tipo_de_soldadura_a.required' => 'El tipo de soldadura A es requerido',
            'tipo_de_soldadura_a.string' => 'El tipo de soldadura A debe ser un texto',
            'tipo_de_soldadura_a.max' => 'El tipo de soldadura A no debe exceder los 255 caracteres',
            'color_cisterna.required' => 'El color de la cisterna es requerido',
            'color_cisterna.string' => 'El color de la cisterna debe ser un texto',
            'color_cisterna.max' => 'El color de la cisterna no debe exceder los 255 caracteres',
            'tipo_de_soldadura_b.required' => 'El tipo de soldadura B es requerido',
            'tipo_de_soldadura_b.string' => 'El tipo de soldadura B debe ser un texto',
            'tipo_de_soldadura_b.max' => 'El tipo de soldadura B no debe exceder los 255 caracteres',
            'conductor_de_descarga.required' => 'El conductor de descarga es requerido',
            'conductor_de_descarga.string' => 'El conductor de descarga debe ser un texto',
            'conductor_de_descarga.max' => 'El conductor de descarga no debe exceder los 255 caracteres',
            'cabeza.required' => 'La cabeza es requerida',
            'cabeza.numeric' => 'La cabeza debe ser un número',
            'cabeza.min' => 'La cabeza debe ser al menos 0',
            'tapas.required' => 'Las tapas son requeridas',
            'tapas.numeric' => 'Las tapas deben ser un número',
            'tapas.min' => 'Las tapas deben ser al menos 0',
            'manto.required' => 'El manto es requerido',
            'manto.numeric' => 'El manto debe ser un número',
            'manto.min' => 'El manto debe ser al menos 0',
            'antivuelque.required' => 'El antivuelque es requerido',
            'antivuelque.numeric' => 'El antivuelque debe ser un número',
            'antivuelque.min' => 'El antivuelque debe ser al menos 0',
            'numero_de_hojas.required' => 'El número de hojas es requerido',
            'numero_de_hojas.integer' => 'El número de hojas debe ser un número entero',
            'numero_de_hojas.min' => 'El número de hojas debe ser al menos 0',
        ];

        $this->validate($rules, $messages); 
        

        // Crea una nueva cisterna y guarda el objeto creado en una variable
        $cistern = SisCistern::create([
            // CHECK ALVAMA (Excel)
            'fecha' => $this->fecha,
            'placa_1' => $this->placa_1,
            'placa_2' => $this->placa_2,

            // Tarjeta de Operaciones
            'tracto' => $this->tracto,
            'cisterna' => $this->cisterna,

            // Documentos
            'ruat' => $this->ruat,
            'certificado_de_fabricacion_del_tanque' => $this->certificado_de_fabricacion_del_tanque,
            'poliza_de_seguro' => $this->poliza_de_seguro,
            'certificado_hermeticidad' => $this->certificado_hermeticidad,
            'tarjeta_de_cubicacion' => $this->tarjeta_de_cubicacion,
            'nit' => $this->nit,

            // Fotografias del Cisterna
            'posterior' => $this->posterior,
            'superior' => $this->superior,
            'lateral_izquierdo' => $this->lateral_izquierdo,
            'lateral_derecho' => $this->lateral_derecho,
            'frontal_con_equipos_de_seguridad' => $this->frontal_con_equipos_de_seguridad,
            'plaqueta_cisterna' => $this->plaqueta_cisterna,
            'foto_valvulas' => $this->foto_valvulas,

            // Cubicadora
            'plaqueta' => $this->plaqueta,
            'precintos' => $this->precintos,
            'stickers_afericion' => $this->stickers_afericion,

            // Licencia y Listado Conductores
            'licencia_conductor_principal' => $this->licencia_conductor_principal,
            'licencia_conductor_reemplazo' => $this->licencia_conductor_reemplazo,

            // RR PP
            'vigencia_poder' => $this->vigencia_poder,

            // DATOS DEL SEMIREMOLQUE
            'marca' => $this->marca,
            'clase' => $this->clase,
            'forma' => $this->forma,
            'compartimiento_litros_1' => $this->compartimiento_litros_1,
            'compartimiento_litros_2' => $this->compartimiento_litros_2,
            'compartimiento_galones_1' => $this->compartimiento_galones_1,
            'compartimiento_galones_2' => $this->compartimiento_galones_2,
            'norma_de_fabricacion' => $this->norma_de_fabricacion,
            'numero_de_rompeolas' => $this->numero_de_rompeolas,
            'presion_de_diseno' => $this->presion_de_diseno,
            'presion_de_prueba' => $this->presion_de_prueba,
            'compartimiento_1' => $this->compartimiento_1,
            'compartimiento_2' => $this->compartimiento_2,
            'largo_1' => $this->largo_1,
            'largo_2' => $this->largo_2,
            'ancho_1' => $this->ancho_1,
            'ancho_2' => $this->ancho_2,
            'alto_1' => $this->alto_1,
            'alto_2' => $this->alto_2,
            'distancia_entre_ejes_1' => $this->distancia_entre_ejes_1,
            'distancia_entre_ejes_2' => $this->distancia_entre_ejes_2,
            'tara' => $this->tara,
            'corrosion' => $this->corrosion,
            'valvulas_de_descarga' => $this->valvulas_de_descarga,
            'tapas_externas_con_valvulas_de_admision_o_escotillas' => $this->tapas_externas_con_valvulas_de_admision_o_escotillas,
            'sistemas_de_recuperacion_de_gases_o_vapores' => $this->sistemas_de_recuperacion_de_gases_o_vapores,
            'sistema_de_sensor_de_llenado_o_sobrellenado' => $this->sistema_de_sensor_de_llenado_o_sobrellenado,
            'sistema_de_puesta_a_tierra' => $this->sistema_de_puesta_a_tierra,
            'sistema_de_carga_por_fondo' => $this->sistema_de_carga_por_fondo,

            // DATOS DEL CHASIS
            'fecha_de_fabricacion' => $this->fecha_de_fabricacion,
            'numero_de_chasis' => $this->numero_de_chasis,
            'numero_de_serie' => $this->numero_de_serie,
            'numero_de_ejes' => $this->numero_de_ejes,
            'numero_de_llantas' => $this->numero_de_llantas,
            'material' => $this->material,
            'tipo_de_soldadura_a' => $this->tipo_de_soldadura_a,
            'color_cisterna' => $this->color_cisterna,
            'tipo_de_soldadura_b' => $this->tipo_de_soldadura_b,
            'conductor_de_descarga' => $this->conductor_de_descarga,
            'cabeza' => $this->cabeza,
            'tapas' => $this->tapas,
            'manto' => $this->manto,
            'antivuelque' => $this->antivuelque,
            'numero_de_hojas' => $this->numero_de_hojas,
        ]);



        // Reset the input fields after saving
        $this->reset([
            'fecha',
            'placa_1',
            'placa_2',
            'tracto',
            'cisterna',
            'ruat',
            'certificado_de_fabricacion_del_tanque',
            'poliza_de_seguro',
            'certificado_hermeticidad',
            'tarjeta_de_cubicacion',
            'nit',
            'posterior',
            'superior',
            'lateral_izquierdo',
            'lateral_derecho',
            'frontal_con_equipos_de_seguridad',
            'plaqueta_cisterna',
            'foto_valvulas',
            'plaqueta',
            'precintos',
            'stickers_afericion',
            'licencia_conductor_principal',
            'licencia_conductor_reemplazo',
            'vigencia_poder',
            'marca',
            'clase',
            'forma',
            'compartimiento_litros_1',
            'compartimiento_litros_2',
            'compartimiento_galones_1',
            'compartimiento_galones_2',
            'norma_de_fabricacion',
            'numero_de_rompeolas',
            'presion_de_diseno',
            'presion_de_prueba',
            'compartimiento_1',
            'compartimiento_2',
            'largo_1',
            'largo_2',
            'ancho_1',
            'ancho_2',
            'alto_1',
            'alto_2',
            'distancia_entre_ejes_1',
            'distancia_entre_ejes_2',
            'tara',
            'corrosion',
            'valvulas_de_descarga',
            'tapas_externas_con_valvulas_de_admision_o_escotillas',
            'sistemas_de_recuperacion_de_gases_o_vapores',
            'sistema_de_sensor_de_llenado_o_sobrellenado',
            'sistema_de_puesta_a_tierra',
            'sistema_de_carga_por_fondo',
            'fecha_de_fabricacion',
            'numero_de_chasis',
            'numero_de_serie',
            'numero_de_ejes',
            'numero_de_llantas',
            'material',
            'tipo_de_soldadura_a',
            'color_cisterna',
            'tipo_de_soldadura_b',
            'conductor_de_descarga',
            'cabeza',
            'tapas',
            'manto',
            'antivuelque',
            'numero_de_hojas',
        ]);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Cisterna '" . $cistern->placa . "' creada exitosamente";
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-cistern");
    }



    // Actualiza una cisterna
    public function update_cistern()
    {
        // Reglas de validación
        $rules = [
            'fecha' => 'required|date',
            'placa_1' => 'required|string|max:255',
            'placa_2' => 'nullable|string|max:255',
            'tracto' => 'required|string|max:255',
            'cisterna' => 'required|string|max:255',
            'ruat' => 'required|in:ok,corregir,falta',
            'certificado_de_fabricacion_del_tanque' => 'required|in:ok,corregir,falta',
            'poliza_de_seguro' => 'required|in:ok,corregir,falta',
            'certificado_hermeticidad' => 'required|in:ok,corregir,falta',
            'tarjeta_de_cubicacion' => 'required|in:ok,corregir,falta',
            'nit' => 'required|in:ok,corregir,falta',
            'posterior' => 'required|in:ok,corregir,falta',
            'superior' => 'required|in:ok,corregir,falta',
            'lateral_izquierdo' => 'required|in:ok,corregir,falta',
            'lateral_derecho' => 'required|in:ok,corregir,falta',
            'frontal_con_equipos_de_seguridad' => 'required|in:ok,corregir,falta',
            'plaqueta_cisterna' => 'required|in:ok,corregir,falta',
            'foto_valvulas' => 'required|in:ok,corregir,falta',
            'plaqueta' => 'required|in:ok,corregir,falta',
            'precintos' => 'required|in:ok,corregir,falta',
            'stickers_afericion' => 'required|in:ok,corregir,falta',
            'licencia_conductor_principal' => 'required|in:ok,corregir,falta',
            'licencia_conductor_reemplazo' => 'required|in:ok,corregir,falta',
            'vigencia_poder' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'clase' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
            'compartimiento_litros_1' => 'required|integer|min:0',
            'compartimiento_litros_2' => 'required|integer|min:0',
            'compartimiento_galones_1' => 'required|integer|min:0',
            'compartimiento_galones_2' => 'required|integer|min:0',
            'norma_de_fabricacion' => 'required|string|max:255',
            'numero_de_rompeolas' => 'required|integer|min:0',
            'presion_de_diseno' => 'required|numeric|min:0',
            'presion_de_prueba' => 'required|numeric|min:0',
            'compartimiento_1' => 'required|integer|min:0',
            'compartimiento_2' => 'required|integer|min:0',
            'largo_1' => 'required|numeric|min:0',
            'largo_2' => 'required|numeric|min:0',
            'ancho_1' => 'required|numeric|min:0',
            'ancho_2' => 'required|numeric|min:0',
            'alto_1' => 'required|numeric|min:0',
            'alto_2' => 'required|numeric|min:0',
            'distancia_entre_ejes_1' => 'required|numeric|min:0',
            'distancia_entre_ejes_2' => 'required|numeric|min:0',
            'tara' => 'required|numeric|min:0',
            'corrosion' => 'required|numeric|min:0',
            'valvulas_de_descarga' => 'required|integer|min:0',
            'tapas_externas_con_valvulas_de_admision_o_escotillas' => 'required|string|max:255',
            'sistemas_de_recuperacion_de_gases_o_vapores' => 'required|in:si,no',
            'sistema_de_sensor_de_llenado_o_sobrellenado' => 'required|in:si,no',
            'sistema_de_puesta_a_tierra' => 'required|in:si,no',
            'sistema_de_carga_por_fondo' => 'required|in:si,no',
            'fecha_de_fabricacion' => 'required|date',
            'numero_de_chasis' => 'required|string|max:255',
            'numero_de_serie' => 'required|string|max:255',
            'numero_de_ejes' => 'required|integer|min:0',
            'numero_de_llantas' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'tipo_de_soldadura_a' => 'required|string|max:255',
            'color_cisterna' => 'required|string|max:255',
            'tipo_de_soldadura_b' => 'required|string|max:255',
            'conductor_de_descarga' => 'required|string|max:255',
            'cabeza' => 'required|numeric|min:0',
            'tapas' => 'required|numeric|min:0',
            'manto' => 'required|numeric|min:0',
            'antivuelque' => 'required|numeric|min:0',
            'numero_de_hojas' => 'required|integer|min:0',
        ];  

        // Mensajes de validación
        $messages = [
            'fecha.required' => 'La fecha es requerida',
            'fecha.date' => 'La fecha debe ser una fecha válida',
            'placa_1.required' => 'La placa 1 es requerida',
            'placa_1.string' => 'La placa 1 debe ser una cadena de texto',
            'placa_1.max' => 'La placa 1 no puede tener más de 255 caracteres',
            'placa_2.string' => 'La placa 2 debe ser una cadena de texto',
            'placa_2.max' => 'La placa 2 no puede tener más de 255 caracteres',
            'tracto.required' => 'El tracto es requerido',
            'tracto.string' => 'El tracto debe ser una cadena de texto',
            'tracto.max' => 'El tracto no puede tener más de 255 caracteres',
            'cisterna.required' => 'El campo Cisterna es requerido',
            'cisterna.string' => 'El campo Cisterna debe ser una cadena de texto',
            'cisterna.max' => 'El campo Cisterna no puede tener más de 255 caracteres',
            'ruat.required' => 'El estado de RUAT es requerido',
            'ruat.in' => 'El estado de RUAT debe ser uno de los siguientes: ok, corregir, falta',
            'certificado_de_fabricacion_del_tanque.required' => 'El estado del certificado de fabricación del tanque es requerido',
            'certificado_de_fabricacion_del_tanque.in' => 'El estado del certificado de fabricación del tanque debe ser uno de los siguientes: ok, corregir, falta',
            'poliza_de_seguro.required' => 'El estado de la póliza de seguro es requerido',
            'poliza_de_seguro.in' => 'El estado de la póliza de seguro debe ser uno de los siguientes: ok, corregir, falta',
            'certificado_hermeticidad.required' => 'El estado del certificado de hermeticidad es requerido',
            'certificado_hermeticidad.in' => 'El estado del certificado de hermeticidad debe ser uno de los siguientes: ok, corregir, falta',
            'tarjeta_de_cubicacion.required' => 'El estado de la tarjeta de cubicación es requerido',
            'tarjeta_de_cubicacion.in' => 'El estado de la tarjeta de cubicación debe ser uno de los siguientes: ok, corregir, falta',
            'nit.required' => 'El estado del NIT es requerido',
            'nit.in' => 'El estado del NIT debe ser uno de los siguientes: ok, corregir, falta',
            'posterior.required' => 'La fotografía posterior es requerida',
            'posterior.in' => 'El estado de la fotografía posterior debe ser uno de los siguientes: ok, corregir, falta',
            'superior.required' => 'La fotografía superior es requerida',
            'superior.in' => 'El estado de la fotografía superior debe ser uno de los siguientes: ok, corregir, falta',
            'lateral_izquierdo.required' => 'La fotografía lateral izquierdo es requerida',
            'lateral_izquierdo.in' => 'El estado de la fotografía lateral izquierdo debe ser uno de los siguientes: ok, corregir, falta',
            'lateral_derecho.required' => 'La fotografía lateral derecho es requerida',
            'lateral_derecho.in' => 'El estado de la fotografía lateral derecho debe ser uno de los siguientes: ok, corregir, falta',
            'frontal_con_equipos_de_seguridad.required' => 'La fotografía frontal con equipos de seguridad es requerida',
            'frontal_con_equipos_de_seguridad.in' => 'El estado de la fotografía frontal con equipos de seguridad debe ser uno de los siguientes: ok, corregir, falta',
            'plaqueta_cisterna.required' => 'La fotografía de la plaqueta del cisterna es requerida',
            'plaqueta_cisterna.in' => 'El estado de la fotografía de la plaqueta del cisterna debe ser uno de los siguientes: ok, corregir, falta',
            'foto_valvulas.required' => 'La fotografía de las válvulas es requerida',
            'foto_valvulas.in' => 'El estado de la fotografía de las válvulas debe ser uno de los siguientes: ok, corregir, falta',
            'plaqueta.required' => 'El estado de la plaqueta es requerido',
            'plaqueta.in' => 'El estado de la plaqueta debe ser uno de los siguientes: ok, corregir, falta',
            'precintos.required' => 'El estado de los precintos es requerido',
            'precintos.in' => 'El estado de los precintos debe ser uno de los siguientes: ok, corregir, falta',
            'stickers_afericion.required' => 'El estado de los stickers de aferición es requerido',
            'stickers_afericion.in' => 'El estado de los stickers de aferición debe ser uno de los siguientes: ok, corregir, falta',
            'licencia_conductor_principal.required' => 'El estado de la licencia del conductor principal es requerido',
            'licencia_conductor_principal.in' => 'El estado de la licencia del conductor principal debe ser uno de los siguientes: ok, corregir, falta',
            'licencia_conductor_reemplazo.required' => 'El estado de la licencia del conductor de reemplazo es requerido',
            'licencia_conductor_reemplazo.in' => 'El estado de la licencia del conductor de reemplazo debe ser uno de los siguientes: ok, corregir, falta',
            'vigencia_poder.required' => 'La vigencia del poder es requerida',
            'vigencia_poder.string' => 'La vigencia del poder debe ser una cadena de texto',
            'vigencia_poder.max' => 'La vigencia del poder no puede tener más de 255 caracteres',
            'marca.required' => 'La marca es requerida',
            'marca.string' => 'La marca debe ser una cadena de texto',
            'marca.max' => 'La marca no puede tener más de 255 caracteres',
            'clase.required' => 'La clase es requerida',
            'clase.string' => 'La clase debe ser una cadena de texto',
            'clase.max' => 'La clase no puede tener más de 255 caracteres',
            'forma.required' => 'La forma es requerida',
            'forma.string' => 'La forma debe ser una cadena de texto',
            'forma.max' => 'La forma no puede tener más de 255 caracteres',
            'compartimiento_litros_1.required' => 'El compartimiento de litros 1 es requerido',
            'compartimiento_litros_1.integer' => 'El compartimiento de litros 1 debe ser un número entero',
            'compartimiento_litros_1.min' => 'El compartimiento de litros 1 debe ser al menos 0',
            'compartimiento_litros_2.required' => 'El compartimiento de litros 2 es requerido',
            'compartimiento_litros_2.integer' => 'El compartimiento de litros 2 debe ser un número entero',
            'compartimiento_litros_2.min' => 'El compartimiento de litros 2 debe ser al menos 0',
            'compartimiento_galones_1.required' => 'El compartimiento de galones 1 es requerido',
            'compartimiento_galones_1.integer' => 'El compartimiento de galones 1 debe ser un número entero',
            'compartimiento_galones_1.min' => 'El compartimiento de galones 1 debe ser al menos 0',
            'compartimiento_galones_2.required' => 'El compartimiento de galones 2 es requerido',
            'compartimiento_galones_2.integer' => 'El compartimiento de galones 2 debe ser un número entero',
            'compartimiento_galones_2.min' => 'El compartimiento de galones 2 debe ser al menos 0',
            'norma_de_fabricacion.required' => 'La norma de fabricación es requerida',
            'norma_de_fabricacion.string' => 'La norma de fabricación debe ser una cadena de texto',
            'norma_de_fabricacion.max' => 'La norma de fabricación no puede tener más de 255 caracteres',
            'numero_de_rompeolas.required' => 'El número de rompeolas es requerido',
            'numero_de_rompeolas.integer' => 'El número de rompeolas debe ser un número entero',
            'numero_de_rompeolas.min' => 'El número de rompeolas debe ser al menos 0',
            'presion_de_diseno.required' => 'La presión de diseño es requerida',
            'presion_de_diseno.numeric' => 'La presión de diseño debe ser un número',
            'presion_de_diseno.min' => 'La presión de diseño debe ser al menos 0',
            'presion_de_prueba.required' => 'La presión de prueba es requerida',
            'presion_de_prueba.numeric' => 'La presión de prueba debe ser un número',
            'presion_de_prueba.min' => 'La presión de prueba debe ser al menos 0',
            'compartimiento_1.required' => 'El compartimiento 1 es requerido',
            'compartimiento_1.integer' => 'El compartimiento 1 debe ser un número entero',
            'compartimiento_1.min' => 'El compartimiento 1 debe ser al menos 0',
            'compartimiento_2.required' => 'El compartimiento 2 es requerido',
            'compartimiento_2.integer' => 'El compartimiento 2 debe ser un número entero',
            'compartimiento_2.min' => 'El compartimiento 2 debe ser al menos 0',
            'largo_1.required' => 'El largo 1 es requerido',
            'largo_1.numeric' => 'El largo 1 debe ser un número',
            'largo_1.min' => 'El largo 1 debe ser al menos 0',
            'largo_2.required' => 'El largo 2 es requerido',
            'largo_2.numeric' => 'El largo 2 debe ser un número',
            'largo_2.min' => 'El largo 2 debe ser al menos 0',
            'ancho_1.required' => 'El ancho 1 es requerido',
            'ancho_1.numeric' => 'El ancho 1 debe ser un número',
            'ancho_1.min' => 'El ancho 1 debe ser al menos 0',
            'ancho_2.required' => 'El ancho 2 es requerido',
            'ancho_2.numeric' => 'El ancho 2 debe ser un número',
            'ancho_2.min' => 'El ancho 2 debe ser al menos 0',
            'alto_1.required' => 'El alto 1 es requerido',
            'alto_1.numeric' => 'El alto 1 debe ser un número',
            'alto_1.min' => 'El alto 1 debe ser al menos 0',
            'alto_2.required' => 'El alto 2 es requerido',
            'alto_2.numeric' => 'El alto 2 debe ser un número',
            'alto_2.min' => 'El alto 2 debe ser al menos 0',
            'distancia_entre_ejes_1.required' => 'La distancia entre ejes 1 es requerida',
            'distancia_entre_ejes_1.numeric' => 'La distancia entre ejes 1 debe ser un número',
            'distancia_entre_ejes_1.min' => 'La distancia entre ejes 1 debe ser al menos 0',
            'distancia_entre_ejes_2.required' => 'La distancia entre ejes 2 es requerida',
            'distancia_entre_ejes_2.numeric' => 'La distancia entre ejes 2 debe ser un número',
            'distancia_entre_ejes_2.min' => 'La distancia entre ejes 2 debe ser al menos 0',
            'tara.required' => 'La tara es requerida',
            'tara.numeric' => 'La tara debe ser un número',
            'tara.min' => 'La tara debe ser al menos 0',
            'corrosion.required' => 'La corrosión es requerida',
            'corrosion.numeric' => 'La corrosión debe ser un número',
            'corrosion.min' => 'La corrosión debe ser al menos 0',
            'valvulas_de_descarga.required' => 'El número de válvulas de descarga es requerido',
            'valvulas_de_descarga.integer' => 'El número de válvulas de descarga debe ser un número entero',
            'valvulas_de_descarga.min' => 'El número de válvulas de descarga debe ser al menos 0',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.required' => 'El estado de las tapas externas con válvulas de admisión o escotillas es requerido',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.string' => 'El estado de las tapas externas con válvulas de admisión o escotillas debe ser una cadena de texto',
            'tapas_externas_con_valvulas_de_admision_o_escotillas.max' => 'El estado de las tapas externas con válvulas de admisión o escotillas no puede tener más de 255 caracteres',
            'sistemas_de_recuperacion_de_gases_o_vapores.required' => 'El estado del sistema de recuperación de gases o vapores es requerido',
            'sistemas_de_recuperacion_de_gases_o_vapores.in' => 'El estado del sistema de recuperación de gases o vapores debe ser "si" o "no"',
            'sistema_de_sensor_de_llenado_o_sobrellenado.required' => 'El estado del sistema de sensor de llenado o sobrellenado es requerido',
            'sistema_de_sensor_de_llenado_o_sobrellenado.in' => 'El estado del sistema de sensor de llenado o sobrellenado debe ser "si" o "no"',
            'sistema_de_puesta_a_tierra.required' => 'El estado del sistema de puesta a tierra es requerido',
            'sistema_de_puesta_a_tierra.in' => 'El estado del sistema de puesta a tierra debe ser "si" o "no"',
            'sistema_de_carga_por_fondo.required' => 'El estado del sistema de carga por fondo es requerido',
            'sistema_de_carga_por_fondo.in' => 'El estado del sistema de carga por fondo debe ser "si" o "no"',
            'fecha_de_fabricacion.required' => 'La fecha de fabricación es requerida',
            'fecha_de_fabricacion.date' => 'La fecha de fabricación debe ser una fecha válida',
            'numero_de_chasis.required' => 'El número de chasis es requerido',
            'numero_de_chasis.string' => 'El número de chasis debe ser una cadena de texto',
            'numero_de_chasis.max' => 'El número de chasis no puede tener más de 255 caracteres',
            'numero_de_serie.required' => 'El número de serie es requerido',
            'numero_de_serie.string' => 'El número de serie debe ser una cadena de texto',
            'numero_de_serie.max' => 'El número de serie no puede tener más de 255 caracteres',
            'numero_de_ejes.required' => 'El número de ejes es requerido',
            'numero_de_ejes.integer' => 'El número de ejes debe ser un número entero',
            'numero_de_ejes.min' => 'El número de ejes debe ser al menos 0',
            'numero_de_llantas.required' => 'El número de llantas es requerido',
            'numero_de_llantas.integer' => 'El número de llantas debe ser un número entero',
            'numero_de_llantas.min' => 'El número de llantas debe ser al menos 0',
            'material.required' => 'El material es requerido',
            'material.string' => 'El material debe ser una cadena de texto',
            'material.max' => 'El material no puede tener más de 255 caracteres',
            'tipo_de_soldadura_a.required' => 'El tipo de soldadura A es requerido',
            'tipo_de_soldadura_a.string' => 'El tipo de soldadura A debe ser una cadena de texto',
            'tipo_de_soldadura_a.max' => 'El tipo de soldadura A no puede tener más de 255 caracteres',
            'color_cisterna.required' => 'El color del cisterna es requerido',
            'color_cisterna.string' => 'El color del cisterna debe ser una cadena de texto',
            'color_cisterna.max' => 'El color del cisterna no puede tener más de 255 caracteres',
            'tipo_de_soldadura_b.required' => 'El tipo de soldadura B es requerido',
            'tipo_de_soldadura_b.string' => 'El tipo de soldadura B debe ser una cadena de texto',
            'tipo_de_soldadura_b.max' => 'El tipo de soldadura B no puede tener más de 255 caracteres',
            'conductor_de_descarga.required' => 'El conductor de descarga es requerido',
            'conductor_de_descarga.string' => 'El conductor de descarga debe ser una cadena de texto',
            'conductor_de_descarga.max' => 'El conductor de descarga no puede tener más de 255 caracteres',
            'cabeza.required' => 'La cabeza es requerida',
            'cabeza.numeric' => 'La cabeza debe ser un número',
            'cabeza.min' => 'La cabeza debe ser al menos 0',
            'tapas.required' => 'Las tapas son requeridas',
            'tapas.numeric' => 'Las tapas deben ser un número',
            'tapas.min' => 'Las tapas deben ser al menos 0',
            'manto.required' => 'El manto es requerido',
            'manto.numeric' => 'El manto debe ser un número',
            'manto.min' => 'El manto debe ser al menos 0',
            'antivuelque.required' => 'El antivuelque es requerido',
            'antivuelque.numeric' => 'El antivuelque debe ser un número',
            'antivuelque.min' => 'El antivuelque debe ser al menos 0',
            'numero_de_hojas.required' => 'El número de hojas es requerido',
            'numero_de_hojas.integer' => 'El número de hojas debe ser un número entero',
            'numero_de_hojas.min' => 'El número de hojas debe ser al menos 0',
        ];

        

        $this->validate($rules, $messages); 


        // Busca la cisterna y lo guarda en una variable
        $cistern = SisCistern::find($this->cistern_id);

        // Verifica si la cisterna fue encontrada
        if ($cistern) {
            // Actualiza la cisterna
            $cistern->update([
                'fecha' => \Carbon\Carbon::parse($this->fecha),
                'placa_1' => $this->placa_1,
                'placa_2' => $this->placa_2,
                'tracto' => $this->tracto,
                'cisterna' => $this->cisterna,
                'ruat' => $this->ruat,
                'certificado_de_fabricacion_del_tanque' => $this->certificado_de_fabricacion_del_tanque,
                'poliza_de_seguro' => $this->poliza_de_seguro,
                'certificado_hermeticidad' => $this->certificado_hermeticidad,
                'tarjeta_de_cubicacion' => $this->tarjeta_de_cubicacion,
                'nit' => $this->nit,
                'posterior' => $this->posterior,
                'superior' => $this->superior,
                'lateral_izquierdo' => $this->lateral_izquierdo,
                'lateral_derecho' => $this->lateral_derecho,
                'frontal_con_equipos_de_seguridad' => $this->frontal_con_equipos_de_seguridad,
                'plaqueta_cisterna' => $this->plaqueta_cisterna,
                'foto_valvulas' => $this->foto_valvulas,
                'plaqueta' => $this->plaqueta,
                'precintos' => $this->precintos,
                'stickers_afericion' => $this->stickers_afericion,
                'licencia_conductor_principal' => $this->licencia_conductor_principal,
                'licencia_conductor_reemplazo' => $this->licencia_conductor_reemplazo,
                'vigencia_poder' => $this->vigencia_poder,
                'marca' => $this->marca,
                'clase' => $this->clase,
                'forma' => $this->forma,
                'compartimiento_litros_1' => $this->compartimiento_litros_1,
                'compartimiento_litros_2' => $this->compartimiento_litros_2,
                'compartimiento_galones_1' => $this->compartimiento_galones_1,
                'compartimiento_galones_2' => $this->compartimiento_galones_2,
                'norma_de_fabricacion' => $this->norma_de_fabricacion,
                'numero_de_rompeolas' => $this->numero_de_rompeolas,
                'presion_de_diseno' => $this->presion_de_diseno,
                'presion_de_prueba' => $this->presion_de_prueba,
                'compartimiento_1' => $this->compartimiento_1,
                'compartimiento_2' => $this->compartimiento_2,
                'largo_1' => $this->largo_1,
                'largo_2' => $this->largo_2,
                'ancho_1' => $this->ancho_1,
                'ancho_2' => $this->ancho_2,
                'alto_1' => $this->alto_1,
                'alto_2' => $this->alto_2,
                'distancia_entre_ejes_1' => $this->distancia_entre_ejes_1,
                'distancia_entre_ejes_2' => $this->distancia_entre_ejes_2,
                'tara' => $this->tara,
                'corrosion' => $this->corrosion,
                'valvulas_de_descarga' => $this->valvulas_de_descarga,
                'tapas_externas_con_valvulas_de_admision_o_escotillas' => $this->tapas_externas_con_valvulas_de_admision_o_escotillas,
                'sistemas_de_recuperacion_de_gases_o_vapores' => $this->sistemas_de_recuperacion_de_gases_o_vapores,
                'sistema_de_sensor_de_llenado_o_sobrellenado' => $this->sistema_de_sensor_de_llenado_o_sobrellenado,
                'sistema_de_puesta_a_tierra' => $this->sistema_de_puesta_a_tierra,
                'sistema_de_carga_por_fondo' => $this->sistema_de_carga_por_fondo,
                'fecha_de_fabricacion' => \Carbon\Carbon::parse($this->fecha_de_fabricacion),
                'numero_de_chasis' => $this->numero_de_chasis,
                'numero_de_serie' => $this->numero_de_serie,
                'numero_de_ejes' => $this->numero_de_ejes,
                'numero_de_llantas' => $this->numero_de_llantas,
                'material' => $this->material,
                'tipo_de_soldadura_a' => $this->tipo_de_soldadura_a,
                'color_cisterna' => $this->color_cisterna,
                'tipo_de_soldadura_b' => $this->tipo_de_soldadura_b,
                'conductor_de_descarga' => $this->conductor_de_descarga,
                'cabeza' => $this->cabeza,
                'tapas' => $this->tapas,
                'manto' => $this->manto,
                'antivuelque' => $this->antivuelque,
                'numero_de_hojas' => $this->numero_de_hojas,
            ]);            

            // Guarda la cisterna
            $cistern->save();
        }

        // Texto que se verá en el mensaje de tipo toast
        $text = "Cisterna con placa: '" . $cistern->placa . "' actualizada exitosamente";
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
        'delete' => 'delete_cistern'
    ];
    
    // Elimina una planilla
    public function delete_cistern($cistern_id)
    {
        try
        {
            // Inicia una transacción
            DB::beginTransaction();
    
            $cistern = SisCistern::find($cistern_id);
    
            if (!$cistern)
            {
                throw new \Exception('Planilla no encontrada');
            }
    
            // Elimina el registro
            $cistern->delete();
    
            // Texto que se verá en el mensaje de tipo toast
            $text = '¡Cisterna con placa: "' . $cistern->placa_1 . '" eliminada exitosamente!';
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
