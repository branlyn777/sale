<div wire:ignore.self class="modal fade" id="ruat-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">DETALLE RUAT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">




                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <h3>Imagen</h3>
                        <div class="imagePreview">
                            <img src="{{ asset('storage/' . $d_image) }}" class="img-thumbnail" alt="Imagen con Miniatura">
                        </div>
                    </div>
                </div>

                @if($d_file)

                {{-- <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <button wire:click='downloadaaa({{ "sdf" }})'>
                            Descargar Pdf
                        </button>
                    </div>
                </div> --}}
                @endif
                




            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label"><b>Placa:</b></label>
                        <label>{{ $d_license_plate }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label">
                            <b>A. DATOS IDENTIFICACION</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Clase:</b></label>
                        <label>{{ $d_class }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Número de Chasis:</b></label>
                        <label>{{ $d_chassis_number }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Marca:</b></label>
                        <label>{{ $d_mark }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Modelo:</b></label>
                        <label>{{ $d_model }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Tipo de Vehículo:</b></label>
                        <label>{{ $d_vehicle_type }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Servicio:</b></label>
                        <label>{{ $d_service }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Subtipo de Vehículo:</b></label>
                        <label>{{ $d_vehicle_subtype }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Número de Motor:</b></label>
                        <label>{{ $d_engine_number }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label">
                            <b>B. DATOS GENERALES</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Tipo de Póliza:</b></label>
                        <label>{{ $d_policy_type }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Número de Póliza:</b></label>
                        <label>{{ $d_policy_number }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Fecha de Póliza:</b></label>
                        <label>{{ $d_policy_date }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Año Inicio Impuestos:</b></label>
                        <label>{{ $d_tax_start_year }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>País:</b></label>
                        <label>{{ $d_country }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Procedencia:</b></label>
                        <label>{{ $d_origin }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Aduana Importación:</b></label>
                        <label>{{ $d_customs_import }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label">
                            <b>C. DATOS TECNICOS</b>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Cilindrada:</b></label>
                        <label>{{ $d_displacement }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Tipo de Chasis:</b></label>
                        <label>{{ $d_chassis_type }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Tracción:</b></label>
                        <label>{{ $d_traction }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Tipo de Motor:</b></label>
                        <label>{{ $d_motor_type }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Número de Ruedas:</b></label>
                        <label>{{ $d_number_of_wheels }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Motor Turbo:</b></label>
                        <label>{{ $d_motor_turbo == 1 ? 'Sí' : 'No' }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Número de Puertas:</b></label>
                        <label>{{ $d_number_of_doors }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Peso:</b></label>
                        <label>{{ $d_weight }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Número de Plazas:</b></label>
                        <label>{{ $d_number_of_places }}</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><b>Capacidad de Arrastre:</b></label>
                        <label>{{ $d_towing_capacity }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-6">
                        <label class="form-label"><b>Combustible:</b></label>
                        <label>{{ $d_fuel }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label"><b>Color:</b></label>
                        <label>{{ $d_color }}</label>
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-12">
                        <label class="form-label"><b>Observaciones:</b></label>
                        <label>{{ $d_observations }}</label>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
