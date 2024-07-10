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

                {{-- <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Subir Imagen</h5>
                            </div>
                            <div class="card-body">
                                <div id="imagePreview" class="d-flex justify-content-center"></div>
                                <input type="file" wire:model="image" class="form-control" id="imageUpload" accept="image/*">
                            </div>
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> --}}
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Subir Imagen</label>
                        <input type="file" wire:model="image" class="form-control" id="imageUpload" accept="image/*">
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Subir Pdf</label>
                        <input type="file" wire:model="file" class="form-control" accept="application/pdf">
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">Placa</label>
                        <input wire:model.lazy="license_plate" type="text" class="form-control">
                        @error('license_plate')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">
                            <b>A. DATOS IDENTIFICACION</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Clase</label>
                        <input wire:model.lazy="class" type="text" class="form-control">
                        @error('class')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Número de Chasis</label>
                        <input wire:model.lazy="chassis_number" type="text" class="form-control">
                        @error('chassis_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Marca</label>
                        <input wire:model.lazy="mark" type="text" class="form-control">
                        @error('mark')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Modelo</label>
                        <input wire:model.lazy="model" type="text" class="form-control">
                        @error('model')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Tipo de Vehículo</label>
                        <input wire:model.lazy="vehicle_type" type="text" class="form-control">
                        @error('vehicle_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Servicio</label>
                        <input wire:model.lazy="service" type="text" class="form-control">
                        @error('service')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Subtipo de Vehículo</label>
                        <input wire:model.lazy="vehicle_subtype" type="text" class="form-control">
                        @error('vehicle_subtype')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Número de Motor</label>
                        <input wire:model.lazy="engine_number" type="text" class="form-control">
                        @error('engine_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">
                            <b>B. DATOS GENERALES</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Tipo de Póliza</label>
                        <input wire:model.lazy="policy_type" type="text" class="form-control">
                        @error('policy_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Número de Póliza</label>
                        <input wire:model.lazy="policy_number" type="text" class="form-control">
                        @error('policy_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Fecha de Póliza</label>
                        <input wire:model.lazy="policy_date" type="date" class="form-control">
                        @error('policy_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Año Inicio Impuestos</label>
                        <input wire:model.lazy="tax_start_year" type="number" class="form-control">
                        @error('tax_start_year')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">País</label>
                        <input wire:model.lazy="country" type="text" class="form-control">
                        @error('country')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Procedencia</label>
                        <input wire:model.lazy="origin" type="text" class="form-control">
                        @error('origin')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Aduana Importación</label>
                        <input wire:model.lazy="customs_import" type="text" class="form-control">
                        @error('customs_import')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">
                            <b>C. DATOS TECNICOS</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Cilindrada</label>
                        <input wire:model.lazy="displacement" type="number" step="0.01" class="form-control">
                        @error('displacement')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Tipo de Chasis</label>
                        <input wire:model.lazy="chassis_type" type="text" class="form-control">
                        @error('chassis_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Tracción</label>
                        <input wire:model.lazy="traction" type="text" class="form-control">
                        @error('traction')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Tipo de Motor</label>
                        <input wire:model.lazy="motor_type" type="text" class="form-control">
                        @error('motor_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Número de Ruedas</label>
                        <input wire:model.lazy="number_of_wheels" type="number" class="form-control">
                        @error('number_of_wheels')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Motor Turbo</label>
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
                        <label class="form-label mb-0">Número de Puertas</label>
                        <input wire:model.lazy="number_of_doors" type="number" class="form-control">
                        @error('number_of_doors')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Peso</label>
                        <input wire:model.lazy="weight" type="number" step="0.01" class="form-control">
                        @error('weight')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Número de Plazas</label>
                        <input wire:model.lazy="number_of_places" type="number" class="form-control">
                        @error('number_of_places')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0">Capacidad de Arrastre</label>
                        <input wire:model.lazy="towing_capacity" type="number" step="0.01" class="form-control">
                        @error('towing_capacity')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label mb-0">Combustible</label>
                        <input wire:model.lazy="fuel" type="text" class="form-control">
                        @error('fuel')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">Color</label>
                        <input wire:model.lazy="color" type="text" class="form-control">
                        @error('color')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label mb-0">Observaciones</label>
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
                    <button type="button" wire:click.prevent="create_ruat()" class="btn btn-secondary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_ruat()" class="btn btn-secondary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
