<div class="pc-content">
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                        <h5>USUARIOS</h5>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                        <button wire:click.prevent="showModalUser(0)" type="button" class="btn btn-outline-primary">
                            <i class="bi bi-plus-lg"></i>
                            Nuevo Usuario
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
                            <input wire:model="search" type="text" class="form-control" placeholder="Buscar Usuario...">
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
                                <th scope="col">Nombre</th>
                                <th class="text-center" scope="col">Fecha Creación</th>
                                <th class="text-center" scope="col">Fecha Actualización</th>
                                <th class="text-center" scope="col">Editar</th>
                                <th class="text-center" scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                                <tr>
                                    <th class="text-center" scope="row">
                                        {{-- {{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }} --}}
                                    </th>
                                    <td>
                                        {{$u->name}}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($u->updated_at)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <button wire:click.prevent="showModalUser({{ $u->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button wire:click.prevent="check_user({{ $u->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
      </div>


      
        <!-- [ Modal ] start -->
        @include('livewire.template.administration.user.modal_user')
        <!-- [ Modal ] end -->



      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
  @section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar usuario producto
            window.livewire.on('show-modal-user', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('user'));
                modal.show();
            });
            // Oculta la ventana modal crear/actualizar usuario producto
            window.livewire.on('hide-modal-user', msg => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('user'));
                modal.hide();
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
                        window.livewire.emit('deleteUser', msg.id)
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