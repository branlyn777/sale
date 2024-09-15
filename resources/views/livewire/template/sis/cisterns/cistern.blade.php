<div class="pc-content">
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <h5>CISTERNAS</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                            <button wire:click.prevent="showModalCistern(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nueva Cisterna
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <label>Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center">

                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center">
                            
                        </div>
                    </div>
                </div>
                <span wire:loading.delay.longer class="loader"></span>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Placa 1</th>
                                    <th scope="col">Placa 2</th>
                                    <th scope="col">Tracto</th>
                                    <th scope="col">Cisterna</th>
                                    <th scope="col">RUAT</th>
                                    <th scope="col">Certificado de Fabricación del Tanque</th>
                                    <th scope="col">Póliza de Seguro</th>
                                    <th scope="col">Certificado de Hermeticidad</th>
                                    <th scope="col">Tarjeta de Cubicación</th>
                                    <th scope="col">NIT</th>
                                    <th scope="col">Posterior</th>
                                    <th scope="col">Superior</th>
                                    <th scope="col">Lateral Izquierdo</th>
                                    <th scope="col">Lateral Derecho</th>
                                    <th scope="col">Frontal con Equipos de Seguridad</th>
                                    <th scope="col">Plaqueta Cisterna</th>
                                    <th scope="col">Foto Válvulas</th>
                                    <th scope="col">Plaqueta</th>
                                    <th scope="col">Precintos</th>
                                    <th scope="col">Stickers Aferición</th>
                                    <th scope="col">Licencia Conductor Principal</th>
                                    <th scope="col">Licencia Conductor Reemplazo</th>
                                    <th scope="col">Vigencia Poder</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Clase</th>
                                    <th scope="col">Forma</th>
                                    <th scope="col">Compartimiento Litros 1</th>
                                    <th scope="col">Compartimiento Litros 2</th>
                                    <th scope="col">Compartimiento Galones 1</th>
                                    <th scope="col">Compartimiento Galones 2</th>
                                    <th scope="col">Norma de Fabricación</th>
                                    <th scope="col">Número de Rompeolas</th>
                                    <th scope="col">Presión de Diseño</th>
                                    <th scope="col">Presión de Prueba</th>
                                    <th scope="col">Compartimiento 1</th>
                                    <th scope="col">Compartimiento 2</th>
                                    <th scope="col">Largo 1</th>
                                    <th scope="col">Largo 2</th>
                                    <th scope="col">Ancho 1</th>
                                    <th scope="col">Ancho 2</th>
                                    <th scope="col">Alto 1</th>
                                    <th scope="col">Alto 2</th>
                                    <th scope="col">Distancia entre Ejes 1</th>
                                    <th scope="col">Distancia entre Ejes 2</th>
                                    <th scope="col">Tara</th>
                                    <th scope="col">Corrosión</th>
                                    <th scope="col">Válvulas de Descarga</th>
                                    <th scope="col">Tapas Externas con Válvulas de Admisión o Escotillas</th>
                                    <th scope="col">Sistemas de Recuperación de Gases o Vapores</th>
                                    <th scope="col">Sistema de Sensor de Llenado o Sobrellenado</th>
                                    <th scope="col">Sistema de Puesta a Tierra</th>
                                    <th scope="col">Sistema de Carga por Fondo</th>
                                    <th scope="col">Fecha de Fabricación</th>
                                    <th scope="col">Número de Chasis</th>
                                    <th scope="col">Número de Serie</th>
                                    <th scope="col">Número de Ejes</th>
                                    <th scope="col">Número de Llantas</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Tipo de Soldadura A</th>
                                    <th scope="col">Color Cisterna</th>
                                    <th scope="col">Tipo de Soldadura B</th>
                                    <th scope="col">Conductor de Descarga</th>
                                    <th scope="col">Cabeza</th>
                                    <th scope="col">Tapas</th>
                                    <th scope="col">Manto</th>
                                    <th scope="col">Antivuelque</th>
                                    <th scope="col">Número de Hojas</th>
                                    <th class="text-center" scope="col">Editar</th>
                                    <th class="text-center" scope="col">Eliminar</th>
                                </tr>
                            </thead>                                                   
                            <tbody>
                                @foreach($cisternas as $c)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($cisternas->currentPage() - 1) * $cisternas->perPage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ \Carbon\Carbon::parse($c->fecha)->format('d/m/Y') }}</td>
                                        <td>{{ $c->placa_1 }}</td>
                                        <td>{{ $c->placa_2 }}</td>
                                        <td>{{ $c->tracto }}</td>
                                        <td>{{ $c->cisterna }}</td>
                                        <td>{{ $c->ruat ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->certificado_de_fabricacion_del_tanque ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->poliza_de_seguro }}</td>
                                        <td>{{ $c->certificado_hermeticidad }}</td>
                                        <td>{{ $c->tarjeta_de_cubicacion }}</td>
                                        <td>{{ $c->nit }}</td>
                                        <td>{{ $c->posterior ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->superior ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->lateral_izquierdo ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->lateral_derecho ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->frontal_con_equipos_de_seguridad ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->plaqueta_cisterna ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->foto_valvulas ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->plaqueta ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->precintos ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->stickers_afericion ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->licencia_conductor_principal ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->licencia_conductor_reemplazo ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->vigencia_poder }}</td>
                                        <td>{{ $c->marca }}</td>
                                        <td>{{ $c->clase }}</td>
                                        <td>{{ $c->forma }}</td>
                                        <td>{{ $c->compartimiento_litros_1 }}</td>
                                        <td>{{ $c->compartimiento_litros_2 }}</td>
                                        <td>{{ $c->compartimiento_galones_1 }}</td>
                                        <td>{{ $c->compartimiento_galones_2 }}</td>
                                        <td>{{ $c->norma_de_fabricacion }}</td>
                                        <td>{{ $c->numero_de_rompeolas }}</td>
                                        <td>{{ $c->presion_de_diseno }}</td>
                                        <td>{{ $c->presion_de_prueba }}</td>
                                        <td>{{ $c->compartimiento_1 }}</td>
                                        <td>{{ $c->compartimiento_2 }}</td>
                                        <td>{{ $c->largo_1 }}</td>
                                        <td>{{ $c->largo_2 }}</td>
                                        <td>{{ $c->ancho_1 }}</td>
                                        <td>{{ $c->ancho_2 }}</td>
                                        <td>{{ $c->alto_1 }}</td>
                                        <td>{{ $c->alto_2 }}</td>
                                        <td>{{ $c->distancia_entre_ejes_1 }}</td>
                                        <td>{{ $c->distancia_entre_ejes_2 }}</td>
                                        <td>{{ $c->tara }}</td>
                                        <td>{{ $c->corrosion }}</td>
                                        <td>{{ $c->valvulas_de_descarga }}</td>
                                        <td>{{ $c->tapas_externas_con_valvulas_de_admision_o_escotillas ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->sistemas_de_recuperacion_de_gases_o_vapores ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->sistema_de_sensor_de_llenado_o_sobrellenado ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->sistema_de_puesta_a_tierra ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->sistema_de_carga_por_fondo ? 'Sí' : 'No' }}</td>
                                        <td>{{ $c->fecha_de_fabricacion }}</td>
                                        <td>{{ $c->numero_de_chasis }}</td>
                                        <td>{{ $c->numero_de_serie }}</td>
                                        <td>{{ $c->numero_de_ejes }}</td>
                                        <td>{{ $c->numero_de_llantas }}</td>
                                        <td>{{ $c->material }}</td>
                                        <td>{{ $c->tipo_de_soldadura_a }}</td>
                                        <td>{{ $c->color_cisterna }}</td>
                                        <td>{{ $c->tipo_de_soldadura_b }}</td>
                                        <td>{{ $c->conductor_de_descarga }}</td>
                                        <td>{{ $c->cabeza }}</td>
                                        <td>{{ $c->tapas }}</td>
                                        <td>{{ $c->manto }}</td>
                                        <td>{{ $c->antivuelque }}</td>
                                        <td>{{ $c->numero_de_hojas }}</td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalCistern({{ $c->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="confirm({{ $c->id }}, 'Placa: {{ $c->placa_1 }}', '¿Está seguro de eliminar?' ,'warning', 'Sí, eliminar')" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                                                        
                        </table>
                    </div>
                    
                    {{ $cisternas->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.sis.cisterns.modal_cistern')
        <!-- [ Modal ] end -->
    </div>
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar categoria producto
            window.livewire.on('show-modal-cistern', msg => {
                var cisternModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('cistern'));
                cisternModal.show();
            });
            // Oculta la ventana modal crear/actualizar categoria producto
            window.livewire.on('hide-modal-cistern', msg => {
                var cisternModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('cistern'));
                cisternModal.hide();
            });

            // Muestra una alerta
            window.livewire.on('alert', msg => {
                Swal.fire({
                    title: msg.title,
                    text: msg.text,
                    icon: msg.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: msg.confirmButtonText,
                    cancelButtonText: msg.cancelButtonText,
                    }).then((result) => {
                    if (result.isConfirmed)
                    {
                        window.livewire.emit('deleteCistern', msg.id)
                        Swal.close()
                    }
                })
            });
            // Muestra un mensaje de tipo toast arriba a la derecha
            window.livewire.on('toast', msg => {
                Swal.fire({
                    toast: true,
                    text: msg.text,
                    showConfirmButton: false,
                    position: 'top-right',
                    timer: msg.timer,
                    timerProgressBar: true,
                    icon: msg.icon
                })
            });

        });
    </script>
@endsection