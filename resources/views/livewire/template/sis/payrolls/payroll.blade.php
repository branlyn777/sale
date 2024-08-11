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
                                <input type="file" wire:model="file_excel_payroll" class="form-control" aria-label="Upload">
                                <button wire:click.prevent="import_excel_payroll()" class="btn btn-success ms-auto mb-0">
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
                                    <th>Volumen</th>
                                    <th>Descarguio</th>
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
                                    <th>Total (Anticipos, Gastos Operativos y Saldo)</th>
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
                                    <th>Rastreo Satelital Nov y Diciembre</th>
                                    <th>Otros Descuentos</th>
                                    <th>Totales</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {{-- @foreach($owners as $o)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($owners->currentpage() - 1) * $owners->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                            {{$o->owner_code}}
                                        </td>
                                        <td>
                                            {{$o->name}} {{$o->paternal_surname}} {{$o->maternal_surname}}
                                        </td>
                                        <td class="text-center">
                                            {{$o->ci_number}}
                                        </td>
                                        <td class="text-center">
                                            {{$o->nit_number}}
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalOwner({{ $o->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="check_owner({{ $o->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>                                
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- {{ $owners->links() }} --}}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.sis.payrolls.modal_payroll')
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
@endsection