<div wire:ignore.self class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                IMPORTAR PRODUCTOS
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-8">
                        <input type="file" class="form-control" wire:model="excelFile">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-end">
                        <button type="button" wire:click.prevent="import_excel()" class="btn btn-primary">Cargar</button>
                    </div>
                </div>
                @if ($this->importedProducts->count() > 0)
                    <br>
                    <div class="table-responsive table-static">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nombre Producto</th>
                                    <th>Características</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->importedProducts as $p)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $p['name_product'] }}
                                    </td>
                                    <td>
                                        {{ $p['description'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn" data-bs-dismiss="modal">Cerrar</button> --}}
            </div>
        </div>
    </div>
</div>
