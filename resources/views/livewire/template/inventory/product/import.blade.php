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
                        <input type="file" class="form-control" wire:model="excelFile" accept=".xlsx, .xls">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-end">
                        @if ($this->importedProducts->count() == 0)
                        <button type="button" wire:click.prevent="import_excel()" class="btn btn-primary">Cargar</button>
                        @endif
                    </div>
                </div>
                @if ($this->importedProducts->count() > 0)
                    <br>
                    <div class="table-responsive table-static">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Barcode</th>
                                    <th>Categoría</th>
                                    <th>Almacen</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->importedProducts as $p)
                                    @if ($p['status'] == 1)
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
                                            <td class="text-end">
                                                {{ number_format($p['price'], 2, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ $p['barcode'] }}
                                            </td>
                                            <td>
                                                {{ $p['category'] }}
                                            </td>
                                            <td>
                                                {{ $p['warehouses'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ $p['quantity'] }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if ($this->importedProducts->count() > 0)
                    <br>
                    <div class="text-center">
                        <h5 class="text-danger">Productos Repetidos</h5>
                    </div>
                    <br>
                    <div class="table-responsive table-static">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Producto Repetido</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Barcode</th>
                                    <th>Categoría</th>
                                    <th>Almacen</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->importedProducts as $ip)
                                @if ($ip['status'] == 0)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $ip['name_product'] }}
                                    </td>
                                    <td>
                                        {{ $ip['description'] }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($p['price'], 2, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ $ip['barcode'] }}
                                    </td>
                                    <td>
                                        {{ $ip['category'] }}
                                    </td>
                                    <td>
                                        {{ $ip['warehouses'] }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ip['quantity'] }}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                @if ($this->importedProducts->count() > 0)
                <button wire:click.prevent='insert_products()' type="button" class="btn btn-primary">Importar</button>
                @endif
            </div>
        </div>
    </div>
</div>
