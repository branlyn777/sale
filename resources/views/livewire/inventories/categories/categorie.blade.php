<div>
    <!-- [ breadcrumb ] start -->
    {{-- <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Categoría Producto</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../navigation/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Sample Page</li>
              </ul>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- [ breadcrumb ] end -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <h5>CATEGORÍA PRODUCTO</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end">
                            <button wire:click.prevent="showModalCategories(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nueva Categor&Iacute;a
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label>Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar Categoría...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
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
                                @foreach($categories as $c)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($categories->currentpage() - 1) * $categories->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                            {{$c->name_category}}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($c->updated_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalCategories({{ $c->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="check_category({{ $c->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.inventories.categories.modal_categories')
        <!-- [ Modal ] end -->
    </div>
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar categoria producto
            window.livewire.on('show-modal-categorie', msg => {
                var categorieModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('categorie'));
                categorieModal.show();
            });
            // Oculta la ventana modal crear/actualizar categoria producto
            window.livewire.on('hide-modal-categorie', msg => {
                var categorieModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('categorie'));
                categorieModal.hide();
            });

            // Muestra una alerta
            window.livewire.on('alert-category', msg => {
                Swal.fire({
                    title: @this.alert.title,
                    text: @this.alert.text,
                    icon: @this.alert.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: @this.alert.confirmButtonText,
                    cancelButtonText: @this.alert.cancelButtonText,
                    }).then((result) => {
                    if (result.isConfirmed)
                    {
                        window.livewire.emit('deleteCategory')
                        Swal.close()
                    }
                })
            });
            // Muestra un mensaje de tipo toast arriba a la derecha
            window.livewire.on('toast', msg => {
                Swal.fire({
                    toast: true,
                    text: @this.toast.text,
                    showConfirmButton: false,
                    position: 'top-right',
                    timer: @this.toast.timer,
                    timerProgressBar: true,
                    icon: @this.toast.icon
                })
            });

        });
    </script>
@endsection