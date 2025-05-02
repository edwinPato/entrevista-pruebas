<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Activos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h5 class="card-title">Lista de activos  <i class="fa-solid fa-boxes-stacked ms-1"></i></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                    <form action="{{ route('activos.index') }}" method="get" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o código..." value="{{ request('search') }}" style="min-width: 250px;">
                        <button type="submit" class="btn btn-secondary">Buscar</button>
                    </form>
                    <a href="{{ route('activos.create') }}" class="btn btn-dark ms-2">Agregar</a>
                </div>
                <div class="col-12"><br>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-dark">
                                <tr class="text-center">
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Stock actual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($datos) == 0)
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            <span class="badge bg-danger">No existen registros de activos</span>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($datos as $activo)
                                        <tr class="text-center">
                                            <td>{{ $activo->codigo }}</td>
                                            <td>{{ $activo->nombre }}</td>
                                            <td>{{ $activo->stock_actual }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('activos.edit', $activo->id) }}" class="btn btn-secondary btn-sm">Editar</a>
                                                    <a href="{{ route('bajas.create', $activo->id) }}" class="btn btn-danger btn-sm">Baja</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $datos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

