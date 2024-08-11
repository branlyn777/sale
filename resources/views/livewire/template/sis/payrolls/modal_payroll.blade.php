<div wire:ignore.self class="modal fade" id="payroll" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->client_id == 0)
                CREAR CLIENTE
                @else
                ACTUALIZAR CLIENTE
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
                        <label class="form-label">Número de transporte</label>
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
                        <input wire:model.lazy="Carguio" type="number" step="0.01" class="form-control">
                        @error('carguio')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de llegada</label>
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
                        <label class="form-label">Cobros al 100 de ma merma</label>
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
                        <label class="form-label">Merma por cobrar</label>
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
                        <label class="form-label">Liquido basico</label>
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
                        <label class="form-label">liquido facturado</label>
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
                        <label class="form-label">fecha de pago anticipo</label>
                        <input wire:model.lazy="fecha_de_pago_anticipo" type="date" class="form-control">
                        @error('fecha_de_pago_anticipo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">fecha de pago anticipo literal</label>
                        <input wire:model.lazy="fecha_de_pago_anticipo_literal" type="date" class="form-control">
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
                        <label class="form-label">fecha de pago</label>
                        <input wire:model.lazy="fecha_de_pago" type="date" class="form-control">
                        @error('fecha_de_pago')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">fecha de pago literal</label>
                        <input wire:model.lazy="fecha_de_pago_saldo_literal" type="date" class="form-control">
                        @error('fecha_de_pago_saldo_literal')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input wire:model.lazy="total" type="number" step="0.01" class="form-control">
                        @error('total')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total deuda</label>
                        <input wire:model.lazy="total_deuda" type="number" step="0.01" class="form-control">
                        @error('total_deuda')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Factura numero</label>
                        <input wire:model.lazy="factura_numero" type="number" step="0.01" class="form-control">
                        @error('factura_numero')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">fecha</label>
                        <input wire:model.lazy="fecha" type="date" class="form-control">
                        @error('fecha')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">it</label>
                        <input wire:model.lazy="it" type="number" step="0.01" class="form-control">
                        @error('it')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Resolucion internacional</label>
                        <input wire:model.lazy="resolucion_internacional" type="number" step="0.01" class="form-control">
                        @error('resolucion_internacional')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">poliza de responsabilidad civil</label>
                        <input wire:model.lazy="poliza_de_responsabilidad_civil" type="number" step="0.01" class="form-control">
                        @error('poliza_de_responsabilidad_civil')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poliza de Transporte</label>
                        <input wire:model.lazy="poliza_de_transporte" type="number" step="0.01" class="form-control">
                        @error('poliza_de_transporte')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">IVA</label>
                        <input wire:model.lazy="iva" type="number" step="0.01" class="form-control">
                        @error('iva')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">gastos administrativos santa cruz</label>
                        <input wire:model.lazy="gastos_administrativos_santa_cruz" type="number" step="0.01" class="form-control">
                        @error('gastos_administrativos_santa_cruz')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">merma</label>
                        <input wire:model.lazy="merma" type="number" step="0.01" class="form-control">
                        @error('merma')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ibmetro</label>
                        <input wire:model.lazy="ibmetro" type="number" step="0.01" class="form-control">
                        @error('ibmetro')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">rastreo satelital</label>
                        <input wire:model.lazy="rastreo_satelital" type="number" step="0.01" class="form-control">
                        @error('rastreo_satelital')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">otros descuentos</label>
                        <input wire:model.lazy="otros_descuentos" type="number" step="0.01" class="form-control">
                        @error('otros_descuentos')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">totales</label>
                        <input wire:model.lazy="totales" type="number" step="0.01" class="form-control">
                        @error('totales')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>  
          
        </div>
    </div>
</div>