<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5>Categoría Producto</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="bi bi-plus-lg"></i>
                            Nueva Categor&Iacute;a
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha Creación</th>
                            <th scope="col">Fecha Actualización</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center" scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td class="text-center">17/12/1997 22:00</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td class="text-center">17/12/1997 22:00</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td class="text-center">17/12/1997 22:00</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" onclick="asd()" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Categor&Iacute;a</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Selecciona una opción</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>opción 1</option>
                                <option>opción 2</option>
                                <option>opción 3</option>
                                <option>opción 4</option>
                                <option>opción 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="example-date-input">Selecciona una fecha</label>
                            <input class="form-control" type="date" value="2023-02-08" id="example-date-input">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="custom-control-label" for="customSwitch1">Switch</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
      function asd()
      {
          Swal.fire(
          'The Internet?',
          'That thing is still around?',
          'info'
        )
      }
    </script>
@endsection