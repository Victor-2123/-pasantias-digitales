<div class="login-container">
    <!-- Corner decorations -->
    <div class="corner-decoration corner-tl-1"></div>
    <div class="corner-decoration corner-tl-2"></div>
    <div class="corner-decoration corner-tl-3"></div>
    <div class="corner-decoration corner-br-1"></div>
    <div class="corner-decoration corner-br-2"></div>
    <div class="corner-decoration corner-br-3"></div>

    <div class="content-wrapper">
        <div class="login-title">INICIAR SESIÓN</div>

        <!-- Login Section -->
        <div class="login-section">
            {{ $slot }}
        </div>

        <!-- Register Section -->
        <div class="register-section">
            <div class="register-title">¿AÚN NO TIENES UNA CUENTA?</div>
            <div class="register-buttons">
                <a href="{{ route('prepare-register', ['type' => 'estudiante']) }}" class="btn-register">
                    Crear cuenta de estudiante.
                </a>
                <a href="{{ route('prepare-register', ['type' => 'maestro']) }}" class="btn-register">
                    Crear cuenta de mentor.
                </a>
            </div>
        </div>
    </div>
</div>
