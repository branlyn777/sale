<div wire:ignore.self class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->product_id == 0)
                CREAR PRODUCTO
                @else
                ACTUALIZAR PRODUCTO
                @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-md-8">
                        <label class="form-label">Nombre Producto</label> <span class="text-danger">*</span>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Precio</label> <span class="text-danger">*</span>
                        <input wire:model.lazy="price" type="text" class="form-control">
                        @error('price')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-12 col-md-12">
                        <label class="form-label">Categoría</label> <span class="text-danger">*</span>
                        <select wire:model="category_id" class="form-select" >
                            <option value="0">Seleccionar</option>
                            @foreach($this->list_categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name_category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-12 col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea wire:model.lazy="description" class="form-control" placeholder="Destalles del producto" rows="3"></textarea>
                        @error('description')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-6 col-md-6">
                        <label class="form-label">Código</label>
                        <div class="tooltip-container">
                            <i class="bi bi-info-circle text-info"></i>
                            <span class="tooltip">
                                Codigo del Producto, este codigo puede ser usado para buscar el producto
                            </span>
                        </div>
                        <input wire:model.lazy="barcode" type="text" class="form-control">
                        @error('barcode')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <label class="form-label">Garantía</label>
                        <div class="tooltip-container">
                            <i class="bi bi-info-circle text-info"></i>
                            <span class="tooltip">
                                Establece la cantidad de dias que cuenta el producto con garantía.
                            </span>
                        </div>
                        <input wire:model.lazy="guarantee" type="text" class="form-control">
                        @error('guarantee')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-md-6 mb-2">
                        <label class="form-label">Stock Mínimo</label>
                        <div class="tooltip-container">
                            <i class="bi bi-info-circle text-info"></i>
                            <span class="tooltip">
                                Cantidad minima que debe tener el producto en todos los lugares donde se encuentre 
                            </span>
                        </div>
                        <input wire:model.lazy="minimum_stock" type="text" class="form-control">
                        @error('minimum_stock')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <label class="form-label">Imagen</label>
                        <input wire:model.lazy="image" type="file" class="form-control" accept="image/x-png, image/gif, image/jpeg">
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                @if($this->product_id == 0)
                    <button type="button" wire:click.prevent="create_product()" class="btn btn-primary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_product()" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
