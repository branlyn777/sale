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
                                Nuevo pago
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
                                    class="btn btn-success ms-auto mb-0">
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
                                                    {{ $payroll->id }}
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonLight">
                                                    <li>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button wire:click="$emit('show-modal-payment-slip', {{ $payroll->id }})" type="button" class="dropdown-item">
                                                                Planilla de Pago
                                                            </button>
                                                            <a wire:click="paymentSlipPDF({{ $payroll->id }})" class="btn btn-sm" style="color: red; padding-top: 10px;">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" wire:click="$emit('show-modal-expenses-sheet', {{ $payroll->id }})">
                                                            Planilla de Gastos Operativos
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" wire:click="$emit('show-modal-advance-payment', {{ $payroll->id }})">
                                                            Pago de Anticipo
                                                        </a>
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
                                        <td>{{ $payroll->volumen_descarguio }}</td>
                                        <td>{{ $payroll->cobros_al_100_de_la_merma }}</td>
                                        <td>{{ $payroll->merma_cobrable }}</td>
                                        <td>{{ $payroll->precio_de_la_merma }}</td>
                                        <td>{{ $payroll->merma_por_cobrar }}</td>
                                        <td>{{ $payroll->flete }}</td>
                                        <td>{{ $payroll->liquido_basico }}</td>
                                        <td>{{ $payroll->derecho_de_empresa }}</td>
                                        <td>{{ $payroll->liquido_facturado }}</td>
                                        <td>{{ $payroll->anticipo }}</td>
                                        <td>{{ $payroll->fecha_de_pago_anticipo }}</td>
                                        <td>{{ $payroll->fecha_de_pago_anticipo_literal }}</td>
                                        <td>{{ $payroll->saldo }}</td>
                                        <td>{{ $payroll->fecha_de_pago }}</td>
                                        <td>{{ $payroll->fecha_de_pago_saldo_literal }}</td>
                                        <td>{{ $payroll->total }}</td>
                                        <td>{{ $payroll->total_deuda }}</td>
                                        <td>{{ $payroll->factura_numero }}</td>
                                        <td>{{ $payroll->fecha }}</td>
                                        <td>{{ $payroll->it }}</td>
                                        <td>{{ $payroll->resolucion_internacional }}</td>
                                        <td>{{ $payroll->poliza_de_responsabilidad_civil }}</td>
                                        <td>{{ $payroll->poliza_de_transporte }}</td>
                                        <td>{{ $payroll->iva }}</td>
                                        <td>{{ $payroll->gastos_administrativos_santa_cruz }}</td>
                                        <td>{{ $payroll->merma }}</td>
                                        <td>{{ $payroll->ibmetro }}</td>
                                        <td>{{ $payroll->rastreo_satelital }}</td>
                                        <td>{{ $payroll->otros_descuentos }}</td>
                                        <td>{{ $payroll->totales }}</td>
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

            // Muestra la ventana modal crear/actualizar categoria producto
            window.livewire.on('show-modal-payroll', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('payroll'));
                modal.show();
            });
            // Oculta la ventana modal crear/actualizar categoria producto
            window.livewire.on('hide-modal-cistern', msg => {
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