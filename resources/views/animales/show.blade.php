<!DOCTYPE html>
<html>
<head>
    <!-- Mismo head que en index.blade.php -->
</head>
<body>
    <div class="container mt-5">
        <h1>Detalles del Animal</h1>
        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ $animal->nombre }}</h5>
                <p class="card-text">
                    <strong>Especie:</strong> {{ $animal->especie }}<br>
                    <strong>Edad:</strong> {{ $animal->edad }} años<br>
                    <strong>Raza:</strong> {{ $animal->raza }}
                </p>
                <a href="{{ route('animales.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</body>
</html>