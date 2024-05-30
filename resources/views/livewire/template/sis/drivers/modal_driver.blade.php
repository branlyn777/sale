<div wire:ignore.self class="modal fade" id="driver" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->cistern_id == 0)
                CREAR CONDUCTOR
                @else
                ACTUALIZAR CONDUCTOR
                @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input wire:model.lazy="name" type="text" class="form-control">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input wire:model.lazy="paternal_surname" type="text" class="form-control">
                            @error('paternal_surname')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido Materno</label>
                            <input wire:model.lazy="maternal_surname" type="text" class="form-control">
                            @error('maternal_surname')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Número de C.I.</label>
                            <input wire:model.lazy="ci_number" type="text" class="form-control">
                            @error('ci_number')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Número de Licencia</label>
                            <input wire:model.lazy="license_number" type="text" class="form-control">
                            @error('license_number')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Inicio</label>
                            <input wire:model.lazy="start_date" type="date" class="form-control">
                            @error('start_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Fin</label>
                            <input wire:model.lazy="end_date" type="date" class="form-control">
                            @error('end_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input wire:model.lazy="photo_path" type="file" class="form-control">
                        @error('photo_path')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ID de Cisterna Asignada</label>
                        <select wire:model="cistern_id" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            @foreach ($this->list_cisterns as $c)
                                <option value="{{ $c->id }}">Placa: {{ $c->plate }} Chasis: {{ $c->chassis_number }}</option>
                            @endforeach
                        </select>
                        @error('cistern_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                @if($this->driver_id == 0)
                    <button type="button" wire:click.prevent="create_driver()" class="btn btn-secondary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_driver()" class="btn btn-secondary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
