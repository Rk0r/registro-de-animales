<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Animal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .is-invalid { border-color: #dc3545; }
        .invalid-feedback { color: #dc3545; }
        .is-valid { border-color: #28a745; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Nuevo Animal</h1>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form id="animal-form" action="{{ route('animales.store') }}" method="POST" novalidate>
            @csrf
            
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                       id="nombre" name="nombre" value="{{ old('nombre') }}"
                       required maxlength="50" pattern="[A-Za-zÁ-ú\s]+">
                @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <!-- Especie -->
            <div class="mb-3">
                <label for="especie" class="form-label">Especie</label>
                <input type="text" class="form-control @error('especie') is-invalid @enderror" 
                       id="especie" name="especie" value="{{ old('especie') }}"
                       required maxlength="50" pattern="[A-Za-zÁ-ú\s]+">
                @error('especie')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <!-- Edad -->
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control @error('edad') is-invalid @enderror" 
                       id="edad" name="edad" value="{{ old('edad') }}"
                       required min="0" max="50">
                @error('edad')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <!-- Raza -->
            <div class="mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control @error('raza') is-invalid @enderror" 
                       id="raza" name="raza" value="{{ old('raza') }}"
                       required maxlength="50" pattern="[A-Za-zÁ-ú\s]+">
                @error('raza')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Guardar
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Validación JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('animal-form');
        
        form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        });
        
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    </script>
</body>
</html>