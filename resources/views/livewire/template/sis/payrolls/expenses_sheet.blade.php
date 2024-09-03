<div class="payment-slip">
    <div class="header">
        Planilla de Gastos Operativos
    </div>
    <table class="payment-table">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Tramo</th>
                <th>Fecha de Carguio</th>
                <th>Fecha de Descarguio</th>
                <th>Volumen de Carguio</th>
                <th>Volumen de Descarguio</th>
                <th>Diferencia</th>
                <th>Precio de la Merma</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">{{ $placa }}</td>
                <td class="text-center">{{ $tramo }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($fechaCarguio)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($fechaDescarguio)->format('d/m/Y') }}</td>
                <td class="text-end">{{ number_format($volumenCarguio, 2, ',', '.') }}</td>
                <td class="text-end">{{ number_format($volumenDescarguio, 2, ',', '.') }}</td>
                <td class="text-end">{{ number_format($diferencia, 2, ',', '.') }}</td>
                <td class="text-end">{{ number_format($precioMerma, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Detalle</th>
                <th>Importe</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>(+)</td>
                <td>IT</td>
                <td class="amount text-end">{{ number_format($it, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Resolución Internacional</td>
                <td class="amount text-end">{{ number_format($resolucionInternacional, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Poliza de Responsabilidad Civil</td>
                <td class="amount text-end">{{ number_format($polizaResponsabilidadCivil, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Poliza de Transporte o seguro de carga</td>
                <td class="amount text-end">{{ number_format($polizaTransporte, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>IVA</td>
                <td class="amount text-end">{{ number_format($iva, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Gastos Administrativos Santa Cruz</td>
                <td class="amount text-end">{{ number_format($gastosAdministrativosSantaCruz, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Merma</td>
                <td class="amount text-end">{{ number_format($merma, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>IBMETRO</td>
                <td class="amount text-end">{{ number_format($ibmetro, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Rastreo Satelital Nov y Diciembre</td>
                <td class="amount text-end">{{ number_format($rastreoSatelital, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(=)</td>
                <td>Importe por Cobrar</td>
                <td class="amount text-end">{{ number_format($importePorCobrar, 2, ',', '.') }}</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>(+)</td>
                <td>IT</td>
                <td class="amount text-end">{{ number_format($it, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Resolución Internacional</td>
                <td class="amount text-end">{{ number_format($resolucionInternacional, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Poliza de Responsabilidad Civil</td>
                <td class="amount text-end">{{ number_format($polizaResponsabilidadCivil, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Poliza de Transporte o seguro de carga</td>
                <td class="amount text-end">{{ number_format($polizaTransporte, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>IVA</td>
                <td class="amount text-end">{{ number_format($iva, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Gastos Administrativos Santa Cruz</td>
                <td class="amount text-end">{{ number_format($gastosAdministrativosSantaCruz, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Merma</td>
                <td class="amount text-end">{{ number_format($merma, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>IBMETRO</td>
                <td class="amount text-end">{{ number_format($ibmetro, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(+)</td>
                <td>Rastreo Satelital Nov y Diciembre</td>
                <td class="amount text-end">{{ number_format($rastreoSatelital, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>(=)</td>
                <td>Importe por Cobrar</td>
                <td class="amount text-end">{{ number_format($importePorCobrar, 2, ',', '.') }}</td>
            </tr>
        </tbody>                
    </table>
    <table class="signature-table">
        <tr>
            <td style="color: white;">asdasdasdaasdasdasdaaasdasdasda</td>
            <td class="signature-cell">
                <p>{{ $recibidoPor }}</p>
                <br>
                <br>
                <br>
                <p class="line"></p>
                <p>C.I.</p>
            </td>
            <td style="color: white;">asdasdasdaasdasdasdaaasdasdasda</td>
        </tr>
    </table>
    <div class="client-info">
        <p>Cliente: {{ $cliente }}</p>
        <p>Nº: {{ $id }}</p>
        <p>Producto: {{ $producto }}</p>
    </div>
    <div class="date">
        Cochabamba, {{ \Carbon\Carbon::parse($fecha)->format('d \d\e F \d\e Y') }}
    </div>    
</div>
