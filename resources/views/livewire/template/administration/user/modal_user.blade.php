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
                <div class="col-12 col-sm-6 col-md-12 mb-2">
                    <label class="form-label">Nombre</label> <span class="text-danger">*</span>
                    <input wire:model.lazy="name" type="text" class="form-control" placeholder="Ingrese nombre del usuario">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-12 mb-2">
                    <label class="form-label">Correo</label> <span class="text-danger">*</span>
                    <input wire:model.lazy="mail" type="text" class="form-control" placeholder="Ingrese correo del usuario">
                    @error('mail')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 mb-2">
                    <label class="form-label">Rol</label> <span class="text-danger">*</span>
                    <select wire:model="role_id" class="form-select">
                        <option value="0">Seleccionar</option>
                        @foreach ($list_roles as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 mb-2">
                    <label class="form-label">Ingrese Contraseña</label> {!! $this->user_id > 0 ? '' : '<span class="text-danger">*</span>' !!}
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <i class="bi bi-key"></i>
                        </div>
                        <input wire:model.lazy="password_a" type="password" class="form-control" aria-label="Text input with checkbox" placeholder="Ingrese contraseña">
                    </div>
                    @error('password_a')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 mb-2">
                    <label class="form-label">Repita Contraseña</label> {!! $this->user_id > 0 ? '' : '<span class="text-danger">*</span>' !!}
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <i class="bi bi-key"></i>
                        </div>
                        <input wire:model.lazy="password_b" type="password" class="form-control" aria-label="Text input with checkbox" placeholder="Repita Contraseña">
                    </div>
                    @error('password_b')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>              
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            @if($this->user_id == 0)
                <button type="button" wire:click.prevent="create_user()" class="btn btn-secondary">Crear</button>
            @else
                <button type="button" wire:click.prevent="update_user()" class="btn btn-secondary">Actualizar</button>
            @endif
        </div>
    </div>
  </div>
</div>