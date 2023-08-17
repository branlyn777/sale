@section('css')
    <style>
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
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 text-center mb-3">
                            <h5>LISTA PRODUCTOS</h5>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 text-end mb-3">
                            <button wire:click.prevent="showModalProduct(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nuevo Producto
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                            <label>Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar Producto...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                            <label>Sucursal</label>
                            <select wire:model="branch_id" class="form-select">
                                @foreach( $list_branches as $b )
                                    <option value="{{ $b->id }}">{{ $b->name_branch }}</option>
                                @endforeach
                                <option value="all">Todos</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
                            <label>Almacén</label>
                            <select wire:model="warehouse_id" class="form-select">
                                @foreach($list_warehouses as $w)
                                <option value="{{ $w->id }}">{{ $w->name_warehouse }}</option>
                                @endforeach
                                <option value="all">Todos</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 text-center mb-3">
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
                                    <th class="text-center" scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Código</th>
                                    <th class="text-center" scope="col">Precio</th>
                                    <th class="text-center" scope="col">Cantidad</th>
                                    <th class="text-center" scope="col">Editar</th>
                                    <th class="text-center" scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $p)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($products->currentpage() - 1) * $products->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/invProducts/' . $p->image) }}" alt="hoodie" width="50" height="50">
                                        </td>
                                        <td>
                                            {{$p->name_product}}
                                            <p class="text-muted m-b-30"> {{ $p->description }} </p>
                                        </td>
                                        <td class="text-center">
                                            {{ $p->barcode }}
                                        </td>
                                        <td class="text-end">
                                            <div class="style-price">
                                                {{ number_format($p->price, 2, ',', '.') }} Bs
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="{{ $p->quantity !== 'Agotado' ? 'style-quantity' : 'style-quantity-alert' }}">
                                                {{ $p->quantity }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalProduct({{ $p->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="check_product({{ $p->id }})" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
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
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.inventory.product.modal_product')
        <!-- [ Modal ] end -->
    </div>
</div>
@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Muestra la ventana modal crear/actualizar un producto
        window.livewire.on('show-modal-product', msg => {
            var productModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('product'));
            productModal.show();
        });
        // Oculta la ventana modal crear/actualizar un producto
        window.livewire.on('hide-modal-product', msg => {
            var productModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('product'));
            productModal.hide();

            Swal.fire({
                toast: true,
                text: 'Producto creado exitósamente',
                showConfirmButton: false,
                position: 'top-right',
                timer: 3000,
                timerProgressBar: true,
                icon: 'success'
            })

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
                        window.livewire.emit('deleteProduct', msg.id)
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