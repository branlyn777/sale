@section('css')
    <style>
        /* Estilos para los inputs de costo, precio y cantidad */
        .style-input-sm {
            width: 100px;
        }
        .style-input {
            width: 110px;
        }

        /* Quitar Spinner Input */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Estilos para las tablas con thead estáticas */
        .table-static {
            height: 500px;
        }
        .table-static table thead {
            position: -webkit-sticky;
            /* Safari... */
            position: sticky;
            top: 0;
            left: 0;
        }
    </style>
@endsection
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    {{-- <div class="page-header mb-3">
        <div class="page-block">
            <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                <h5 class="m-b-10">Comprar</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../navigation/index.html">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Inventarios</a></li>
                    <li class="breadcrumb-item" aria-current="page">Comprar</li>
                </ul>
            </div>
            </div>
        </div>
    </div> --}}
    <!-- [ breadcrumb ] end -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Proveedor</b>
                    </label>
                    <div class="input-group">
                        <select wire:model="supplier_id" class="form-select">
                            @foreach( $this->list_suppliers as $b )
                                <option value="{{ $b->id }}">{{ $b->name_supplier }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" wire:click="$emit('show-modal-supplier')">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Sucursal</b>
                    </label>
                    <select wire:model="branch_id" class="form-select">
                        <option value="0">Seleccionar</option>
                        @foreach( $this->list_branches as $b )
                            <option value="{{ $b->id }}">{{ $b->name_branch }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    @if ($this->branch_id > 0)
                        <label>
                            <b>Almacén</b>
                        </label>
                        <select wire:model="warehouse_id" class="form-select">
                            <option value="0">Seleccionar</option>
                            @foreach($this->list_warehouses as $w)
                            <option value="{{ $w->id }}">{{ $w->name_warehouse }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label>
                                <b>Cantidad</b>
                                <h2>{{ $total_items }}</h2>
                            </label>
                        </div>
                        <div class="col-6">
                            <label>
                                <b>Dinero</b>
                                <h2>{{ number_format($total_money, 2, ',', '.') }} Bs</h2>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body">

                    <div class="input-group">
                        <input wire:model="search" type="text" class="form-control" placeholder="Buscar Producto...">
                        <button class="btn btn-primary" wire:click="$emit('show-modal-supplier')">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <div class="table-responsive table-static">
                        @if (strlen($this->search) > 0)
                            <table class="table table-hover">
                                <thead class="bg-white">
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
                                                    <button wire:click.prevent="cart_add({{ $p->id }})" class="">
                                                        +
                                                    </button>
                                                    {{ number_format($p->price, 2, ',', '.') }} Bs | Cantidad: 8
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                            
                            </div>
                        @endif
                    </div>
                    @if (strlen($this->search) > 0)
                        {{ $products->links() }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4>Carrito de Compras</h4>
                    </div>
                    <div class="table-responsive table-static">
                        <table class="table table-hover">
                            <thead class="bg-white">
                              <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="text-center">Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($this->shoppingCart->sortBy('created_at') as $c)
                                <tr>
                                    <th class="text-center" scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $c['name_product'] }}
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group style-input-sm">
                                            <input type="number" class="form-control" value="{{ $c['quantity'] }}">
                                            <span class="input-group-text">
                                                Uds
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group style-input">
                                            <input type="number" class="form-control" value="{{ $c['cost'] }}">
                                            <span class="input-group-text">
                                                Bs
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group style-input">
                                            <input type="number" class="form-control" value="{{ $c['price'] }}">
                                            <span class="input-group-text">
                                                Bs
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($c['quantity'] * $c['cost'], 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="cart_add({{ $c['id'] }})">
                                               +
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                -
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm" wire:click.prevent="cart_delete({{ $c['id'] }})">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                          </div>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Modal ] start -->
    @include('livewire.template.inventory.buy.modal_supplier')
    <!-- [ Modal ] end -->
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear/actualizar categoria producto
            window.livewire.on('show-modal-supplier', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('supplier'));
                supplierModal.show();
            });
            // Oculta la ventana modal crear/actualizar categoria producto
            window.livewire.on('hide-modal-supplier', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('supplier'));
                supplierModal.hide();
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