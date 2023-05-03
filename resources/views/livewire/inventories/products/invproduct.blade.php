@section('css')
<style>
            .autocomplete {
          position: relative;
        }

        .autocomplete input {
          width: 100%;
          padding: 10px;
          font-size: 16px;
        }

        .autocomplete .autocomplete-list {
          position: absolute;
          top: 100%;
          left: 0;
          width: 100%;
          max-height: 200px;
          overflow-y: auto;
          background-color: #fff;
          border: 1px solid #ddd;
          border-top: none;
          z-index: 1;
          display: none;
        }

        .autocomplete .autocomplete-list li {
          padding: 10px;
          font-size: 16px;
          cursor: pointer;
        }

        .autocomplete .autocomplete-list li:hover {
          background-color: #f2f2f2;
        }
</style>
@endsection
<div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <h5>LISTA PRODUCTOS</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end">
                            <button wire:click.prevent="showModalProduct(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nuevo Producto
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
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar Producto...">
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
                                    <th class="text-center" scope="col">Imagen</th>
                                    <th scope="col">Nombre Producto</th>
                                    <th class="text-center" scope="col">Código</th>
                                    <th class="text-center" scope="col">Precio</th>
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
                                            <img style="width: 50px; height: 50px;" src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp" class="rounded float-start mx-auto" alt="...">
                                        </td>
                                        <td>
                                            {{$p->name_product}}
                                        </td>
                                        <td>
                                            {{ $p->barcode }}
                                        </td>
                                        <td>
                                            {{ $p->price }}
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalCategories({{ $p->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click.prevent="check_category({{ $p->id }})" type="button" class="btn btn-outline-danger btn-sm">
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
            @include('livewire.inventories.products.modal_product')
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
        window.livewire.on('alert-category', msg => {
            Swal.fire({
                title: @this.parameters_alert.title,
                text: @this.parameters_alert.message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: @this.parameters_alert.button,
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed)
                {
                    window.livewire.emit('deleteCategory')
                    Swal.close()
                }
            })
        });
        // Muestra un mensaje de tipo toast arriba a la derecha
        window.livewire.on('message-toast', msg => {
            Swal.fire({
                toast: true,
                text: @this.parameters_message_toast.text,
                showConfirmButton: false,
                position: 'top-right',
                timer: @this.parameters_message_toast.timer,
                timerProgressBar: true,
                icon: @this.parameters_message_toast.icon
            })
        });

    });
</script>
<script>
    const input = document.getElementById("input");
    const list = document.querySelector(".autocomplete-list");

    var asd = "nada";

    var names = @json($list_categories);

    function updateList(query)
    {
      // Clear list
      list.innerHTML = "";

      // Filter names based on query
      const filterednames = names.filter(name => name.toLowerCase().includes(query.toLowerCase()));

      // Add filtered names to list
      filterednames.forEach(name => {
        const li = document.createElement("li");
        li.innerText = name;
        li.setAttribute("value", "1");
        li.addEventListener("click", () => {
          asd = name;
          input.value = name;
          list.style.display = "none";
        });
        list.appendChild(li);
      });

      // Show or hide list
      if (filterednames.length > 0) {
        list.style.display = "block";
      } else {
        list.style.display = "none";
      }
    }

    input.addEventListener("click", () => {
      // Elimina todo lo que esta en el input
      input.value = "";
      updateList(input.value);
    });

    input.addEventListener("input", () => {
      updateList(input.value);
    });

    document.addEventListener("click", (e) => {
      if (!e.target.closest(".autocomplete")) {
        if(asd != "nada")
        {
          input.value = asd;
        }
        list.style.display = "none";
      }
    });
</script>
@endsection