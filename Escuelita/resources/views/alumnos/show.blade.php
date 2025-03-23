<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Alumno</title>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detalles del Alumno</h1>

        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-center">{{ $alumno->nombre }}</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Correo:</strong> {{ $alumno->correo }}</li>
                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento}}</li>
                    <li class="list-group-item"><strong>Ciudad:</strong> {{ $alumno->ciudad }}</li>
                </ul>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-warning">Editar</a>

            <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este alumno?')">Eliminar</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


