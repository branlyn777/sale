@section('css')

<style>
    #imagePreview img {
        max-width: 100%;
        max-height: 300px;
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 5px;
    }
</style>

@endsection
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
                            <h5>RUAT</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                            <button wire:click.prevent="showModalRuat(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nuevo Ruat
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
                            <label>Estado</label>
                            <select wire:model="status" class="form-select">
                                <option value="active">Activos</option>
                                <option value="inactive">Inactivos</option>
                            </select>
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
                                    <th class="text-center" scope="col">Placa</th>
                                    <th class="text-center" scope="col">Clase</th>
                                    <th class="text-center" scope="col">Marca</th>
                                    <th class="text-center" scope="col">Tipo Vehículo</th>
                                    <th class="text-center" scope="col">Subtipo Vehículo</th>
                                    <th class="text-center" scope="col">Número Motor</th>
                                    <th class="text-center" scope="col">Número Chasis</th>
                                    <th class="text-center" scope="col">Modelo</th>
                                    <th class="text-center" scope="col">Servicio</th>
                                    <th class="text-center" scope="col">Tipo Póliza</th>
                                    <th class="text-center" scope="col">Fecha Póliza</th>
                                    <th class="text-center" scope="col">País</th>
                                    <th class="text-center" scope="col">Aduana Importación</th>
                                    <th class="text-center" scope="col">Número de Póliza</th>
                                    <th class="text-center" scope="col">Año Inicio Impuestos</th>
                                    <th class="text-center" scope="col">Procedencia</th>
                                    <th class="text-center" scope="col">Cilindrada</th>
                                    <th class="text-center" scope="col">Tracción</th>
                                    <th class="text-center" scope="col">Número Ruedas</th>
                                    <th class="text-center" scope="col">Número Puertas</th>
                                    <th class="text-center" scope="col">Color</th>
                                    <th class="text-center" scope="col">Número Plazas</th>
                                    <th class="text-center" scope="col">Combustible</th>
                                    <th class="text-center" scope="col">Tipo Carrocería</th>
                                    <th class="text-center" scope="col">Tipo Chasis</th>
                                    <th class="text-center" scope="col">Tipo Motor</th>
                                    <th class="text-center" scope="col">Motor Turbo</th>
                                    <th class="text-center" scope="col">Peso</th>
                                    <th class="text-center" scope="col">Capacidad Arrastre</th>
                                    <th class="text-center" scope="col">Observaciones</th>
                                    <th class="text-center" scope="col">Estado</th>
                                    <th class="text-center" scope="col">Editar</th>
                                    <th class="text-center" scope="col">Eliminar</th>
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach($ruats as $r)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($ruats->currentpage() - 1) * $ruats->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td class="text-center">{{ $r->class }}</td>
                                        <td class="text-center">{{ $r->mark }}</td>
                                        <td class="text-center">{{ $r->vehicle_type }}</td>
                                        <td class="text-center">{{ $r->vehicle_subtype }}</td>
                                        <td class="text-center">{{ $r->engine_number }}</td>
                                        <td class="text-center">{{ $r->chassis_number }}</td>
                                        <td class="text-center">{{ $r->model }}</td>
                                        <td class="text-center">{{ $r->service }}</td>
                                        <td class="text-center">{{ $r->license_plate }}</td>
                                        <td class="text-center">{{ $r->policy_type }}</td>
                                        <td class="text-center">{{ $r->policy_date }}</td>
                                        <td class="text-center">{{ $r->country }}</td>
                                        <td class="text-center">{{ $r->customs_import }}</td>
                                        <td class="text-center">{{ $r->policy_number }}</td>
                                        <td class="text-center">{{ $r->tax_start_year }}</td>
                                        <td class="text-center">{{ $r->origin }}</td>
                                        <td class="text-center">{{ $r->displacement }}</td>
                                        <td class="text-center">{{ $r->traction }}</td>
                                        <td class="text-center">{{ $r->number_of_wheels }}</td>
                                        <td class="text-center">{{ $r->number_of_doors }}</td>
                                        <td class="text-center">{{ $r->color }}</td>
                                        <td class="text-center">{{ $r->number_of_places }}</td>
                                        <td class="text-center">{{ $r->fuel }}</td>
                                        <td class="text-center">{{ $r->bodywork_type }}</td>
                                        <td class="text-center">{{ $r->chassis_type }}</td>
                                        <td class="text-center">{{ $r->motor_type }}</td>
                                        <td class="text-center">{{ $r->motor_turbo ? 'Sí' : 'No' }}</td>
                                        <td class="text-center">{{ $r->weight }}</td>
                                        <td class="text-center">{{ $r->towing_capacity }}</td>
                                        <td class="text-center">{{ $r->observations }}</td>
                                        <td class="text-center">{{ $r->status }}</td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalEdit({{ $r->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="confirmDelete({{ $r->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    
                    {{ $ruats->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.sis.ruats.modal_ruat')
        <!-- [ Modal ] end -->
    </div>
</div>
@section('javascript')
    
    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Previsualización de la imagen">`;
                };

                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar ruat
            window.livewire.on('show-modal-ruat', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat'));
                ruatModal.show();
            });
            // Oculta la ventana modal crear/actualizar ruat
            window.livewire.on('hide-modal-ruat', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat'));
                ruatModal.hide();
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