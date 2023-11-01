<div wire:ignore.self class="modal fade" id="user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
        CREAR USUARIO
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-8 mb-2">
                    <label class="form-label">Nombre</label> <span class="text-danger">*</span>
                    <input wire:model.lazy="name_product" type="text" class="form-control">
                    @error('name_product')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-2">
                    <label class="form-label">Celular</label> <span class="text-danger">*</span>
                    <input wire:model.lazy="price" type="number" class="form-control">
                    @error('price')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 mb-2">
                    <label class="form-label">Rol</label> <span class="text-danger">*</span>
                    <select name="" id="" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 mb-2">
                    <label class="form-label">Sucursal</label> <span class="text-danger">*</span>
                    <select wire:model="branch_id" class="form-select" >
                        <option value="0">Seleccionar</option>
                        @foreach($this->list_branches as $b)
                        <option value="{{ $b->id }}">{{ $b->name_branch }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 mb-2">
                    <label class="form-label">Ingrese Contraseña</label> <span class="text-danger">*</span>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <i class="bi bi-key"></i>
                        </div>
                        <input type="password" class="form-control" aria-label="Text input with checkbox">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 mb-2">
                    <label class="form-label">Repita Contraseña</label> <span class="text-danger">*</span>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <i class="bi bi-key"></i>
                        </div>
                        <input type="password" class="form-control" aria-label="Text input with checkbox">
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary">Crear</button>
      </div>
    </div>
  </div>
</div>