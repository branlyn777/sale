<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5>Categoría Producto</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button wire:click.prevent="showModalCategories()" type="button" class="btn btn-outline-primary">
                            {{-- <i class="bi bi-plus-lg"></i> --}}
                            Nueva Categor&Iacute;a
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha Creación</th>
                            <th scope="col">Fecha Actualización</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $c)
                            <tr>
                                <th class="text-center" scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    {{$c->name}}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($c->updated_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button onclick="asd()" type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->

    <!-- [ Modal ] start -->
    @include('livewire.inventories.categories.modal_categories')
    <!-- [ Modal ] end -->
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('show-modal-categorie', msg => {
                $('#categorie').modal('show')
            });

            window.livewire.on('hide-modal-categorie', msg => {
                $('#categorie').modal('hide')
            });

        });

      function asd()
      {
          Swal.fire(
          'The Internet?',
          'That thing is still around?',
          'info'
        )
      }
    </script>
@endsection