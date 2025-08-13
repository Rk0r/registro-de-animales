<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Animales</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .action-buttons {
            white-space: nowrap;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
      <div class="db-status-indicator" style="position: fixed; bottom: 20px; right: 20px; padding: 10px; border-radius: 5px; color: white; background-color: {{ $dbStatus ? '#4CAF50' : '#F44336' }};">
    <i class="fas fa-database"></i> PostgreSQL: {{ $dbStatus ? 'Conectado' : 'Desconectado' }}
    @if(!$dbStatus)
    <span class="badge bg-warning text-dark ms-2">
        <i class="fas fa-exclamation-triangle"></i> Error
    </span>
    @endif
</div>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Registro de Animales</h1>
            <a href="{{ route('animales.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Animal
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive table-container">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Edad</th>
                        <th>Raza</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($animales as $animal)
                    <tr>
                        <td>{{ $animal->id }}</td>
                        <td>{{ $animal->nombre }}</td>
                        <td>{{ $animal->especie }}</td>
                        <td>{{ $animal->edad }} años</td>
                        <td>{{ $animal->raza }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('animales.edit', $animal->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('animales.destroy', $animal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay animales registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
    {{ $animales->links() }}
</div>

    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script para alertas -->
    <script>
        // Cierra automáticamente las alertas después de 5 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            });
        });
    </script>
</body>
</html>