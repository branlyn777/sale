<div class="pc-content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Proveedor</b>
                    </label>
                    <div class="input-group">
                        <select class="form-select">
                            <option value="">Anónimo</option>
                        </select>
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Sucursal</b>
                    </label>
                    <select class="form-select">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Almacén</b>
                    </label>
                    <select class="form-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    {{-- <h4>Productos</h4> --}}
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input wire:model="search" type="text" class="form-control" placeholder="Buscar Producto...">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>
                                        <th scope="row">
                                            {{ ($products->currentpage() - 1) * $products->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                        {{ $p->name_product }}
                                            <p class="text-muted text-sm">
                                                <button wire:click.prevent="cart_add()" class="btn btn-primary btn-sm">
                                                    +
                                                </button>
                                                {{ number_format($p->price, 2, ',', '.') }} Bs | Cantidad: 8
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    {{-- <h4>Shopping Cart</h4> --}}
                    <div class="input-group">
                        <h4>Carrito de Compras</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Total</th>
                                <th scope="col">Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th class="text-center" scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

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