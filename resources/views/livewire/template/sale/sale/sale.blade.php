@section('css')
    <style>
        /* Estilos para los inputs de precio y cantidad */
        .style-input-sm {
            width: 100px;
        }
        .style-input {
            width: 110px;
        }

        /* Estilos para quitar el spinner de los input tipo number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-clear-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
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
        /* Estilos para el Tooltip */
        .tooltip-container {
            cursor: pointer;
            position: relative;
            display: inline-block;
        }

        .tooltip {
            opacity: 0;
            z-index: 99;
            color: #ffffff;
            width: 200px;
            display: block;
            font-size: 12px;
            padding: 5px 5px;
            border-radius: 7px;
            text-align: center;
            /* text-shadow: 1px 1px 2px #111; */
            background: rgba(40, 134, 221, 0.9);
            border: 1px solid rgba(0, 100, 182, 0.9);
            box-shadow: 0 0 3px rgba(0,0,0,0.5);
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -o-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);
            position: absolute;
            right: -95px;
            bottom: 40px;
        }

        .tooltip:before,.tooltip:after {
            content: '';
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid rgba(40, 134, 221, 0.9);
            position: absolute;
            bottom: -10px;
            left: 43%;
        }

        .tooltip-container:hover .tooltip,a:hover .tooltip {
            opacity: 90%;
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
        }
        .style-price {
            min-width: 90px;
        }
        .style-quantity {
            min-width: 70px;
            background-color: rgb(0, 78, 247);
            color: white;
            border-radius: 5px;
        }
        .style-quantity-alert {
            min-width: 70px;
            background-color: red;
            color: white;
            border-radius: 5px;
        }
    </style>
@endsection
<div class="pc-content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Cliente</b>
                    </label>
                    <br>
                    <button class="btn btn-primary">
                        Buscar/Crear
                    </button>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <label>
                        <b>Tipo Pago</b>
                    </label>
                    <select wire:model="payment_type_id" class="form-select">
                        @foreach( $this->list_payments_types as $p )
                            <option value="{{ $p->id }}">{{ $p->name_payment_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    @if ($this->branch_id > 0)
                        <label>
                            <b>Descuento</b>
                        </label>
                        <h2>{{ number_format($this->total_money, 2, ',', '.') }} Bs</h2>
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label>
                                <b>Cantidad</b>
                                <h2>{{ $this->total_items }}</h2>
                            </label>
                        </div>
                        <div class="col-6">
                            <label>
                                <b>Dinero</b>
                                <h2>{{ number_format($this->total_money, 2, ',', '.') }} Bs</h2>
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
                        <button class="btn" wire:click="$emit('show-modal-product')">
                            <i class="bi bi-search"></i>
                        </button>
                        <input wire:model="search" type="text" class="form-control" placeholder="Buscar Producto...">
                    </div>
                    <div class="table-responsive table-static">
                        @if (strlen($this->search) > 0)
                            <table class="table table-hover">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $p)
                                        <tr>
                                            <td>
                                                {{ ($products->currentpage() - 1) * $products->perpage() + $loop->index + 1 }} - 
                                                {{ $p->name_product }}
                                                <p class="text-muted text-sm">
                                                    <button wire:click.prevent="cart_add({{ $p->id }})" class="btn btn-primary btn-sm">
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
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="mb-4">
                                <h4>Carrito de Ventas</h4>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 text-end">
                            @if ($total_money > 0)
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" wire:click="$emit('alert-clean-cart')">Vaciar</button>
                                    <button type="button" class="btn btn-success" wire:click="$emit('show-modal-finalize-sale')">Finalizar Venta</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive table-static">
                        <table class="table table-hover">
                            <thead class="bg-white">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($this->salesCart->sortBy('name_product') as $c)
                                <tr>
                                    <th class="text-center" scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $c['name_product'] }}
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group style-input-sm">
                                            <input type="number" class="form-control"

                                            id="q{{ $c['id'] }}"
                                            wire:change="change_quantity({{ $c['id'] }}, $event.target.value)"

                                            value="{{ $c['quantity'] }}">
                                            <span class="input-group-text">
                                                Uds
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group style-input">
                                            <input type="number" class="form-control"

                                            id="p{{ $c['id'] }}"
                                            wire:change="change_price({{ $c['id'] }}, $event.target.value)"
                                            
                                            value="{{ $c['price'] }}">
                                            <span class="input-group-text">
                                                Bs
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($c['quantity'] * $c['price'], 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="cart_add({{ $c['id'] }})">
                                                +
                                            </button>
                                            <button type="button" class="btn btn-dark btn-sm" wire:click.prevent="cart_decrease({{ $c['id'] }})">
                                                -
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="cart_delete({{ $c['id'] }})">
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
    {{-- @include('livewire.template.inventory.buy.modal_supplier')
    @include('livewire.template.inventory.buy.modal_product') --}}
    @include('livewire.template.sale.sale.modal_finalize_sale')
    <!-- [ Modal ] end -->
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Muestra la ventana modal crear proveedor
            window.livewire.on('show-modal-supplier', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('supplier'));
                supplierModal.show();
            });
            // Oculta la ventana modal crear proveedor
            window.livewire.on('hide-modal-supplier', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('supplier'));
                supplierModal.hide();
            });

            // Muestra la ventana modal crear proveedor
            window.livewire.on('show-modal-product', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('product'));
                supplierModal.show();
            });
            // Oculta la ventana modal crear proveedor
            window.livewire.on('hide-modal-product', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('product'));
                supplierModal.hide();
            });


            // Muestra la ventana modal finalizar venta
            window.livewire.on('show-modal-finalize-sale', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('finalize_sale'));
                supplierModal.show();
            });
            // Oculta la ventana modal finalizar venta
            window.livewire.on('hide-modal-finalize-sale', msg => {
                var supplierModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('finalize_sale'));
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

            // Muestra una alerta
            window.livewire.on('alert-clean-cart', msg => {
                Swal.fire({
                    title: "¿Vaciar Todo?",
                    text: "Se descartarán todos los productos del carrito de ventas",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Vaciar",
                    cancelButtonText: "Cancelar",
                    }).then((result) => {
                    if (result.isConfirmed)
                    {
                        window.livewire.emit('clean-cart')
                        Swal.close()
                    }
                })
            });

        });
    </script>
@endsection