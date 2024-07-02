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





                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Subir Imagen</h5>
                            </div>
                            <div class="card-body">
                                <div id="imagePreview" class="d-flex justify-content-center mt-3"></div>
                                <input type="file" class="form-control mt-3" id="imageUpload" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Placa</label>
                        <input wire:model.lazy="license_plate" type="text" class="form-control">
                        @error('license_plate')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">
                            <b>A. DATOS IDENTIFICACION</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Clase</label>
                        <input wire:model.lazy="class" type="text" class="form-control">
                        @error('class')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Número de Chasis</label>
                        <input wire:model.lazy="chassis_number" type="text" class="form-control">
                        @error('chassis_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Marca</label>
                        <input wire:model.lazy="mark" type="text" class="form-control">
                        @error('mark')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Modelo</label>
                        <input wire:model.lazy="model" type="text" class="form-control">
                        @error('model')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Tipo de Vehículo</label>
                        <input wire:model.lazy="vehicle_type" type="text" class="form-control">
                        @error('vehicle_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Servicio</label>
                        <input wire:model.lazy="service" type="text" class="form-control">
                        @error('service')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Subtipo de Vehículo</label>
                        <input wire:model.lazy="vehicle_subtype" type="text" class="form-control">
                        @error('vehicle_subtype')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Número de Motor</label>
                        <input wire:model.lazy="engine_number" type="text" class="form-control">
                        @error('engine_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">
                            <b>B. DATOS GENERALES</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tipo de Póliza</label>
                        <input wire:model.lazy="policy_type" type="text" class="form-control">
                        @error('policy_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Número de Póliza</label>
                        <input wire:model.lazy="policy_number" type="text" class="form-control">
                        @error('policy_number')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Fecha de Póliza</label>
                        <input wire:model.lazy="policy_date" type="date" class="form-control">
                        @error('policy_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Año Inicio Impuestos</label>
                        <input wire:model.lazy="tax_start_year" type="text" class="form-control">
                        @error('tax_start_year')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">País</label>
                        <input wire:model.lazy="country" type="text" class="form-control">
                        @error('country')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Procedencia</label>
                        <input wire:model.lazy="origin" type="text" class="form-control">
                        @error('origin')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Aduana Importación</label>
                        <input wire:model.lazy="customs_import" type="text" class="form-control">
                        @error('customs_import')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">

                    </div>
                </div>






                






                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">
                            <b>C. DATOS TECNICOS</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Cilindrada</label>
                        <input wire:model.lazy="displacement" type="text" class="form-control">
                        @error('displacement')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tipo de Chasis</label>
                        <input wire:model.lazy="chassis_type" type="text" class="form-control">
                        @error('chassis_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Tracción</label>
                        <input wire:model.lazy="traction" type="text" class="form-control">
                        @error('traction')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Tipo de Motor</label>
                        <input wire:model.lazy="motor_type" type="text" class="form-control">
                        @error('motor_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Número de Ruedas</label>
                        <input wire:model.lazy="number_of_wheels" type="text" class="form-control">
                        @error('number_of_wheels')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Motor Turbo</label>
                        <select wire:model.lazy="motor_turbo" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        @error('motor_turbo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Número de Puertas</label>
                        <input wire:model.lazy="number_of_doors" type="text" class="form-control">
                        @error('number_of_doors')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Peso</label>
                        <input wire:model.lazy="weight" type="text" class="form-control">
                        @error('weight')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Color</label>
                        <input wire:model.lazy="color" type="text" class="form-control">
                        @error('color')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Capacidad Remolque</label>
                        <input wire:model.lazy="towing_capacity" type="text" class="form-control">
                        @error('towing_capacity')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Número de Plazas</label>
                        <input wire:model.lazy="number_of_places" type="text" class="form-control">
                        @error('number_of_places')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Combustible</label>
                        <input wire:model.lazy="fuel" type="text" class="form-control">
                        @error('fuel')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Tipo de Carrocería</label>
                        <input wire:model.lazy="bodywork_type" type="text" class="form-control">
                        @error('bodywork_type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>









                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Observaciones</label>
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
                    <button type="button" wire:click.prevent="create_driver()" class="btn btn-secondary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_driver()" class="btn btn-secondary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
