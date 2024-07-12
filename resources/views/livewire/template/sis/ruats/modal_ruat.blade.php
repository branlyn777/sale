<div wire:ignore.self class="modal fade" id="ruat" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->ruat_id == 0)
                CREAR RUAT
                @else
                ACTUALIZAR RUAT
                @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Subir Imagen</b></label>
                        <input type="file" wire:model="image" class="form-control" id="imageUpload" accept="image/*">
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Subir Pdf</b></label>
                        <input type="file" wire:model="file" class="form-control" accept="application/pdf">
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0"><b>Placa</b></label>
                        <input wire:model.lazy="license_plate" type="text" class="form-control">
                        @error('license_plate')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label text-primary mb-0">
                            <b>A. DATOS IDENTIFICACION</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Clase</b></label>
                        <input wire:model.lazy="class" type="text" class="form-control">
                        @error('class')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Chasis</b></label>
                        <input wire:model.lazy="chassis_number" type="text" class="form-control">
                        @error('chassis_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Marca</b></label>
                        <input wire:model.lazy="mark" type="text" class="form-control">
                        @error('mark')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Modelo</b></label>
                        <input wire:model.lazy="model" type="text" class="form-control">
                        @error('model')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Tipo de Vehículo</b></label>
                        <input wire:model.lazy="vehicle_type" type="text" class="form-control">
                        @error('vehicle_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Servicio</b></label>
                        <input wire:model.lazy="service" type="text" class="form-control">
                        @error('service')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Subtipo de Vehículo</b></label>
                        <input wire:model.lazy="vehicle_subtype" type="text" class="form-control">
                        @error('vehicle_subtype')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Motor</b></label>
                        <input wire:model.lazy="engine_number" type="text" class="form-control">
                        @error('engine_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label text-primary mb-0">
                            <b>B. DATOS GENERALES</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Tipo de Póliza</b></label>
                        <input wire:model.lazy="policy_type" type="text" class="form-control">
                        @error('policy_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Póliza</b></label>
                        <input wire:model.lazy="policy_number" type="text" class="form-control">
                        @error('policy_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Fecha de Póliza</b></label>
                        <input wire:model.lazy="policy_date" type="date" class="form-control">
                        @error('policy_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Año Inicio Impuestos</b></label>
                        <input wire:model.lazy="tax_start_year" type="number" class="form-control">
                        @error('tax_start_year')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>País</b></label>
                        <input wire:model.lazy="country" type="text" class="form-control">
                        @error('country')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Procedencia</b></label>
                        <input wire:model.lazy="origin" type="text" class="form-control">
                        @error('origin')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Aduana Importación</b></label>
                        <input wire:model.lazy="customs_import" type="text" class="form-control">
                        @error('customs_import')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label text-primary mb-0">
                            <b>C. DATOS TECNICOS</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Cilindrada</b></label>
                        <input wire:model.lazy="displacement" type="number" step="0.01" class="form-control">
                        @error('displacement')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Tipo de Chasis</b></label>
                        <input wire:model.lazy="chassis_type" type="text" class="form-control">
                        @error('chassis_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Tracción</b></label>
                        <input wire:model.lazy="traction" type="text" class="form-control">
                        @error('traction')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Tipo de Motor</b></label>
                        <input wire:model.lazy="motor_type" type="text" class="form-control">
                        @error('motor_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Ruedas</b></label>
                        <input wire:model.lazy="number_of_wheels" type="number" class="form-control">
                        @error('number_of_wheels')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Motor Turbo</b></label>
                        <select wire:model.lazy="motor_turbo" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        @error('motor_turbo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Puertas</b></label>
                        <input wire:model.lazy="number_of_doors" type="number" class="form-control">
                        @error('number_of_doors')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Peso</b></label>
                        <input wire:model.lazy="weight" type="number" step="0.01" class="form-control">
                        @error('weight')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Número de Plazas</b></label>
                        <input wire:model.lazy="number_of_places" type="number" class="form-control">
                        @error('number_of_places')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Capacidad de Arrastre</b></label>
                        <input wire:model.lazy="towing_capacity" type="number" step="0.01" class="form-control">
                        @error('towing_capacity')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0"><b>Combustible</b></label>
                        <input wire:model.lazy="fuel" type="text" class="form-control">
                        @error('fuel')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0"><b>Color</b></label>
                        <input wire:model.lazy="color" type="text" class="form-control">
                        @error('color')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0"><b>Observaciones</b></label>
                        <textarea wire:model.lazy="observations" class="form-control"></textarea>
                        @error('observations')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                @if($this->ruat_id == 0)
                    <button wire:loading.remove type="button" wire:click.prevent="create_ruat()" class="btn btn-secondary">Crear</button>
                    <button wire:loading type="button" disabled class="btn btn-secondary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_ruat()" class="btn btn-secondary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
