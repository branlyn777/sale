<?php

namespace App\Imports;

use App\Models\SisPayroll;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SisPayrollImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    private $collection;
    /**
     * Specify the heading row start position.
     */
    public function headingRow(): int
    {
        return 2; // Cambia este valor según la fila donde comiencen los encabezados en tu archivo Excel
    }

    public function model(array $row)
    {
        return new SisPayroll([
            'cliente' => $row['cliente'] ?? null,
            'numero_de_transporte' => $row['numero_de_transporte'] ?? null,
            'propietario' => $row['propietario'] ?? null,
            'placa' => $row['placa'] ?? null,
            'tramo' => $row['tramo'] ?? null,
            'producto' => $row['producto'] ?? null,
            'fecha_de_carga' => isset($row['fecha_de_carga']) ? $this->transformDate($row['fecha_de_carga']) : null,
            'carguio' => $row['carguio'] ?? null,
            'fecha_de_llegada' => isset($row['fecha_de_llegada']) ? $this->transformDate($row['fecha_de_llegada']) : null,
            'volumen_descarguio' => $row['volumen_descarguio'] ?? null,
            'cobros_al_100_de_la_merma' => $row['cobros_al_100_de_la_merma'] ?? null,
            'merma_cobrable' => $row['merma_cobrable'] ?? null,
            'precio_de_la_merma' => $row['precio_de_la_merma'] ?? null,
            'merma_por_cobrar' => $row['merma_por_cobrar'] ?? null,
            'flete' => $row['flete'] ?? null,
            'liquido_basico' => $row['liquido_basico'] ?? null,
            'derecho_de_empresa' => $row['derecho_de_empresa'] ?? null,
            'liquido_facturado' => $row['liquido_facturado'] ?? null,
            'anticipo' => $row['anticipo'] ?? null,
            'fecha_de_pago_anticipo' => isset($row['fecha_de_pago_anticipo']) ? $this->transformDate($row['fecha_de_pago_anticipo']) : null,
            'fecha_de_pago_anticipo_literal' => $row['fecha_de_pago_anticipo_literal'] ?? null,
            'saldo' => $row['saldo'] ?? null,
            'fecha_de_pago' => isset($row['fecha_de_pago']) ? $this->transformDate($row['fecha_de_pago']) : null,
            'fecha_de_pago_saldo_literal' => $row['fecha_de_pago_saldo_literal'] ?? null,
            'total' => $row['total'] ?? null,
            'total_deuda' => $row['total_deuda'] ?? null,
            'factura_numero' => $row['factura_numero'] ?? null,
            'fecha' => isset($row['fecha']) ? $this->transformDate($row['fecha']) : null,
            'it' => $row['it'] ?? null,
            'resolucion_internacional' => $row['resolucion_internacional'] ?? null,
            'poliza_de_responsabilidad_civil' => $row['poliza_de_responsabilidad_civil'] ?? null,
            'poliza_de_transporte' => $row['poliza_de_transporte'] ?? null,
            'iva' => $row['iva'] ?? null,
            'gastos_administrativos_santa_cruz' => $row['gastos_administrativos_santa_cruz'] ?? null,
            'merma' => $row['merma'] ?? null,
            'ibmetro' => $row['ibmetro'] ?? null,
            'rastreo_satelital' => $row['rastreo_satelital'] ?? null,
            'otros_descuentos' => $row['otros_descuentos'] ?? null,
            'totales' => $row['totales'] ?? null,
        ]);
    }
    

    private function transformDate($value)
    {
        if(is_numeric($value)) {
            return Carbon::createFromDate(1900, 1, 1)->addDays($value - 2);
        }
        return Carbon::parse($value);
    }

    public function collection(Collection $rows)
    {
        $this->collection = $rows;
    }

    public function getCollection()
    {
        return $this->collection;
    }

}
