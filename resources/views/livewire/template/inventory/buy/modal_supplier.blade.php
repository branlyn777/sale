<div wire:ignore.self class="modal fade" id="supplier" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">CREAR PROVEEDOR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-2">
                        <label class="form-label">Nombre</label> <span class="text-danger">*</span>
                        <input wire:model.lazy="name_supplier" type="text" class="form-control">
                        @error('name_supplier')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-2">
                        <label class="form-label">Dirección</label>
                        <input wire:model.lazy="address" type="text" class="form-control">
                        @error('address')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 mb-2">
                        <label class="form-label">Celular 1</label>
                        <input wire:model.lazy="phone_number_a" type="text" class="form-control">
                        @error('phone_number_a')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 mb-2">
                        <label class="form-label">Celular 2</label>
                        <input wire:model.lazy="phone_number_b" type="text" class="form-control">
                        @error('phone_number_b')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-2">
                        <label class="form-label">Correo</label>
                        <input wire:model.lazy="mail" type="text" class="form-control">
                        @error('mail')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-2">
                        <label class="form-label">Otros Detalles</label>
                        <textarea wire:model.lazy="other_details" class="form-control" placeholder="Detalles adicionales del proveedor" rows="3"></textarea>
                        @error('other_details')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="create_supplier()" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
</div>
