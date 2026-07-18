<!-- PANTALLA DE LOGIN -->
<div id="loginScreen">
    <div class="login-logo-box">
        <div class="login-brand-icon">
            <i class="fa-solid fa-laptop-code"></i>
        </div>
        <span class="login-brand-text">SisGest Pro</span>
        <span class="login-brand-sub">Sistema de Gestión Empresarial</span>
    </div>

    <div class="login-card">
        <div class="login-header">
            <h2>Iniciar sesión</h2>
            <p>Ingresa tus credenciales para acceder</p>
        </div>

        <form onsubmit="handleLoginSubmit(event)">
            <div class="login-form-group">
                <label>Correo electrónico o Usuario</label>
                <div class="login-input-wrapper">
                    <input type="text" class="login-control" id="loginUsername" required placeholder="Correo o nombre de usuario">
                </div>
            </div>

            <div class="login-form-group">
                <label>Contraseña</label>
                <div class="login-input-wrapper">
                    <input type="password" class="login-control" id="loginPassword" required placeholder="••••••••">
                    <i class="fa-solid fa-eye password-toggle-icon" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>

            <button type="submit" class="btn-login-gradient">
                <i class="fa-solid fa-lock"></i>
                <span>Ingresar al sistema</span>
            </button>
        </form>
    </div>
</div>
