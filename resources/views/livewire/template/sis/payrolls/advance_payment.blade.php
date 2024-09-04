<div class="payment-slip">
    <div class="header">Pago de Anticipo Nro Transporte {{ $numero_de_transporte }}</div>
    <table class="payment-table">
        <thead>
            <tr>
                <th>DETALLE</th>
                <th>IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>IMPORTE FACTURADO</td>
                <td class="amount text-end">
                {{ $liquido_facturado }}
                </td>
            </tr>
            <tr>
                <td>ANTICIPO CANCELADO</td>
                <td class="amount text-end">
                    
                    {{ $anticipo }}

                </td>
            </tr>
            <tr>
                <td><strong>SALDO POR PAGAR</strong></td>
                <td class="amount text-end">
                    <strong>
                        {{ $liquido_facturado - $anticipo }}
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="signature-table">
        <tr>
            <td class="signature-cell">
                <p>Recibí Conforme: <span>{{ $propietario }}</span></p>
                <p>C.I. ___________________</p>
                {{-- <div class="line"></div> --}}
            </td>
        </tr>
    </table>
    <div class="client-info">
        <p>Cliente: {{ $cliente }}</p>
        <p>Nº: TRANS ALVAMA {{ $id }}</p>
        <p>Tramo: {{ $tramo }}</p>
        <p class="date">Cochabamba {{ \Carbon\Carbon::parse($fecha_de_pago_anticipo)->translatedFormat('j \d\e F \d\e Y') }}
        </p>
    </div>
</div>
