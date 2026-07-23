<!-- BARRA LATERAL DE NAVEGACIÓN -->
<aside id="dashboardSidebar" style="display: none;">
    <!-- Brand Header -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>
        <div>
            <span class="brand-text">Taller</span>
            <span class="brand-version">Automotriz</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="menu-container">

        <div class="menu-item active" id="nav-panel" onclick="switchView('panel')">
            <div class="menu-item-label">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Panel principal</span>
            </div>
        </div>

        <div class="menu-section-title">Gestión de accesos</div>

        <div class="menu-item" id="nav-usuarios" onclick="switchView('usuarios')">
            <div class="menu-item-label">
                <i class="fa-solid fa-users"></i>
                <span>Usuarios</span>
            </div>
        </div>

        <div class="menu-item" id="nav-roles" onclick="switchView('roles')">
            <div class="menu-item-label">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Roles</span>
            </div>
        </div>

        <div class="menu-item" id="nav-permisos" onclick="switchView('permisos')">
            <div class="menu-item-label">
                <i class="fa-solid fa-key"></i>
                <span>Permisos</span>
            </div>
        </div>

        <div class="menu-section-title">Catálogo de servicios</div>

        <div class="menu-item" id="nav-tipos-servicio" onclick="switchView('tipos-servicio')">
            <div class="menu-item-label">
                <i class="fa-solid fa-tags"></i>
                <span>Tipos de Servicio</span>
            </div>
        </div>

        <div class="menu-item" id="nav-servicios" onclick="switchView('servicios')">
            <div class="menu-item-label">
                <i class="fa-solid fa-wrench"></i>
                <span>Servicios</span>
            </div>
        </div>

        <div class="menu-section-title">Directorio</div>

        <div class="menu-item" id="nav-proveedores" onclick="switchView('proveedores')">
            <div class="menu-item-label">
                <i class="fa-solid fa-truck"></i>
                <span>Proveedores</span>
            </div>
        </div>

    </div>

    <!-- Sidebar Profile Footer -->
    <div class="sidebar-profile">
        <div class="profile-info">
            <div class="profile-avatar" id="avatarLetter">?</div>
            <div class="profile-details">
                <div class="profile-name" id="currentProfileName">Cargando...</div>
                <div class="profile-role" id="currentProfileRole">Invitado</div>
            </div>
        </div>
        <div class="logout-link" onclick="openLogoutModal()">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Cerrar sesión</span>
        </div>
    </div>
</aside>
