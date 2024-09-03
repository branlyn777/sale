<div wire:ignore.self class="modal fade" id="payroll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    @if($this->payroll_id == 0)
                        CREAR PLANILLA DE PAGOS
                    @else
                        ACTUALIZAR PLANILLA DE PAGOS
                    @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <input wire:model.lazy="cliente" type="text" class="form-control">
                        @error('cliente')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Transporte</label>
                        <input wire:model.lazy="numero_de_transporte" type="text" class="form-control">
                        @error('numero_de_transporte')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Propietario</label>
                        <input wire:model.lazy="propietario" type="text" class="form-control">
                        @error('propietario')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Placa</label>
                        <input wire:model.lazy="placa" type="text" class="form-control">
                        @error('placa')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tramo</label>
                        <input wire:model.lazy="tramo" type="text" class="form-control">
                        @error('tramo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input wire:model.lazy="producto" type="text" class="form-control">
                        @error('producto')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Carga</label>
                        <input wire:model.lazy="fecha_de_carga" type="date" class="form-control">
                        @error('fecha_de_carga')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Carguio</label>
                        <input wire:model.lazy="carguio" type="text" class="form-control">
                        @error('carguio')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Llegada</label>
                        <input wire:model.lazy="fecha_de_llegada" type="date" class="form-control">
                        @error('fecha_de_llegada')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Volumen Descarguio</label>
                        <input wire:model.lazy="volumen_descarguio" type="number" step="0.01" class="form-control">
                        @error('volumen_descarguio')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cobros al 100% de la Merma</label>
                        <input wire:model.lazy="cobros_al_100_de_la_merma" type="number" step="0.01" class="form-control">
                        @error('cobros_al_100_de_la_merma')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merma Cobrable</label>
                        <input wire:model.lazy="merma_cobrable" type="number" step="0.01" class="form-control">
                        @error('merma_cobrable')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio de la Merma</label>
                        <input wire:model.lazy="precio_de_la_merma" type="number" step="0.01" class="form-control">
                        @error('precio_de_la_merma')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merma por Cobrar</label>
                        <input wire:model.lazy="merma_por_cobrar" type="number" step="0.01" class="form-control">
                        @error('merma_por_cobrar')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Flete</label>
                        <input wire:model.lazy="flete" type="number" step="0.01" class="form-control">
                        @error('flete')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Líquido Básico</label>
                        <input wire:model.lazy="liquido_basico" type="number" step="0.01" class="form-control">
                        @error('liquido_basico')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Derecho de Empresa</label>
                        <input wire:model.lazy="derecho_de_empresa" type="number" step="0.01" class="form-control">
                        @error('derecho_de_empresa')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Líquido Facturado</label>
                        <input wire:model.lazy="liquido_facturado" type="number" step="0.01" class="form-control">
                        @error('liquido_facturado')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anticipo</label>
                        <input wire:model.lazy="anticipo" type="number" step="0.01" class="form-control">
                        @error('anticipo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Pago del Anticipo</label>
                        <input wire:model.lazy="fecha_de_pago_anticipo" type="date" class="form-control">
                        @error('fecha_de_pago_anticipo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Pago Anticipo Literal</label>
                        <input wire:model.lazy="fecha_de_pago_anticipo_literal" type="text" class="form-control">
                        @error('fecha_de_pago_anticipo_literal')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Saldo</label>
                        <input wire:model.lazy="saldo" type="number" step="0.01" class="form-control">
                        @error('saldo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Pago</label>
                        <input wire:model.lazy="fecha_de_pago" type="date" class="form-control">
                        @error('fecha_de_pago')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha Literal de Pago</label>
                        <input wire:model.lazy="fecha_literal_de_pago" type="text" class="form-control">
                        @error('fecha_literal_de_pago')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        @if($this->payroll_id == 0)
                            <button wire:click.prevent="create_payroll" class="btn btn-primary">Crear</button>
                        @else
                            <button type="button" wire:click.prevent="update_payroll()" class="btn btn-secondary">Actualizar</button>
                        @endif
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>
