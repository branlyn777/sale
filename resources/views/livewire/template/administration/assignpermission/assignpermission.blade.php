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
                            <h5>ASIGNAR PERMISOS</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                            
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
                            <label>Roles</label>
                            <select wire:model="role_id" class="form-select">
                                <option value="select">Seleccionar</option>
                                @foreach ($this->list_roles as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
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
                                    <th class="text-center"scope="col">#</th>
                                    <th>Asignar</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Seccion</th>
                                    <th class="text-center" scope="col">Fecha de Creacion</th>
                                    <th class="text-center" scope="col">Fecha de Actualizacion</th>
                                </tr>                                
                            </thead>
                            <tbody>
                                @foreach($permissions as $p)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($permissions->currentpage() - 1) * $permissions->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;"
                                                    wire:change="syncPermission($event.target.checked, '{{ $p->name }}')"
                                                    id="p{{ $p->id }}" value="{{ $p->id }}"
                                                    {{ $p->checked ? 'checked' : '' }}
                                                >
                                            </div>
                                        </td>
                                        <td>
                                            {{ $p->name }}
                                        </td>
                                        <td>
                                            {{$p->section}}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y g:i A') }}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($p->updated_at)->format('d/m/Y g:i A') }}
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            {{-- @include('livewire.template.sis.$permission.modal_cistern') --}}
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
                        window.livewire.emit('deleteRole', msg.id)
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