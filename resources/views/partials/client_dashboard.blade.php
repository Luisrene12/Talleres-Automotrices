<!-- client_dashboard.blade.php — Portal del Cliente -->
<!-- Solo usa módulos CU01, CU02, CU03, CU04 ya existentes -->
<div id="clientPortal" style="display: none; flex-direction: column; min-height: 100vh; width: 100%;">

    <!-- ─── NAVBAR ─────────────────────────────────────────────────── -->
    <nav class="cp-navbar">
        <div class="cp-nav-brand">
            <div class="cp-logo-icon">
                <i class="fa-solid fa-wrench"></i>
            </div>
            <div class="cp-brand-text">
                <strong>SisGest Pro</strong>
                <span>Portal Cliente</span>
            </div>
        </div>

        <div class="cp-nav-links">
            <button class="cp-nav-link active" id="cp-nav-btn-inicio" onclick="switchClientTab('inicio')">
                <i class="fa-solid fa-house"></i> Inicio
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-catalogo" onclick="switchClientTab('catalogo')">
                <i class="fa-solid fa-desktop"></i> Catálogo
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-proveedores" onclick="switchClientTab('proveedores')">
                <i class="fa-solid fa-truck"></i> Proveedores
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-perfil" onclick="switchClientTab('perfil')">
                <i class="fa-regular fa-user"></i> Mi perfil
            </button>
        </div>

        <div class="cp-nav-actions">
            <button class="cp-icon-btn" title="Notificaciones"><i class="fa-regular fa-bell"></i></button>
            <button class="cp-profile-btn" onclick="switchClientTab('perfil')">
                <div class="cp-avatar" id="cp-avatar-initial">C</div>
                <span id="cp-nav-name">Cargando...</span>
            </button>
            <button class="cp-icon-btn" onclick="openLogoutModal()" title="Cerrar sesión">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </nav>

    <!-- ─── CONTENIDO ─────────────────────────────────────────────── -->
    <main class="cp-main-content">

        <!-- INICIO TAB — CU01 -->
        <section id="cp-tab-inicio" class="cp-tab-content active">
            <h1 class="cp-page-title">Bienvenido al Portal</h1>
            <p class="cp-page-subtitle">Sistema de gestión — Módulos disponibles para tu cuenta.</p>

            <div class="cp-inicio-banner">
                <div class="cp-banner-text">
                    <h2>Tu taller de confianza</h2>
                    <p>Consulta el catálogo de servicios disponibles y conoce nuestros proveedores aliados.</p>
                    <button class="cp-btn cp-btn-primary" onclick="switchClientTab('catalogo')">
                        <i class="fa-solid fa-desktop"></i> Ver catálogo de servicios
                    </button>
                </div>
            </div>

            <div class="cp-inicio-cards">
                <div class="cp-inicio-card" onclick="switchClientTab('catalogo')">
                    <div class="cp-inicio-card-icon" style="background:#dbeafe; color:#3b82f6;">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <div>
                        <h4>Catálogo de Servicios</h4>
                        <p>CU03 · Servicios y categorías disponibles</p>
                    </div>
                    <i class="fa-solid fa-chevron-right" style="color:#94a3b8; margin-left:auto;"></i>
                </div>
                <div class="cp-inicio-card" onclick="switchClientTab('proveedores')">
                    <div class="cp-inicio-card-icon" style="background:#f0fdf4; color:#22c55e;">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <div>
                        <h4>Proveedores</h4>
                        <p>CU04 · Directorio de proveedores</p>
                    </div>
                    <i class="fa-solid fa-chevron-right" style="color:#94a3b8; margin-left:auto;"></i>
                </div>
                <div class="cp-inicio-card" onclick="switchClientTab('perfil')">
                    <div class="cp-inicio-card-icon" style="background:#fef3c7; color:#f59e0b;">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <h4>Mi Perfil</h4>
                        <p>CU02 · Tu cuenta, rol y permisos</p>
                    </div>
                    <i class="fa-solid fa-chevron-right" style="color:#94a3b8; margin-left:auto;"></i>
                </div>
            </div>
        </section>

        <!-- CATÁLOGO TAB — CU03: Servicio + TipoServicio -->
        <section id="cp-tab-catalogo" class="cp-tab-content">
            <div class="cp-breadcrumbs">
                <span onclick="switchClientTab('inicio')" style="cursor:pointer;">Portal Cliente</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Catálogo de servicios</span>
            </div>
            <h1 class="cp-page-title">Catálogo de servicios</h1>
            <p class="cp-page-subtitle">Todos los servicios disponibles en el taller. <span class="cp-cu-badge">CU03</span></p>

            <div class="cp-filter-pills" id="cp-tipo-pills">
                <button class="cp-pill active" data-tipo="todos">Todos</button>
                <!-- Tipos de servicio se inyectan aquí -->
            </div>

            <div class="cp-catalog-grid" id="cp-catalog-container">
                <div class="cp-loading"><i class="fa-solid fa-spinner fa-spin"></i> Cargando...</div>
            </div>
        </section>

        <!-- PROVEEDORES TAB — CU04 -->
        <section id="cp-tab-proveedores" class="cp-tab-content">
            <div class="cp-breadcrumbs">
                <span onclick="switchClientTab('inicio')" style="cursor:pointer;">Portal Cliente</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Proveedores</span>
            </div>
            <h1 class="cp-page-title">Proveedores</h1>
            <p class="cp-page-subtitle">Directorio de proveedores registrados en el sistema. <span class="cp-cu-badge">CU04</span></p>

            <div class="cp-search-bar">
                <i class="fa-solid fa-search"></i>
                <input type="text" id="cp-prov-search" placeholder="Buscar proveedor por nombre o NIT..." oninput="filterProveedores(this.value)">
            </div>

            <div class="cp-proveedores-list" id="cp-proveedores-container">
                <div class="cp-loading"><i class="fa-solid fa-spinner fa-spin"></i> Cargando...</div>
            </div>
        </section>

        <!-- PERFIL TAB — CU02: Usuario + Rol + Permiso -->
        <section id="cp-tab-perfil" class="cp-tab-content">
            
            <div class="cp-profile-container">
                <!-- Columna Izquierda: Tarjeta Principal -->
                <div class="cp-profile-sidebar">
                    <div class="cp-profile-card">
                        <div class="cp-profile-avatar-large" id="cp-profile-avatar-large">R</div>
                        <h2 class="cp-profile-name-large" id="cp-profile-name-large">Cargando...</h2>
                        <p class="cp-profile-company" id="cp-profile-company">Cliente SisGest</p>
                        <p class="cp-profile-since" id="cp-profile-since-large">Cliente desde Enero 2024</p>
                        <button class="cp-btn cp-btn-outline w-100" style="margin-top: 1.5rem;" onclick="cp_openEditProfileModal()">
                            <i class="fa-regular fa-pen-to-square"></i> Editar perfil
                        </button>
                    </div>
                    
                    <div class="cp-profile-card">
                        <h3>Permisos de cuenta</h3>
                        <div class="cp-permisos-list mt-3" id="cp-permisos-container">
                            <div class="cp-loading"><i class="fa-solid fa-spinner fa-spin"></i> Cargando permisos...</div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Detalles -->
                <div class="cp-profile-details">
                    <!-- Datos Personales -->
                    <div class="cp-profile-section">
                        <div class="cp-section-header">
                            <h3>Datos personales</h3>
                        </div>
                        <div class="cp-info-grid">
                            <div class="cp-info-item">
                                <label>Nombre completo</label>
                                <p id="cp-info-nombre">-</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Correo electrónico</label>
                                <p id="cp-info-email">-</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Empresa</label>
                                <p id="cp-info-empresa">No registrado</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Teléfono</label>
                                <p id="cp-info-telefono">No registrado</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Ciudad</label>
                                <p id="cp-info-ciudad">No registrado</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Rol de usuario</label>
                                <p id="cp-info-rol">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Seguridad de la cuenta -->
                    <div class="cp-profile-section">
                        <div class="cp-section-header">
                            <h3>Seguridad de la cuenta</h3>
                        </div>
                        
                        <div class="cp-security-item">
                            <div class="cp-security-info">
                                <h4>Contraseña</h4>
                                <p>Tu contraseña está protegida (CU01)</p>
                            </div>
                            <button class="cp-btn cp-btn-text" onclick="cp_openEditProfileModal()">Cambiar</button>
                        </div>

                        <div class="cp-security-item">
                            <div class="cp-security-info">
                                <h4>Sesión activa</h4>
                                <p>Navegador web · hace 2 min</p>
                            </div>
                            <span class="cp-status-badge cp-status-completed">Activa</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- MODAL EDITAR PERFIL -->
    <div id="cp-edit-profile-modal" class="cp-modal-overlay" style="display: none;">
        <div class="cp-modal">
            <div class="cp-modal-header">
                <h2>Editar perfil</h2>
                <button class="cp-modal-close" onclick="cp_closeEditProfileModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form onsubmit="cp_handleEditProfile(event)">
                <div class="cp-modal-body">
                    <p class="cp-text-muted mb-4" style="font-size:0.9rem;">Actualiza tu información personal y credenciales de acceso. (Usando CU02)</p>
                    
                    <div class="cp-form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" id="cp_edit_nombre" class="cp-form-control" required>
                    </div>
                    
                    <div class="cp-form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" id="cp_edit_email" class="cp-form-control" required>
                    </div>

                    <div class="cp-form-group">
                        <label>Empresa</label>
                        <input type="text" id="cp_edit_empresa" class="cp-form-control">
                    </div>

                    <div class="cp-form-group">
                        <label>Teléfono</label>
                        <input type="text" id="cp_edit_telefono" class="cp-form-control">
                    </div>

                    <div class="cp-form-group">
                        <label>Ciudad</label>
                        <input type="text" id="cp_edit_ciudad" class="cp-form-control">
                    </div>

                    <div class="cp-form-divider">Cambiar Contraseña</div>

                    <div class="cp-form-group">
                        <label>Nueva Contraseña <span style="font-weight:normal;color:#94a3b8;">(opcional)</span></label>
                        <input type="password" id="cp_edit_password" class="cp-form-control" placeholder="Dejar en blanco para mantener actual">
                    </div>
                </div>
                <div class="cp-modal-footer">
                    <button type="button" class="cp-btn cp-btn-outline" onclick="cp_closeEditProfileModal()">Cancelar</button>
                    <button type="submit" class="cp-btn cp-btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

</div>
