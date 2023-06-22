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
                        <button wire:click.prevent="showModalCategorie(0)" type="button" class="btn btn-outline-primary">
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
                            <input wire:model="search" type="text" class="form-control" placeholder="Buscar Categoría...">
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
                                        <button wire:click.prevent="showModalCategorie({{ $u->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button wire:click.prevent="check_category({{ $u->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
