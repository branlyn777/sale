<div wire:ignore.self class="modal fade" id="cistern" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                <!-- Datos Iniciales -->
                <div class="row">
                    <!-- Fecha -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Fecha</label>
                        <input wire:model.lazy="fecha" type="date" class="form-control">
                        @error('fecha')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Placa 1 -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Placa 1</label>
                        <input wire:model.lazy="placa_1" type="text" class="form-control">
                        @error('placa_1')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Placa 2 -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Placa 2</label>
                        <input wire:model.lazy="placa_2" type="text" class="form-control">
                        @error('placa_2')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Tarjeta de Operaciones -->
                <div class="mb-4">
                    <h5>TARJETA DE OPERACIONES</h5>
                    <div class="row">
                        <!-- Tracto -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tracto</label>
                            <input wire:model.lazy="tracto" type="text" class="form-control">
                            @error('tracto')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Cisterna -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cisterna</label>
                            <input wire:model.lazy="cisterna" type="text" class="form-control">
                            @error('Cisterna')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            
                <!-- Documentos -->
                <div class="mb-4">
                    <h5>DOCUMENTOS</h5>
                    <div class="row">
                        <!-- Ruat -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Ruat</label>
                            <select wire:model.lazy="ruat" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('ruat')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Certificado de Fabricación del Tanque -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Certificado de Fabricación del Tanque</label>
                            <select wire:model.lazy="certificado_de_fabricacion_del_tanque" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('certificado_de_fabricacion_del_tanque')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Póliza de Seguro -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Póliza de Seguro</label>
                            <select wire:model.lazy="poliza_de_seguro" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('poliza_de_seguro')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="row">
                        <!-- Certificado de Hermeticidad -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Certificado de Hermeticidad</label>
                            <select wire:model.lazy="certificado_hermeticidad" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('certificado_hermeticidad')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Tarjeta de Cubicación -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tarjeta de Cubicación</label>
                            <select wire:model.lazy="tarjeta_de_cubicacion" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('tarjeta_de_cubicacion')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- NIT -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">NIT</label>
                            <select wire:model.lazy="nit" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('nit')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Fotografías del Cisterna -->
                <div class="mb-4">
                    <h5>FOTOGRAFÍAS DEL CISTERNA</h5>
                    <div class="row">
                        <!-- Posterior -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Posterior</label>
                            <select wire:model.lazy="posterior" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('posterior')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Superior -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Superior</label>
                            <select wire:model.lazy="superior" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('superior')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lateral Izquierdo -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Lateral Izquierdo</label>
                            <select wire:model.lazy="lateral_izquierdo" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('lateral_izquierdo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Lateral Derecho -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Lateral Derecho</label>
                            <select wire:model.lazy="lateral_derecho" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('lateral_derecho')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Frontal con Equipos de Seguridad -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Frontal Equipos Seguridad</label>
                            <select wire:model.lazy="frontal_con_equipos_de_seguridad" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('frontal_con_equipos_de_seguridad')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Plaqueta Cisterna -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Plaqueta Cisterna</label>
                            <select wire:model.lazy="plaqueta_cisterna" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('plaqueta_cisterna')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Válvulas -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Foto Válvulas</label>
                            <select wire:model.lazy="foto_valvulas" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('foto_valvulas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Cubicadora -->
                <div class="mb-4">
                    <h5>CUBICADORA</h5>
                    <div class="row">
                        <!-- Plaqueta -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Plaqueta</label>
                            <select wire:model.lazy="plaqueta" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('plaqueta')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Precintos -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Precintos</label>
                            <select wire:model.lazy="precintos" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('precintos')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Stickers Aferición -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stickers Aferición</label>
                            <select wire:model.lazy="stickers_afericion" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('stickers_afericion')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Licencia y Listado Conductores -->
                <div class="mb-4">
                    <h5>LICENCIA Y LISTADO CONDUCTORES</h5>
                    <div class="row">
                        <!-- Licencia Conductor Principal -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Licencia Conductor Principal</label>
                            <select wire:model.lazy="licencia_conductor_principal" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('licencia_conductor_principal')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Licencia Conductor Reemplazo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Licencia Conductor Reemplazo</label>
                            <select wire:model.lazy="licencia_conductor_reemplazo" class="form-select">
                                <option value="falta">Falta</option>
                                <option value="corregir">Corregir</option>
                                <option value="ok">Ok</option>
                            </select>
                            @error('licencia_conductor_reemplazo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- RR PP -->
                <div class="mb-4">
                    <h5>RR PP</h5>
                    <div class="row">
                        <!-- Vigencia Poder -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Vigencia Poder</label>
                            <input wire:model.lazy="vigencia_poder" type="text" class="form-control">
                            @error('vigencia_poder')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>











                <!-- DATOS DEL SEMIRREMOLQUE -->
                <div class="mb-4">
                    <h5>DATOS DEL SEMIRREMOLQUE</h5>
                    <div class="row">
                        <!-- Marca -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Marca</label>
                            <input wire:model.lazy="marca" type="text" class="form-control">
                            @error('marca')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Clase -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clase</label>
                            <input wire:model.lazy="clase" type="text" class="form-control">
                            @error('clase')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Forma -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Forma</label>
                            <input wire:model.lazy="forma" type="text" class="form-control">
                            @error('forma')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Capacidad Compartimientos 1 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Compartimiento Litros 1</label>
                            <input wire:model.lazy="compartimiento_litros_1" type="number" class="form-control">
                            @error('compartimiento_litros_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Capacidad Compartimientos 2 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Compartimiento Litros 2</label>
                            <input wire:model.lazy="compartimiento_litros_2" type="number" class="form-control">
                            @error('compartimiento_litros_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Compartimiento Galones 1 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Compartimiento Galones 1</label>
                            <input wire:model.lazy="compartimiento_galones_1" type="number" class="form-control">
                            @error('compartimiento_galones_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Compartimiento Galones 2 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Compartimiento Galones 2</label>
                            <input wire:model.lazy="compartimiento_galones_2" type="number" class="form-control">
                            @error('compartimiento_galones_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Norma de Fabricación -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Norma de Fabricación</label>
                            <input wire:model.lazy="norma_de_fabricacion" type="text" class="form-control">
                            @error('norma_de_fabricacion')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Número de Rompeolas -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número de Rompeolas</label>
                            <input wire:model.lazy="numero_de_rompeolas" type="number" class="form-control">
                            @error('numero_de_rompeolas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Presión de Diseño -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Presión de Diseño</label>
                            <input wire:model.lazy="presion_de_diseno" type="number" step="0.01" class="form-control">
                            @error('presion_de_diseno')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Presión de Prueba -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Presión de Prueba</label>
                            <input wire:model.lazy="presion_de_prueba" type="number" step="0.01" class="form-control">
                            @error('presion_de_prueba')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <!-- Compartimiento 1 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Compartimiento 1</label>
                            <input wire:model.lazy="compartimiento_1" type="number" class="form-control">
                            @error('compartimiento_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Compartimiento 2 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Compartimiento 2</label>
                            <input wire:model.lazy="compartimiento_2" type="number" class="form-control">
                            @error('compartimiento_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Largo 1 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Largo 1</label>
                            <input wire:model.lazy="largo_1" type="number" step="0.01" class="form-control">
                            @error('largo_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Largo 2 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Largo 2</label>
                            <input wire:model.lazy="largo_2" type="number" step="0.01" class="form-control">
                            @error('largo_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Ancho 1 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Ancho 1</label>
                            <input wire:model.lazy="ancho_1" type="number" step="0.01" class="form-control">
                            @error('ancho_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Ancho 2 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Ancho 2</label>
                            <input wire:model.lazy="ancho_2" type="number" step="0.01" class="form-control">
                            @error('ancho_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Alto 1 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Alto 1</label>
                            <input wire:model.lazy="alto_1" type="number" step="0.01" class="form-control">
                            @error('alto_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Alto 2 -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Alto 2</label>
                            <input wire:model.lazy="alto_2" type="number" step="0.01" class="form-control">
                            @error('alto_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Distancia entre ejes 1 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Distancia entre ejes 1</label>
                            <input wire:model.lazy="distancia_entre_ejes_1" type="number" step="0.01" class="form-control">
                            @error('distancia_entre_ejes_1')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Distancia entre ejes 2 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Distancia entre ejes 2</label>
                            <input wire:model.lazy="distancia_entre_ejes_2" type="number" step="0.01" class="form-control">
                            @error('distancia_entre_ejes_2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Tara -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tara</label>
                            <input wire:model.lazy="tara" type="number" step="0.01" class="form-control">
                            @error('tara')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Corrosion -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Corrosion</label>
                            <input wire:model.lazy="corrosion" type="number" step="0.01" class="form-control">
                            @error('corrosion')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    


                    <div class="row">
                        <!-- Valvulas de descarga -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Válvulas de descarga</label>
                            <input wire:model.lazy="valvulas_de_descarga" type="number" class="form-control">
                            @error('valvulas_de_descarga')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tapas externas con válvulas de admisión o escotillas -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tapas externas con válvulas de admisión o escotillas</label>
                            <input wire:model.lazy="tapas_externas_con_valvulas_de_admision_o_escotillas" type="text" class="form-control">
                            @error('tapas_externas_con_valvulas_de_admision_o_escotillas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Sistemas de recuperación de gases o vapores -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sistemas de recuperación de gases o vapores</label>
                            <select wire:model.lazy="sistemas_de_recuperacion_de_gases_o_vapores" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                            @error('sistemas_de_recuperacion_de_gases_o_vapores')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Sistema de sensor de llenado o sobrellenado -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sistema de sensor de llenado o sobrellenado</label>
                            <select wire:model.lazy="sistema_de_sensor_de_llenado_o_sobrellenado" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                            @error('sistema_de_sensor_de_llenado_o_sobrellenado')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Sistema de puesta a tierra -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sistema de puesta a tierra</label>
                            <select wire:model.lazy="sistema_de_puesta_a_tierra" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                            @error('sistema_de_puesta_a_tierra')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Sistema de carga por fondo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sistema de carga por fondo</label>
                            <select wire:model.lazy="sistema_de_carga_por_fondo" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                            @error('sistema_de_carga_por_fondo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>DATOS DEL CHASIS</h5>
                    <div class="row">
                        <!-- Fecha de fabricación -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha de fabricación</label>
                            <input wire:model.lazy="fecha_de_fabricacion" type="date" class="form-control">
                            @error('fecha_de_fabricacion')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Número de chasis -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de chasis</label>
                            <input wire:model.lazy="numero_de_chasis" type="text" class="form-control">
                            @error('numero_de_chasis')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Número de serie -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de serie</label>
                            <input wire:model.lazy="numero_de_serie" type="text" class="form-control">
                            @error('numero_de_serie')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <!-- Número de ejes -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Número de ejes</label>
                            <input wire:model.lazy="numero_de_ejes" type="number" class="form-control">
                            @error('numero_de_ejes')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Número de llantas -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Número de llantas</label>
                            <input wire:model.lazy="numero_de_llantas" type="number" class="form-control">
                            @error('numero_de_llantas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Material -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Material</label>
                            <input wire:model.lazy="material" type="text" class="form-control">
                            @error('material')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tipo de soldadura A -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Tipo de soldadura A</label>
                            <input wire:model.lazy="tipo_de_soldadura_a" type="text" class="form-control">
                            @error('tipo_de_soldadura_a')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <!-- Color cisterna -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Color cisterna</label>
                            <input wire:model.lazy="color_cisterna" type="text" class="form-control">
                            @error('color_cisterna')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tipo de soldadura B -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipo de soldadura B</label>
                            <input wire:model.lazy="tipo_de_soldadura_b" type="text" class="form-control">
                            @error('tipo_de_soldadura_b')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Conductor de descarga -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Conductor de descarga</label>
                            <input wire:model.lazy="conductor_de_descarga" type="text" class="form-control">
                            @error('conductor_de_descarga')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <!-- Cabeza -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cabeza</label>
                            <input wire:model.lazy="cabeza" type="number" step="0.01" class="form-control">
                            @error('cabeza')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tapas -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tapas</label>
                            <input wire:model.lazy="tapas" type="number" step="0.01" class="form-control">
                            @error('tapas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Manto -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Manto</label>
                            <input wire:model.lazy="manto" type="number" step="0.01" class="form-control">
                            @error('manto')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <!-- Antivuelque -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Antivuelque</label>
                            <input wire:model.lazy="antivuelque" type="number" step="0.01" class="form-control">
                            @error('antivuelque')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Número de hojas -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de hojas</label>
                            <input wire:model.lazy="numero_de_hojas" type="number" class="form-control">
                            @error('numero_de_hojas')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                




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
