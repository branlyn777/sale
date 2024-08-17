<div class="payment-slip">
    <div class="header">
        PLANILLA DE PAGO
    </div>
    <table class="payment-table">
        <thead>
            <tr>
                <th class="text-center">Placa</th>
                <th class="text-center">Tramo</th>
                <th class="text-center">Fecha de Carguío</th>
                <th class="text-center">Fecha de Descarguío</th>
                <th class="text-center">Volumen de Carguío</th>
                <th class="text-center">Volumen de Descarguío</th>
                <th class="text-center">Diferencia</th>
                <th class="text-center">Flete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left">{{ $placa }}</td>
                <td class="text-left">{{ $tramo }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($fechaCarguio)->format('d-m-Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($fechaDescarguio)->format('d-m-Y') }}</td>
                <td style="text-align: right;">{{ number_format($volumenCarguio, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ number_format($volumenDescarguio, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ number_format($diferencia, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ number_format($flete, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <table class="summary-table">
        <thead>
            <tr>
                <th class="text-center"></th>
                <th class="text-center">Detalle</th>
                <th class="text-center">Importe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">(+)</td>
                <td>LIQUIDO A FACTURAR</td>
                <td class="amount">{{ number_format($liquidoFacturar, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">(-)</td>
                <td>Derecho de Empresa 7</td>
                <td class="amount">{{ number_format($derechoEmpresa, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">(-)</td>
                <td></td>
                <td class="amount">0,00</td>
            </tr>
            <tr>
                <td class="text-center">(=)</td>
                <td>TOTAL FLETE A PAGAR - COMISION</td>
                <td class="amount">{{ number_format($totalFlete, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">(-)</td>
                <td>Gastos Operativos</td>
                <td class="amount">{{ number_format($gastosOperativos, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">(-)</td>
                <td>ANTICIPOS CANCELADOS</td>
                <td class="amount">{{ number_format($anticiposCancelados, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">(=)</td>
                <td>IMPORTE CANCELADO</td>
                <td class="amount">{{ number_format($importeCancelado, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <table class="signature-table">
        <tr>
            <td></td> <!-- Columna vacía para centrar la línea -->
            <td>
                <p>Recibí Conforme:</p>
            </td>
            <td class="signature-cell">
                <br>
                <br>
                <br>
                <br>
                <div class="line">{{ $recibidoPor }}</div>
                <p>CI: {{ $ci }}</p>
            </td>
            <td style="color: white;">Recibí Conforme:</td> <!-- Columna vacía para centrar la línea -->
        </tr>
    </table>
    <div class="client-info">
        <p>Cliente: CARGILL S.A.</p>
        <p>Nº TRANS ALVAMA 004</p>
        <p>Producto: ACEITE DE SOYA</p>
    </div>
    <div class="date">
        Cochabamba {{ \Carbon\Carbon::parse($fecha)->format('d-m-Y') }}
    </div>
</div>
