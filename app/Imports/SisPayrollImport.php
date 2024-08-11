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
    }

    /**
     * Transforma una fecha en diferentes formatos a un objeto de fecha.
     *
     * @param mixed $value El valor de la fecha, que puede ser un número o una cadena.
     * @return \Carbon\Carbon La fecha transformada como un objeto Carbon.
     */
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
