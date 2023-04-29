<div wire:ignore.self class="modal fade" id="categorie" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                @if($this->category_id == 0)
                CREAR CATEGORÍA
                @else
                ACTUALIZAR CATEGORÍA
                @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre Categoría:</label>
                        <input wire:model.lazy="name_category" type="text" class="form-control">
                        @error('name_category')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                @if($this->category_id == 0)
                    <button type="button" wire:click.prevent="create_category()" class="btn btn-primary">Crear</button>
                @else
                    <button type="button" wire:click.prevent="update_category()" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
