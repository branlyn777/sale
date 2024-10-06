@section('css')

    @include('livewire.template.sis.payrolls.styles_payroll')

@endsection
<div class="pc-content">
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <h5>PLANILLA DE PAGO</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                            <button wire:click.prevent="showModalPayroll(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nueva Planilla
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <label>Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center">
                            <label for="mes">Seleccione un mes:</label>
                            <select id="mes" class="form-control">
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>                        
                        <div class="col-12 col-sm-6 col-md-4 text-center">
                            
                            <div class="input-group">
                                <input 
                                    type="file" 
                                    wire:model="file_excel_payroll" 
                                    class="form-control" 
                                    aria-label="Upload" 
                                    accept=".xlsx, .xls"
                                >
                                <button 
                                    wire:click.prevent="import_excel_payroll()" 
                                    class="btn btn-success ms-auto mb-0" 
                                    @disabled(! $file_excel_payroll)>
                                    Importar
                                </button>
                            </div>                            
                              
                        </div>
                    </div>
                </div>
                <span wire:loading.delay.longer class="loader"></span>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Número de Transporte</th>
                                    <th>Propietario</th>
                                    <th>Placa</th>
                                    <th>Tramo</th>
                                    <th>Producto</th>
                                    <th>Fecha de Carga</th>
                                    <th>Carguio</th>
                                    <th>Fecha de Llegada</th>
                                    <th>Volumen Descarguio</th>
                                    <th>Merma</th>
                                    <th>Merma Limite Excedible</th>
                                    <th>Cobros al 100% de la Merma</th>
                                    <th>Merma Cobrable</th>
                                    <th>Precio de la Merma</th>
                                    <th>Merma por Cobrar</th>
                                    <th>Flete</th>
                                    <th>Líquido Básico</th>
                                    <th>Derecho de Empresa %</th>
                                    <th>Líquido Facturado</th>
                                    <th>Anticipo</th>
                                    <th>Fecha de Pago Anticipo</th>
                                    <th>Fecha de Pago Anticipo Literal</th>
                                    <th>Saldo</th>
                                    <th>Fecha de Pago</th>
                                    <th>Fecha de Pago Saldo Literal</th>
                                    <th>Total</th>
                                    <th>Total Deuda</th>
                                    <th>Factura Nº</th>
                                    <th>Fecha</th>
                                    <th>IT</th>
                                    <th>Resolución Internacional</th>
                                    <th>Póliza de Responsabilidad Civil</th>
                                    <th>Póliza de Transporte o Seguro de Carga</th>
                                    <th>IVA</th>
                                    <th>Gastos Administrativos Santa Cruz</th>
                                    <th>Merma</th>
                                    <th>IBMETRO</th>
                                    <th>Rastreo Satelital</th>
                                    <th>Otros Descuentos</th>
                                    <th>Totales</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $payroll)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($payrolls->currentpage() - 1) * $payrolls->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <div class="dropdown" data-bs-theme="blue">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonLight" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <b>{{ $payroll->id }}</b>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonLight">
                                                    <li>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{-- <button wire:click="$emit('show-modal-payment-slip', {{ $payroll->id }})" type="button" class="dropdown-item"> --}}
                                                            <button type="button" class="dropdown-item">
                                                                Planilla de Pago
                                                            </button>
                                                            <a wire:click="paymentSlipPDF({{ $payroll->id }})" class="btn btn-sm" style="color: red; padding-top: 10px;">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{-- <button wire:click="$emit('show-modal-expenses-sheet', {{ $payroll->id }})" type="button" class="dropdown-item"> --}}
                                                            <button type="button" class="dropdown-item">
                                                                Planilla de Gastos Operativos
                                                            </button>
                                                            <a wire:click="expensesSheetPDF({{ $payroll->id }})" class="btn btn-sm" style="color: red; padding-top: 10px;">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{-- <button wire:click="$emit('show-modal-advance-payment', {{ $payroll->id }})" type="button" class="dropdown-item"> --}}
                                                            <button type="button" class="dropdown-item">
                                                                Pago de Anticipo
                                                            </button>
                                                            <a wire:click="advancePaymentPDF({{ $payroll->id }})" class="btn btn-sm" style="color: red; padding-top: 10px;">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                              </div>
                                        </td>
                                        <td>{{ $payroll->cliente }}</td>
                                        <td>{{ $payroll->numero_de_transporte }}</td>
                                        <td>{{ $payroll->propietario }}</td>
                                        <td>{{ $payroll->placa }}</td>
                                        <td>{{ $payroll->tramo }}</td>
                                        <td>{{ $payroll->producto }}</td>
                                        <td>{{ $payroll->fecha_de_carga }}</td>
                                        <td>{{ $payroll->carguio }}</td>
                                        <td>{{ $payroll->fecha_de_llegada }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->volumen_descarguio, 3)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->merma, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->merma_limite_excedible, 3)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->cobros_al_100_de_la_merma, 2)) }}</td>
                                        <td>{{ $payroll->merma_cobrable }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->precio_de_la_merma, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->merma_por_cobrar, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->flete, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->liquido_basico, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->derecho_de_empresa, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->liquido_facturado, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->anticipo, 2)) }}</td>
                                        <td>{{ $payroll->fecha_de_pago_anticipo }}</td>
                                        <td>{{ $payroll->fecha_de_pago_anticipo_literal }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->saldo, 2)) }}</td>
                                        <td>{{ $payroll->fecha_de_pago }}</td>
                                        <td>{{ $payroll->fecha_de_pago_saldo_literal }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->total, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->total_deuda, 2)) }}</td>
                                        <td>{{ $payroll->factura_numero }}</td>
                                        <td>{{ $payroll->fecha }}</td>
                                        <td>{{ $payroll->it }}</td>
                                        <td>{{ $payroll->resolucion_internacional }}</td>
                                        <td>{{ $payroll->poliza_de_responsabilidad_civil }}</td>
                                        <td>{{ $payroll->poliza_de_transporte }}</td>
                                        <td>{{ $payroll->iva }}</td>
                                        <td>{{ $payroll->gastos_administrativos_santa_cruz }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->merma, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->ibmetro, 2)) }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->rastreo_satelital, 2)) }}</td>
                                        <td>{{ $payroll->otros_descuentos }}</td>
                                        <td>{{ str_replace('.', ',', number_format($payroll->totales, 2)) }}</td>
                                        
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalPayroll({{ $payroll->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="confirm({{ $payroll->id }}, 'Placa: {{ $payroll->placa }}', '¿Esta seguro de eliminar?' ,'warning', 'Si, eliminar')" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $payrolls->links() }}
                </div>                
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.sis.payrolls.modal_payroll')
            @include('livewire.template.sis.payrolls.modal_payment_slip')
            @include('livewire.template.sis.payrolls.modal_expenses_sheet')
            @include('livewire.template.sis.payrolls.modal_advance_payment')
        <!-- [ Modal ] end -->
    </div>
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar
            window.livewire.on('show-modal-payroll', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('payroll'));
                modal.show();
            });
            // Oculta la ventana modal crear/actualizar
            window.livewire.on('hide-modal-payroll', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('payroll'));
                modal.hide();
            });




            // Muestra la ventana modal Boleta de Pago
            window.livewire.on('show-modal-payment-slip', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('payment_slip'));
                modal.show();
            });
            // Oculta la ventana modal Boleta de Pago
            window.livewire.on('hide-modal-payment-slip', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('payment_slip'));
                modal.hide();
            });



            // Muestra la ventana modal Planilla de Gastos Operativos
            window.livewire.on('show-modal-expenses-sheet', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('expenses_sheet'));
                modal.show();
            });
            // Oculta la ventana modal Planilla de Gastos Operativos
            window.livewire.on('hide-modal-expenses-sheet', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('expenses_sheet'));
                modal.hide();
            });



            

            // Muestra la ventana modal Planilla de Gastos Operativos
            window.livewire.on('show-modal-advance-payment', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('advance_payment'));
                modal.show();
            });
            // Oculta la ventana modal Planilla de Gastos Operativos
            window.livewire.on('hide-modal-advance-payment', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('advance_payment'));
                modal.hide();
            });



            // Muestra una alerta
            window.livewire.on('alert', msg => {
                Swal.fire({
                    title: msg.title,
                    text: msg.text,
                    icon: msg.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: msg.confirmButtonText,
                    cancelButtonText: msg.cancelButtonText,
                    }).then((result) => {
                    if (result.isConfirmed)
                    {
                        window.livewire.emit('deleteCistern', msg.id)
                        Swal.close()
                    }
                })
            });
            // Muestra un mensaje de tipo toast arriba a la derecha
            window.livewire.on('toast', msg => {
                Swal.fire({
                    toast: true,
                    text: msg.text,
                    showConfirmButton: false,
                    position: 'top-right',
                    timer: msg.timer,
                    timerProgressBar: true,
                    icon: msg.icon
                })
            });

        });
    </script>


    {{-- Para abrir el PDF en una nueva pestaña del navegador, agregue el siguiente script en la vista de Livewire: --}}
    <script>
        document.addEventListener('livewire:load', function () {
            @this.on('openPdf', pdfUrl => {
                window.open(pdfUrl, '_blank');
            });
        });
    </script>

@endsection