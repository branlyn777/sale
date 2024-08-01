@section('css')

<style>
    .imagePreview img {
        /* max-width: 100%; */
        max-height: 200px;
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 5px;
    }
</style>

@endsection
<div class="pc-content">

    @can('ruat_index')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center mb-3">
                            <h5>RUAT</h5>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 text-end mb-3">
                            <button wire:click.prevent="showModalRuat(0)" type="button" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nuevo Ruat
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 text-center mb-3">
                            <label>Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 text-center">
                            
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 text-end">
                            <div class="input-group">
                                <input type="file" wire:model="file_excel" class="form-control" aria-label="Upload">
                                    <button wire:click.prevent="import_excel" class="btn btn-success ms-auto mb-2">
                                        Importar
                                    </button>                              
                                <button wire:click.prevent="openCombinedPdf" class="btn btn-primary ms-auto mb-2" type="button" @if ($ruatsCount == 0) disabled @endif>
                                    Imprimir Marcados @if ($ruatsCount > 0) ({{$ruatsCount}}) @endif
                                </button>
                            </div>                        
                        </div>                        
                    </div>
                </div>
                {{-- <span wire:loading.delay.longer class="loader"></span> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col" style="width: 25px;">Imprimir</th>
                                    <th class="text-center" scope="col">Placa</th>
                                    <th class="text-center" scope="col">Descargar</th>
                                    <th class="text-center" scope="col">Detalles</th>
                                    <th class="text-center" scope="col">Editar</th>
                                    <th class="text-center" scope="col">Eliminar</th>
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach($ruats as $r)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ($ruats->currentpage() - 1) * $ruats->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td class="text-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;"
                                                    wire:change="addRemovePrint($event.target.checked, '{{ $r->id }}')"
                                                    id="p{{ $r->id }}" value="{{ $r->id }}"
                                                    {{ $r->is_print=="true" ? 'checked' : '' }}
                                                >
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $r->license_plate }}</td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/' . $r->file) }}" target="_blank" class="btn btn-sm" style="color: red;">
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </a>
                                        </td>   
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalRuatDetail({{ $r->id }})" type="button" class="btn btn-outline-primary btn-sm" title="Mostrar Detalles">
                                                <i class="bi bi-card-list"></i>
                                            </button>
                                        </td>                                     
                                        <td class="text-center">
                                            <button wire:click.prevent="showModalRuat({{ $r->id }})" type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="confirm({{ $r->id }}, 'Placa: {{ $r->license_plate }}', '¿Esta seguro de eliminar el Ruat?' ,'warning', 'Si, eliminar ruat')" type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    
                    {{ $ruats->links() }}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    
        <!-- [ Modal ] start -->
            @include('livewire.template.sis.ruats.modal_ruat')
            @include('livewire.template.sis.ruats.modal_ruat_detail')
        <!-- [ Modal ] end -->
    </div>
    @endcan

    @php
        $user = auth()->user();
    @endphp
    @unless ($user->can('ruat_index'))
        <p>El usuario no tiene el permiso deseado.</p>
    @endunless
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        // Manejar el evento para abrir el PDF en una nueva pestaña
        window.livewire.on('openPdf', url => {
            window.open(url, '_blank');
        });

            // Muestra la ventana modal crear/actualizar ruat
            window.livewire.on('show-modal-ruat', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat'));
                ruatModal.show();
            });
            // Oculta la ventana modal crear/actualizar ruat
            window.livewire.on('hide-modal-ruat', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat'));
                ruatModal.hide();
            });

            // Muestra la ventana modal detalle
            window.livewire.on('show-modal-ruat-detail', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat-detail'));
                ruatModal.show();
            });
            // Oculta la ventana modal detalle
            window.livewire.on('hide-modal-ruat-detail', msg => {
                var ruatModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ruat-detail'));
                ruatModal.hide();
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
                        window.livewire.emit('deleteCistern', msg.id)
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
            // Muestra un mensaje
            window.livewire.on('message', msg => {
                Swal.fire({
                icon: msg.icon,
                title: msg.title,
                html: msg.text
                });
            });

        });
    </script>
@endsection