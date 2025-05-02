<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Activos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">   
            <h5 class="card-title">Editar registro</h5>
        </div>
        <form action="{{ route('activos.update', $activo->id) }}" method="post" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $activo->nombre) }}" id="nombre">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>                            
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea type="text" class="form-control" aria-label="With textarea" name="descripcion" id="descripcion">"{{ $activo->descripcion }}"</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>                            
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('activos.index') }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-danger">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


