<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisPayroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'numero_de_transporte',
        'propietario',
        'placa',
        'tramo',
        'producto',
        'fecha_de_carga',
        'carguio',
        'fecha_de_llegada',
        'volumen_descarguio',
        'merma_carguio',
        'merma_limite_excedible',
        'cobros_al_100_de_la_merma',
        'merma_cobrable',
        'precio_de_la_merma',
        'merma_por_cobrar',
        'flete',
        'liquido_basico',
        'derecho_de_empresa',
        'liquido_facturado',
        'anticipo',
        'fecha_de_pago_anticipo',
        'fecha_de_pago_anticipo_literal',
        'saldo',
        'fecha_de_pago',
        'fecha_de_pago_saldo_literal',
        'total',
        'total_deuda',
        'factura_numero',
        'fecha',
        'it',
        'resolucion_internacional',
        'poliza_de_responsabilidad_civil',
        'poliza_de_transporte',
        'iva',
        'gastos_administrativos_santa_cruz',
        'merma',
        'ibmetro',
        'rastreo_satelital',
        'otros_descuentos',
        'totales',
    ];




}
