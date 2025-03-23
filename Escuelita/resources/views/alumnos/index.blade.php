<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Alumnos</h1>

        <a href="{{ route('alumnos.create') }}" class="btn btn-primary mb-3">Crear Alumno</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>
                           <a href="#" style="color: inherit; text-decoration: none; pointer-events: none;">{{ $alumno->id }}</a>
                        </td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->correo }}</td>
                        <td>{{ $alumno->fecha_nacimiento }}</td>
                        <td>{{ $alumno->ciudad }}</td>  
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-primary btn-sm">Editar</a>
                                <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-danger btn-sm">Eliminar</a>
                                <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-info btn-sm">Detalle del alumno</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
