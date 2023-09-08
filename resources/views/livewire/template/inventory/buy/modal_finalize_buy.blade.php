<div wire:ignore.self class="modal fade" id="finalize_buy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">FINALIZAR COMPRA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 text-center mb-2">
                        <p>Sucursal</p>
                        <h3>Sucursal Central</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 text-center mb-2">
                        <p>Almacen</p>
                        <h3>Sucursal Central</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-2">
                        <label class="form-label">Observación</label>
                        <textarea wire:model.lazy="description" class="form-control" placeholder="Puede escribir detalles adicionales de esta compra aqui..." rows="3"></textarea>
                        @error('description')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="buy()" class="btn btn-primary">Comprar</button>
            </div>
        </div>
    </div>
</div>
