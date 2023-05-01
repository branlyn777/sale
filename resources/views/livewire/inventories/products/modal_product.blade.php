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
                        <label class="form-label">Nombre Producto:</label>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Precio:</label>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-12 col-md-12">
                        <label class="form-label">Descripción:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-6 col-md-6">
                        <label class="form-label">Código:</label>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <label class="form-label">Garantía:</label>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-md-6 mb-2">
                        <label class="form-label">Alerta:</label>
                        <input wire:model.lazy="name_product" type="text" class="form-control">
                        @error('name_product')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <label class="form-label">Categoría:</label>
                        <select class="form-select" wire:model="category_id">
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
                        <label class="form-label">Imagen:</label>
                        <input wire:model.lazy="name_product" type="file" class="form-control">
                        @error('name_product')
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
