<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisCistern extends Model
{
    use HasFactory;

    // Indica los atributos que pueden ser asignados en masa
    protected $fillable = [
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
    ];

    // Indica los atributos que deben ser tratados como fechas
    protected $dates = [
        'fecha',
        'fecha_de_fabricacion',
        'deleted_at',
    ];

    // Indica los atributos que deben ser tratados como decimales
    protected $casts = [
        'presion_de_diseno' => 'decimal:2',
        'presion_de_prueba' => 'decimal:2',
        'largo_1' => 'decimal:2',
        'largo_2' => 'decimal:2',
        'ancho_1' => 'decimal:2',
        'ancho_2' => 'decimal:2',
        'alto_1' => 'decimal:2',
        'alto_2' => 'decimal:2',
        'distancia_entre_ejes_1' => 'decimal:2',
        'distancia_entre_ejes_2' => 'decimal:2',
        'tara' => 'decimal:2',
        'corrosion' => 'decimal:2',
        'cabeza' => 'decimal:2',
        'tapas' => 'decimal:2',
        'manto' => 'decimal:2',
        'antivuelque' => 'decimal:2',
    ];
}
