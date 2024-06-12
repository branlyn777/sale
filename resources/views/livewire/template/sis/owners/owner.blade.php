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
                                    <th scope="col">Código Propietario</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th class="text-center" scope="col">Numero de C.I.</th>
                                    <th class="text-center" scope="col">Numero de NIT</th>
                                    <th class="text-center" scope="col">Editar</th>
                                    <th class="text-center" scope="col">Eliminar</th>
                                </tr>                                
                            </thead>
                            <tbody>
                                @foreach($owners as $o)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($owners->currentpage() - 1) * $owners->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                            {{$o->owner_code}}
                                        </td>
                                        <td>
                                            {{$o->name}} {{$o->paternal_surname}} {{$o->maternal_surname}}
                                        </td>
                                        <td class="text-center">
                                            {{$o->ci_number}}
                                        </td>
                                        <td class="text-center">
                                            {{$o->nit_number}}
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalOwner({{ $o->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="check_owner({{ $o->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $owners->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            {{-- @include('livewire.template.sis.owners.modal_owner') --}}
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