<!-- client_dashboard.blade.php — Portal del Cliente Taller Automotriz -->

<div id="clientPortal" style="display: none; flex-direction: column; min-height: 100vh; width: 100%; background: #f8fafc;">

    <!-- ─── NAVBAR SUPERIOR ─────────────────────────────────────────── -->
    <nav class="cp-navbar">
        <div class="cp-nav-brand">
            <div class="cp-logo-icon">
                <i class="fa-solid fa-car-burst"></i>
            </div>
            <div class="cp-brand-text">
                <strong>AutoTaller</strong>
                <span>Portal del Cliente</span>
            </div>
        </div>

        <div class="cp-nav-links">
            <button class="cp-nav-link active" id="cp-nav-btn-inicio" onclick="switchClientTab('inicio')">
                <i class="fa-solid fa-house"></i> Inicio
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-mis-servicios" onclick="switchClientTab('mis-servicios')">
                <i class="fa-solid fa-wrench"></i> Mis Servicios
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-catalogo" onclick="switchClientTab('catalogo')">
                <i class="fa-solid fa-list-check"></i> Catálogo
            </button>
            <button class="cp-nav-link" id="cp-nav-btn-perfil" onclick="switchClientTab('perfil')">
                <i class="fa-regular fa-user"></i> Mi Perfil
            </button>
        </div>

        <div class="cp-nav-actions">
            <button class="cp-icon-btn" title="Notificaciones">
                <i class="fa-regular fa-bell"></i>
                <span class="cp-notif-dot"></span>
            </button>
            <button class="cp-profile-btn" onclick="switchClientTab('perfil')">
                <div class="cp-avatar" id="cp-avatar-initial">C</div>
                <span id="cp-nav-name" style="font-weight:700;">Cargando...</span>
            </button>
            <button class="cp-icon-btn cp-logout-btn" onclick="openLogoutModal()" title="Cerrar sesión">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </nav>

    <!-- ─── CONTENIDO PRINCIPAL ───────────────────────────────────────── -->
    <main class="cp-main-content">

        <!-- ════════════════════════════════════════
             TAB: INICIO
        ════════════════════════════════════════ -->
        <section id="cp-tab-inicio" class="cp-tab-content active">

            <!-- HERO BIENVENIDA -->
            <div class="cp-hero-banner">
                <div class="cp-hero-content">
                    <div class="cp-hero-badge">
                        <i class="fa-solid fa-shield-check"></i> Cliente verificado
                    </div>
                    <h1 class="cp-hero-title">Bienvenido, <span id="cp-hero-name">Cliente</span> 👋</h1>
                    <p class="cp-hero-subtitle">Aquí encontrarás toda la información sobre tus servicios, el estado de tu vehículo y nuestro catálogo completo. Tu tranquilidad es nuestra prioridad.</p>
                    <div class="cp-hero-actions">
                        <button class="cp-btn cp-btn-primary" onclick="switchClientTab('catalogo')">
                            <i class="fa-solid fa-list-check"></i> Ver catálogo de servicios
                        </button>
                        <button class="cp-btn cp-btn-glass" onclick="switchClientTab('mis-servicios')">
                            <i class="fa-solid fa-wrench"></i> Mis servicios
                        </button>
                    </div>
                </div>
                <div class="cp-hero-illustration">
                    <div class="cp-car-icon-wrap">
                        <i class="fa-solid fa-car-side"></i>
                        <div class="cp-car-shadow"></div>
                    </div>
                    <div class="cp-float-badge cp-float-1">
                        <i class="fa-solid fa-check-circle"></i> Servicio al día
                    </div>
                    <div class="cp-float-badge cp-float-2">
                        <i class="fa-solid fa-star"></i> Calidad premium
                    </div>
                </div>
            </div>

            <!-- KPI CARDS -->
            <div class="cp-stats-row">
                <div class="cp-stat-card">
                    <div class="cp-stat-icon" style="background: linear-gradient(135deg,#6366f1,#4f46e5);">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                    <div class="cp-stat-info">
                        <span class="cp-stat-val" id="cp-kpi-servicios-val">—</span>
                        <span class="cp-stat-lbl">Servicios en catálogo</span>
                    </div>
                </div>
                <div class="cp-stat-card">
                    <div class="cp-stat-icon" style="background: linear-gradient(135deg,#10b981,#059669);">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="cp-stat-info">
                        <span class="cp-stat-val" id="cp-kpi-activos-val">Activo</span>
                        <span class="cp-stat-lbl">Estado de cuenta</span>
                    </div>
                </div>
                <div class="cp-stat-card">
                    <div class="cp-stat-icon" style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="cp-stat-info">
                        <span class="cp-stat-val">24/7</span>
                        <span class="cp-stat-lbl">Atención al cliente</span>
                    </div>
                </div>
                <div class="cp-stat-card">
                    <div class="cp-stat-icon" style="background: linear-gradient(135deg,#ec4899,#be185d);">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="cp-stat-info">
                        <span class="cp-stat-val" id="cp-kpi-rol-val">Cliente</span>
                        <span class="cp-stat-lbl">Tu rol en el sistema</span>
                    </div>
                </div>
            </div>

            <!-- DOS COLUMNAS: Accesos rápidos + Contacto -->
            <div class="cp-home-grid">

                <!-- Accesos rápidos -->
                <div class="cp-quick-access">
                    <h3 class="cp-section-title"><i class="fa-solid fa-bolt"></i> Accesos Rápidos</h3>
                    <div class="cp-quick-list">
                        <div class="cp-quick-item" onclick="switchClientTab('catalogo')">
                            <div class="cp-quick-icon" style="background:#eef2ff; color:#6366f1;">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <div class="cp-quick-text">
                                <strong>Catálogo de Servicios</strong>
                                <span>Explora todos los servicios y sus precios</span>
                            </div>
                            <i class="fa-solid fa-chevron-right cp-quick-arrow"></i>
                        </div>

                        <div class="cp-quick-item" onclick="switchClientTab('mis-servicios')">
                            <div class="cp-quick-icon" style="background:#f0fdf4; color:#10b981;">
                                <i class="fa-solid fa-wrench"></i>
                            </div>
                            <div class="cp-quick-text">
                                <strong>Mis Servicios</strong>
                                <span>Consulta tus solicitudes y mantenimiento</span>
                            </div>
                            <i class="fa-solid fa-chevron-right cp-quick-arrow"></i>
                        </div>

                        <div class="cp-quick-item" onclick="switchClientTab('perfil')">
                            <div class="cp-quick-icon" style="background:#fffbeb; color:#f59e0b;">
                                <i class="fa-regular fa-id-card"></i>
                            </div>
                            <div class="cp-quick-text">
                                <strong>Mi Perfil</strong>
                                <span>Ver y actualizar tus datos personales</span>
                            </div>
                            <i class="fa-solid fa-chevron-right cp-quick-arrow"></i>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta informativa del taller -->
                <div class="cp-taller-info-card">
                    <div class="cp-taller-header">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <div>
                            <h3>Taller AutoMotriz Pro</h3>
                            <span class="cp-taller-badge">Taller verificado ✓</span>
                        </div>
                    </div>
                    <div class="cp-taller-details">
                        <div class="cp-taller-row">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Av. Principal 123, Santa Cruz, Bolivia</span>
                        </div>
                        <div class="cp-taller-row">
                            <i class="fa-solid fa-phone"></i>
                            <span>+591 70000000</span>
                        </div>
                        <div class="cp-taller-row">
                            <i class="fa-solid fa-envelope"></i>
                            <span>contacto@automotriz.com</span>
                        </div>
                        <div class="cp-taller-row">
                            <i class="fa-regular fa-clock"></i>
                            <span>Lun – Sáb: 8:00 AM – 6:00 PM</span>
                        </div>
                    </div>
                    <div class="cp-taller-divider"></div>
                    <div class="cp-taller-ratings">
                        <div class="cp-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <span>4.8 / 5 — Servicio Certificado</span>
                    </div>
                </div>
            </div>

        </section>

        <!-- ════════════════════════════════════════
             TAB: MIS SERVICIOS
        ════════════════════════════════════════ -->
        <section id="cp-tab-mis-servicios" class="cp-tab-content">
            <div class="cp-page-header">
                <div>
                    <h1 class="cp-page-title"><i class="fa-solid fa-wrench"></i> Mis Servicios</h1>
                    <p class="cp-page-subtitle">Solicita un servicio técnico para tu vehículo o revisa el estado de tus órdenes.</p>
                </div>
                <button class="cp-btn cp-btn-primary" onclick="cp_openSolicitudModal()">
                    <i class="fa-solid fa-plus"></i> Solicitar Servicio
                </button>
            </div>

            <div id="cp-solicitudes-container" class="cp-solicitudes-grid">
                <div class="cp-loading"><i class="fa-solid fa-spinner fa-spin"></i> Cargando información...</div>
            </div>
        </section>

        <!-- ════════════════════════════════════════
             TAB: CATÁLOGO
        ════════════════════════════════════════ -->
        <section id="cp-tab-catalogo" class="cp-tab-content">
            <div class="cp-page-header">
                <div>
                    <h1 class="cp-page-title"><i class="fa-solid fa-list-check"></i> Catálogo de Servicios</h1>
                    <p class="cp-page-subtitle">Explora todos los servicios disponibles en el taller con precios orientativos.</p>
                </div>
            </div>

            <div class="cp-catalog-grid" id="cp-catalog-container">
                <div class="cp-loading"><i class="fa-solid fa-spinner fa-spin"></i> Cargando catálogo...</div>
            </div>
        </section>

        <!-- ════════════════════════════════════════
             TAB: PERFIL
        ════════════════════════════════════════ -->
        <section id="cp-tab-perfil" class="cp-tab-content">
            <div class="cp-page-header">
                <h1 class="cp-page-title"><i class="fa-regular fa-user"></i> Mi Perfil</h1>
            </div>

            <div class="cp-profile-container">
                <div class="cp-profile-sidebar">
                    <div class="cp-profile-card">
                        <div class="cp-profile-avatar-large" id="cp-profile-avatar-large">C</div>
                        <h2 class="cp-profile-name-large" id="cp-profile-name-large">Cargando...</h2>
                        <p class="cp-profile-company" id="cp-profile-company">Cliente Taller Automotriz</p>
                        <span class="cp-profile-badge-client"><i class="fa-solid fa-shield-check"></i> Cuenta Activa</span>
                    </div>

                    <div class="cp-profile-card cp-security-card">
                        <h3><i class="fa-solid fa-shield-halved" style="color:#6366f1;"></i> Seguridad</h3>
                        <div class="cp-security-item">
                            <div class="cp-security-info">
                                <h4>Sesión Protegida</h4>
                                <p>Autenticación segura por token/sesión</p>
                            </div>
                            <span class="cp-badge-active"><i class="fa-solid fa-circle" style="font-size:0.55rem;"></i> En línea</span>
                        </div>
                    </div>
                </div>

                <div class="cp-profile-details">
                    <div class="cp-profile-section">
                        <div class="cp-section-header">
                            <h3><i class="fa-solid fa-id-card" style="color:#6366f1;"></i> Información Personal</h3>
                        </div>
                        <div class="cp-info-grid">
                            <div class="cp-info-item">
                                <label>Nombre de Usuario</label>
                                <p id="cp-info-nombre">—</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Correo Electrónico</label>
                                <p id="cp-info-email">—</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Empresa / Razón Social</label>
                                <p id="cp-info-empresa">Particular</p>
                            </div>
                            <div class="cp-info-item">
                                <label>Rol Asignado</label>
                                <p id="cp-info-rol">Cliente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ─── MODAL SOLICITAR SERVICIO ────────────────────────────────── -->
    <div id="cp-solicitud-modal" class="cp-modal-overlay" style="display:none;">
        <div class="cp-modal">
            <div class="cp-modal-header">
                <h2><i class="fa-solid fa-wrench" style="color:#6366f1; margin-right:0.5rem;"></i> Solicitar Servicio</h2>
                <button class="cp-modal-close" onclick="cp_closeSolicitudModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form onsubmit="cp_handleSolicitud(event)">
                <div class="cp-modal-body">
                    <div class="cp-form-group">
                        <label>Servicio Requerido</label>
                        <select id="cp_sol_servicio" class="cp-form-control" required>
                            <option value="">— Selecciona un servicio —</option>
                        </select>
                    </div>
                    <div class="cp-form-group">
                        <label>Placa o Modelo del Vehículo</label>
                        <input type="text" id="cp_sol_placa" class="cp-form-control" placeholder="Ej: ABC-1234 / Toyota Corolla 2020" required>
                    </div>
                    <div class="cp-form-group">
                        <label>Detalles / Síntomas que presenta</label>
                        <textarea id="cp_sol_descripcion" class="cp-form-control" rows="3" placeholder="Describe brevemente el problema o requerimiento..."></textarea>
                    </div>
                </div>
                <div class="cp-modal-footer">
                    <button type="button" class="cp-btn cp-btn-outline" onclick="cp_closeSolicitudModal()">Cancelar</button>
                    <button type="submit" class="cp-btn cp-btn-primary"><i class="fa-solid fa-paper-plane"></i> Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>

</div>