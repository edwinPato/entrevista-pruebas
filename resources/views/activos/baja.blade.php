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
            <h5 class="card-title">Baja de activo</h5>
        </div>
        <form action="{{ route('bajas.store', $activo->id) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 text-center">
                        <label for="nombre" class="form-label fw-bold">Nombre : {{ $activo->nombre }}</label>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                        <label for="stock_actual" class="form-label fw-bold">Cantidad actual: {{ $activo->stock_actual}} </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cantidad" class="form-label fw-bold">Cantidad a dar de baja</label>
                        <input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}" id="cantidad">
                        @error('cantidad')
                            <small class="text-danger">{{ $message }}</small>                            
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="motivo" class="form-label fw-bold">Motivo de la baja</label>
                        <select class="form-control" name="motivo" id="motivo">
                            <option value="">-- Seleccione un motivo --</option>
                            <option value="perdida">Pérdida</option>
                            <option value="fin_vida_util">Fin vida útil</option>
                            <option value="desuso">Deshuso</option>
                        </select>
                        @error('motivo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="fecha" class="form-label fw-bold">Fecha de baja</label>
                        <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}" id="fecha">
                        @error('fecha')
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


