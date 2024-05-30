<div wire:ignore.self class="modal fade" id="cistern" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->cistern_id == 0)
                CREAR CISTERNA
                @else
                ACTUALIZAR CISTERNA
                @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Placa</label>
                        <input wire:model.lazy="plate" type="text" class="form-control">
                        @error('plate')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Chasis</label>
                        <input wire:model.lazy="chassis_number" type="text" class="form-control">
                        @error('chassis_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motor</label>
                        <input wire:model.lazy="engine" type="text" class="form-control">
                        @error('engine')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo de Ejes</label>
                        <input wire:model.lazy="axle_model" type="text" class="form-control">
                        @error('axle_model')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                @if($this->cistern_id == 0)
                    <button type="button" wire:click.prevent="create_cistern()" class="btn btn-secondary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_cistern()" class="btn btn-secondary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
