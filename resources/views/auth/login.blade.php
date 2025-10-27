<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Agencia de Turismo</title>

    <!-- Font Awesome (para el ícono de mostrar/ocultar contraseña) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS (solo para esta página) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos propios de login -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
<div id="login-page">
    <div class="row justify-content-center align-items-center min-vh-100 m-0">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Correo electrónico"
                                   autocomplete="email"
                                   required
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Tu contraseña"
                                       autocomplete="current-password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Mostrar u ocultar contraseña">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="remember"
                                   name="remember">
                            <label class="form-check-label" for="remember">
                                Recordar sesión
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Iniciar Sesión
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            <strong>Credenciales de prueba:</strong><br>
                            admin@agencia.com / password123<br>
                            usuario@agencia.com / password123
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (solo para esta página) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Mostrar/ocultar contraseña
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const pwdInput = document.getElementById('password');
        if (toggleBtn && pwdInput) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = pwdInput.getAttribute('type') === 'password';
                pwdInput.setAttribute('type', isPassword ? 'text' : 'password');
                const icon = toggleBtn.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            });
        }
    });
</script>
</body>
</html>