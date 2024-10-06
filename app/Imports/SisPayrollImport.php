<?php
namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SisPayrollImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    private $collection;

    public function headingRow(): int
    {
        return 1; // El encabezado empieza en la fila 1
    }

    public function startRow(): int
    {
        return 1; // Los datos empiezan en la fila 1
    }

    public function collection(Collection $rows)
    {
        $this->collection = new Collection();

        foreach ($rows as $row) {
            if (empty(array_filter($row->toArray()))) {
                break; // Detener la importación si la fila está vacía
            }

            $this->collection->push([
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
                // Automatic Calculation
                'merma' => (isset($row['carguio']) && isset($row['volumen_descarguio'])) ? $row['carguio'] - $row['volumen_descarguio'] : null,
                'merma_limite_excedible' => isset($row['carguio']) ? $row['carguio'] * 0.003 : null,
                'cobros_al_100_de_la_merma' => $this->get_cobros_al_100_de_la_merma(($row['carguio'] - $row['volumen_descarguio']), ($row['carguio'] * 0.003)),
                // ---------------------
                'merma_cobrable' => $row['merma_cobrable'] ?? null,
                'precio_de_la_merma' => $row['precio_de_la_merma'] ?? null,
                // Automatic Calculation
                'merma_por_cobrar' => (isset($row['precio_de_la_merma']))
                ? ($this->get_cobros_al_100_de_la_merma(($row['carguio'] - $row['volumen_descarguio']), ($row['carguio'] * 0.003)) * $row['precio_de_la_merma']) * 1000
                : null,
                // ---------------------
                'flete' => $row['flete'] ?? null,
                // Automatic Calculation
                'liquido_basico' => (isset($row['carguio']) && isset($row['flete']))
                ? round($row['carguio'] * $row['flete'], 0)
                : null,
                'derecho_de_empresa' => (isset($row['carguio']) && isset($row['flete']))
                ? round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0)
                : null,
                'liquido_facturado' => (isset($row['carguio']) && isset($row['flete']))
                ? round($row['carguio'] * $row['flete'], 0) - round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0)
                : null,
                // ---------------------
                'anticipo' => $row['anticipo'] ?? null,
                'fecha_de_pago_anticipo' => isset($row['fecha_de_pago_anticipo']) ? $this->transformDate($row['fecha_de_pago_anticipo']) : null,
                // Automatic Calculation
                'fecha_de_pago_anticipo_literal' => isset($row['fecha_de_pago_anticipo']) ? $this->transformDate($row['fecha_de_pago_anticipo']) : null,
                'saldo' => (isset($row['carguio']) && isset($row['flete']))
                ? round($row['carguio'] * $row['flete'], 0) - round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0) - $row['anticipo'] - ($row['it'] + $row['resolucion_internacional'] + $row['poliza_de_responsabilidad_civil'] + $row['poliza_de_transporte'] + $row['iva'] + $row['gastos_administrativos_santa_cruz'] + (($this->get_cobros_al_100_de_la_merma(($row['carguio'] - $row['volumen_descarguio']), ($row['carguio'] * 0.003)) * $row['precio_de_la_merma']) * 1000) + $row['ibmetro'] + $row['rastreo_satelital'] + $row['otros_descuentos'])
                : null,
                // ---------------------
                'fecha_de_pago' => isset($row['fecha_de_pago']) ? $this->transformDate($row['fecha_de_pago']) : null,
                // Automatic Calculation
                'fecha_de_pago_saldo_literal' => isset($row['fecha_de_pago']) ? $this->transformDate($row['fecha_de_pago']) : null,
                // ---------------------
                'total' => $row['anticipo'] + round($row['carguio'] * $row['flete'], 0) - round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0) - (isset($row['anticipo']) ? $row['anticipo'] : 0) - array_sum(array_filter([
                    $row['it'],
                    $row['resolucion_internacional'],
                    $row['poliza_de_responsabilidad_civil'],
                    $row['poliza_de_transporte'],
                    $row['iva'],
                    $row['gastos_administrativos_santa_cruz'],
                    ($row['carguio'] - $row['volumen_descarguio']),
                    $row['ibmetro'],
                    $row['rastreo_satelital'],
                    $row['otros_descuentos'],
                ], function($value) {
                    return !is_null($value);
                })) + array_sum(array_filter([
                    $row['it'],
                    $row['resolucion_internacional'],
                    $row['poliza_de_responsabilidad_civil'],
                    $row['poliza_de_transporte'],
                    $row['iva'],
                    $row['gastos_administrativos_santa_cruz'],
                    ($row['carguio'] - $row['volumen_descarguio']),
                    $row['ibmetro'],
                    $row['rastreo_satelital'],
                    $row['otros_descuentos'],
                ], function($value) {
                    return !is_null($value);
                })),
                'total_deuda' => round($row['carguio'] * $row['flete'], 0) - round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0) - ($row['anticipo'] + round($row['carguio'] * $row['flete'], 0) - round(round($row['carguio'] * $row['flete'], 0) * 0.07, 0) - (isset($row['anticipo']) ? $row['anticipo'] : 0) - array_sum(array_filter([
                    $row['it'],
                    $row['resolucion_internacional'],
                    $row['poliza_de_responsabilidad_civil'],
                    $row['poliza_de_transporte'],
                    $row['iva'],
                    $row['gastos_administrativos_santa_cruz'],
                    ($row['carguio'] - $row['volumen_descarguio']),
                    $row['ibmetro'],
                    $row['rastreo_satelital'],
                    $row['otros_descuentos'],
                ], function($value) {
                    return !is_null($value);
                })) + array_sum(array_filter([
                    $row['it'],
                    $row['resolucion_internacional'],
                    $row['poliza_de_responsabilidad_civil'],
                    $row['poliza_de_transporte'],
                    $row['iva'],
                    $row['gastos_administrativos_santa_cruz'],
                    ($row['carguio'] - $row['volumen_descarguio']),
                    $row['ibmetro'],
                    $row['rastreo_satelital'],
                    $row['otros_descuentos'],
                ], function($value) {
                    return !is_null($value);
                }))),
                'factura_numero' => $row['factura_numero'] ?? null,
                'fecha' => isset($row['fecha']) ? $this->transformDate($row['fecha']) : null,
                'it' => $row['it'] ?? null,
                'resolucion_internacional' => $row['resolucion_internacional'] ?? null,
                'poliza_de_responsabilidad_civil' => $row['poliza_de_responsabilidad_civil'] ?? null,
                'poliza_de_transporte' => $row['poliza_de_transporte'] ?? null,
                'iva' => $row['iva'] ?? null,
                'gastos_administrativos_santa_cruz' => $row['gastos_administrativos_santa_cruz'] ?? null,
                // Automatic Calculation
                'merma' => ($this->get_cobros_al_100_de_la_merma(($row['carguio'] - $row['volumen_descarguio']), ($row['carguio'] * 0.003)) * $row['precio_de_la_merma']) * 1000,
                // ---------------------
                'ibmetro' => $row['ibmetro'] ?? null,
                'rastreo_satelital' => $row['rastreo_satelital'] ?? null,
                'otros_descuentos' => $row['otros_descuentos'] ?? null,
                'totales' => $row['it'] + $row['resolucion_internacional'] + $row['poliza_de_responsabilidad_civil'] + $row['poliza_de_transporte'] + $row['iva'] + $row['gastos_administrativos_santa_cruz'] + (($this->get_cobros_al_100_de_la_merma(($row['carguio'] - $row['volumen_descarguio']), ($row['carguio'] * 0.003)) * $row['precio_de_la_merma']) * 1000) + $row['ibmetro'] + $row['rastreo_satelital'] + $row['otros_descuentos'],
            ]);
        }
    }

    /**
     * Transforma una fecha en diferentes formatos a un objeto de fecha.
     *
     * @param mixed $value El valor de la fecha, que puede ser un número o una cadena.
     * @return \Carbon\Carbon La fecha transformada como un objeto Carbon.
     */
    function get_cobros_al_100_de_la_merma($merma_carguio, $merma_limite_excedible)
    {
        if ($merma_carguio == null || $merma_limite_excedible == null)
        {
            return 0;
        }
        $value = 0;
        if ( $merma_carguio > $merma_limite_excedible)
        {
            $value = $merma_carguio - $merma_limite_excedible;
        }
        return $value;
    }
    private function transformDate($value)
    {
        // Si el valor es numérico, se asume que es una fecha en formato Excel
        // (número de días desde el 1 de enero de 1900), y se convierte a una fecha.
        if (is_numeric($value)) {
            return Carbon::createFromDate(1900, 1, 1)->addDays($value - 2);
        }
        
        // Si el valor no es numérico, se asume que es una cadena en un formato
        // reconocible por Carbon, y se convierte a una fecha.
        return Carbon::parse($value);
    }


    public function getCollection()
    {
        return $this->collection;
    }
}
