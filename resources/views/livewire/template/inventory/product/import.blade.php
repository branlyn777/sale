<div wire:ignore.self class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                IMPORTAR PRODUCTOS
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="create_product()" class="btn btn-primary">Importar</button>
            </div>
        </div>
    </div>
</div>
