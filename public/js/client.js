// ================================================================
// client.js — Portal del Cliente (Lógica Web 3D & Responsive)
<<<<<<< HEAD
=======
// Usa los mismos endpoints del sistema admin:
//   CU01: /api/me, /api/login, /api/logout
//   CU02: /api/me (con rol y permisos)
//   CU03: /api/servicios, /api/tipos-servicio
//   CU04: /api/proveedores
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
// ================================================================

const cpHeaders = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
};

<<<<<<< HEAD
const cpFetchOptions = {
    headers: cpHeaders,
    credentials: 'same-origin'
};

let cp_userProfile = null;

=======
// Estado del portal
let cp_allServicios = [];
let cp_allProveedores = [];
let cp_allTipos = [];
let cp_userProfile = null;

// ─── INIT ─────────────────────────────────────────────────────────────────────
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
async function initClientPortal() {
    if (window._cpInitialized) return;
    window._cpInitialized = true;

<<<<<<< HEAD
    await Promise.all([
        cp_loadProfile(),
        cp_loadEstadoVehiculo(),
        cp_loadNotificaciones()
    ]);

=======
    await cp_loadProfile();
    await cp_loadCatalogo();
    await cp_loadProveedores();
    
    // Inicializar efectos 3D de inclinación por ratón
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
    cp_initTiltEffect();
    switchClientTab('inicio');
}

<<<<<<< HEAD
=======
// ─── LÓGICA DE INCLINACIÓN MOUSE TILT 3D ──────────────────────────────────────
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
function cp_initTiltEffect() {
    setTimeout(() => {
        const cards = document.querySelectorAll('.card-3d');
        cards.forEach(card => {
            if (card.dataset.tiltBound) return;
            card.dataset.tiltBound = 'true';

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
<<<<<<< HEAD
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -8;
                const rotateY = ((x - centerX) / centerX) * 8;
=======
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -8; // Rotación máxima en X
                const rotateY = ((x - centerX) / centerX) * 8;  // Rotación máxima en Y
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-6px) scale(1.02)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px) scale(1)';
            });
        });
    }, 100);
}

<<<<<<< HEAD
function cp_setBellBadge(count) {
    const badge = document.getElementById('cp-nav-badge-notificaciones');
    const dot = document.getElementById('cp-notif-dot');
    const countText = count > 0 ? String(count) : '0';

    if (badge) badge.textContent = countText;
    if (dot) dot.style.display = count > 0 ? 'inline-block' : 'none';
}

function cp_formatFecha(value) {
    if (!value) return 'Por confirmar';
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return value;
    return date.toLocaleString('es-ES', {
        day: '2-digit',
        month: 'short',
        hour: '2-digit',
        minute: '2-digit'
    });
}

async function cp_loadProfile() {
    try {
        const res = await fetch('/api/me', cpFetchOptions);
        if (!res.ok) return;
        const user = await res.json();

        const profileRes = await fetch('/api/client/profile', cpFetchOptions);
        const profileData = profileRes.ok ? await profileRes.json() : null;

        cp_userProfile = {
            ...user,
            ...(profileData?.cliente || {}),
            ...(profileData?.usuario || {})
        };

        const nombre = cp_userProfile.nombreCompleto || user.nombreUsuario || 'Cliente';
        const inicial = nombre.charAt(0).toUpperCase();
        const rol = user.rol?.nombre || 'Cliente';
        const telefono = cp_userProfile.telefono || 'No registrado';
        const direccion = cp_userProfile.direccion || 'No registrada';
        const ci = cp_userProfile.ci_nit || 'No registrado';
        const sinceText = user.created_at ? 'Cliente desde ' + new Date(user.created_at).toLocaleDateString('es-ES', { month: 'long', year: 'numeric' }) : 'Cliente registrado';

        const navName = document.getElementById('cp-nav-name');
        if (navName) navName.textContent = nombre;

        const avatarInitial = document.getElementById('cp-avatar-initial');
        if (avatarInitial) avatarInitial.textContent = inicial;

        const heroName = document.getElementById('cp-hero-name');
        if (heroName) heroName.textContent = nombre;

        const profileAvatar = document.getElementById('cp-profile-avatar-large');
        if (profileAvatar) profileAvatar.textContent = inicial;

        const profileName = document.getElementById('cp-profile-name-large');
        if (profileName) profileName.textContent = nombre;

        const profileCompany = document.getElementById('cp-profile-company');
        if (profileCompany) profileCompany.textContent = 'Cliente Taller Automotriz';

        const profileSince = document.getElementById('cp-profile-since-large');
        if (profileSince) profileSince.textContent = sinceText;

        const infoNombre = document.getElementById('cp-info-nombre');
        if (infoNombre) infoNombre.textContent = nombre;

        const infoCi = document.getElementById('cp-info-ci');
        if (infoCi) infoCi.textContent = ci;

        const infoEmail = document.getElementById('cp-info-email');
        if (infoEmail) infoEmail.textContent = user.email || '—';

        const infoTelefono = document.getElementById('cp-info-telefono');
        if (infoTelefono) infoTelefono.textContent = telefono;

        const infoDireccion = document.getElementById('cp-info-direccion');
        if (infoDireccion) infoDireccion.textContent = direccion;

        const infoRol = document.getElementById('cp-info-rol');
        if (infoRol) infoRol.textContent = rol;


        cp_loadPermisos(user.rol?.idRol);
=======
// ─── CU02: PERFIL ─────────────────────────────────────────────────────────────
async function cp_loadProfile() {
    try {
        const res = await fetch('/api/me', { headers: cpHeaders });
        if (!res.ok) return;
        const user = await res.json();
        cp_userProfile = user;

        const nombre = user.nombreUsuario || 'Cliente';
        const inicial = nombre.charAt(0).toUpperCase();
        const rol = user.rol?.nombre || 'Cliente';

        // Navbar
        document.getElementById('cp-nav-name').textContent = nombre;
        document.getElementById('cp-avatar-initial').textContent = inicial;

        // Dashboard KPI
        const kpiRol = document.getElementById('cp-kpi-rol-val');
        if (kpiRol) kpiRol.textContent = rol;

        // Pestaña perfil principal
        document.getElementById('cp-profile-avatar-large').textContent = inicial;
        document.getElementById('cp-profile-name-large').textContent = nombre;
        document.getElementById('cp-profile-company').textContent = 'Cliente Taller Automotriz';
        
        // Fecha de creación
        const sinceText = user.created_at ? 'Cliente desde ' + new Date(user.created_at).toLocaleDateString('es-ES', {month: 'long', year: 'numeric'}) : 'Cliente registrado';
        document.getElementById('cp-profile-since-large').textContent = sinceText;

        // Datos Personales
        document.getElementById('cp-info-nombre').textContent = nombre;
        document.getElementById('cp-info-email').textContent = user.email;
        document.getElementById('cp-info-rol').textContent = rol;
        
        // Campos guardados localmente
        const storedEmpresa = localStorage.getItem('cp_empresa') || 'Comercial Taller S.A.';
        const storedTelefono = localStorage.getItem('cp_telefono') || '+591 70000000';
        const storedCiudad = localStorage.getItem('cp_ciudad') || 'Santa Cruz';

        document.getElementById('cp-info-empresa').textContent = storedEmpresa;
        document.getElementById('cp-info-telefono').textContent = storedTelefono;
        document.getElementById('cp-info-ciudad').textContent = storedCiudad;
        
        document.getElementById('cp-profile-company').textContent = storedEmpresa;

        // Permisos del rol
        cp_loadPermisos(user.rol?.idRol);

>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
    } catch (e) {
        console.error('cp_loadProfile error:', e);
    }
}

async function cp_loadPermisos(idRol) {
    const container = document.getElementById('cp-permisos-container');
    if (!container) return;

    if (!idRol) {
<<<<<<< HEAD
        container.innerHTML = '<p style="color:#9db8b0; font-size:0.85rem;">Sin permisos asignados.</p>';
=======
        container.innerHTML = '<p style="color:#64748b; font-size:0.85rem;">Sin permisos asignados.</p>';
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
        return;
    }

    try {
<<<<<<< HEAD
        const res = await fetch('/api/permisos', cpFetchOptions);
        if (!res.ok) {
            container.innerHTML = '<p style="color:#9db8b0; font-size:0.85rem;">No se pudieron cargar los permisos.</p>';
=======
        const res = await fetch('/api/permisos', { headers: cpHeaders });
        if (!res.ok) {
            container.innerHTML = '<p style="color:#64748b; font-size:0.85rem;">No se pudieron cargar los permisos.</p>';
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
            return;
        }

        const todos = await res.json();
        const misPermisos = todos.filter(p => p.idRol == idRol);

        if (misPermisos.length === 0) {
<<<<<<< HEAD
            container.innerHTML = '<p style="color:#9db8b0; font-size:0.85rem;">No hay permisos asociados a tu rol.</p>';
=======
            container.innerHTML = '<p style="color:#64748b; font-size:0.85rem;">No hay permisos asociados a tu rol.</p>';
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
            return;
        }

        container.innerHTML = misPermisos.map(p => `
            <span class="cp-permiso-chip">
                <i class="fa-solid fa-circle-check"></i>
                ${p.nombre} <span style="font-size:0.72rem; opacity:0.75;">(${p.modulo})</span>
            </span>
        `).join('');
<<<<<<< HEAD
    } catch (e) {
        container.innerHTML = '<p style="color:#9db8b0; font-size:0.85rem;">Error al cargar los permisos.</p>';
    }
}

async function cp_loadEstadoVehiculo() {
    const container = document.getElementById('cp-estado-vehiculo-wrap');
    if (!container) return;

    try {
        const res = await fetch('/api/client/estado-vehiculo', cpFetchOptions);
        const estados = res.ok ? await res.json() : [];

        if (!Array.isArray(estados) || estados.length === 0) {
            container.innerHTML = `
                <div class="cp-empty">
                    <i class="fa-solid fa-car-side"></i>
                    <p>No tienes vehículos en proceso en este momento. Pronto comenzaremos el diagnóstico.</p>
                </div>`;
            return;
        }

        container.innerHTML = estados.map(item => {
            const estado = item.estado || 'En revisión';
            const isTerminado = ['Terminado', 'Completado'].includes(estado);
            const estadoClass = isTerminado ? 'terminado' : '';
            const entrega = item.fechaEstimadaEntrega ? cp_formatFecha(item.fechaEstimadaEntrega) : 'Por confirmar';
            const inicio = item.fechaIngreso ? cp_formatFecha(item.fechaIngreso) : 'Sin registro';
            const sucursal = 'Sucursal principal';
            const mecanico = item.mecanico || 'Sin asignar';
            const telefono = item.telefonoMecanico || 'Tel. por confirmar';

            return `
                <article class="cp-estado-card card-3d ${estadoClass}">
                    ${isTerminado ? '<div class="cp-estado-listo-banner"><i class="fa-solid fa-circle-check"></i> Ya puedes recoger tu vehículo</div>' : ''}
                    <div class="cp-estado-top">
                        <div>
                            <span class="cp-status-badge" data-status="${estado}">${estado}</span>
                            <h3>Orden #${item.idOrden}</h3>
                        </div>
                        <div class="cp-estado-chip"><i class="fa-solid fa-location-dot"></i> ${sucursal}</div>
                    </div>
                    <div class="cp-estado-grid">
                        <div>
                            <span class="cp-label">Placa</span>
                            <strong>${item.placa || 'Sin vehículo'}</strong>
                        </div>
                        <div>
                            <span class="cp-label">Ingreso</span>
                            <strong>${inicio}</strong>
                        </div>
                        <div>
                            <span class="cp-label">Entrega estimada</span>
                            <strong>${entrega}</strong>
                        </div>
                        <div>
                            <span class="cp-label">Mecánico</span>
                            <strong>${mecanico}</strong>
                        </div>
                    </div>
                    <div class="cp-estado-footer">
                        <span><i class="fa-solid fa-phone"></i> ${telefono}</span>
                        <span><i class="fa-solid fa-spinner"></i> Progreso ${item.progreso || 0}%</span>
                    </div>
                </article>
            `;
        }).join('');

        cp_initTiltEffect();
    } catch (e) {
        console.error('cp_loadEstadoVehiculo error:', e);
        container.innerHTML = '<div class="cp-empty"><i class="fa-solid fa-circle-exclamation"></i><p>No se pudo cargar el estado del vehículo.</p></div>';
    }
}

async function cp_loadNotificaciones() {
    const container = document.getElementById('cp-notificaciones-container');
    if (!container) return;

    try {
        const res = await fetch('/api/client/notificaciones', cpFetchOptions);
        const items = res.ok ? await res.json() : [];

        const unreadCount = Array.isArray(items) ? items.filter(item => !item.leida).length : 0;
        cp_setBellBadge(unreadCount);

        if (!Array.isArray(items) || items.length === 0) {
            container.innerHTML = `
                <div class="cp-empty">
                    <i class="fa-regular fa-bell-slash"></i>
                    <p>No tienes notificaciones por el momento.</p>
                </div>`;
            return;
        }

        container.innerHTML = items.map(item => {
            const mensaje = item.mensaje || 'Sin mensaje';
            const isVehiculoListo = /vehículo listo|vehiculo listo|listo/i.test(mensaje);
            const className = isVehiculoListo ? 'cp-notif-item veh-listo' : 'cp-notif-item';
            return `
                <div class="${className}">
                    <div class="cp-timeline-dot"></div>
                    <div class="cp-timeline-content">
                        <div class="cp-timeline-title">${mensaje}</div>
                        <div class="cp-timeline-meta">${cp_formatFecha(item.fechaEnvio || item.created_at)}</div>
                    </div>
                </div>
            `;
        }).join('');
    } catch (e) {
        console.error('cp_loadNotificaciones error:', e);
        container.innerHTML = '<div class="cp-empty"><i class="fa-solid fa-circle-exclamation"></i><p>No se pudieron cargar las notificaciones.</p></div>';
    }
}

async function cp_loadHistorial() {
    const container = document.getElementById('cp-historial-container');
    if (!container) return;

    try {
        const res = await fetch('/api/client/historial', cpFetchOptions);
        const historial = res.ok ? await res.json() : [];

        if (!Array.isArray(historial) || historial.length === 0) {
            container.innerHTML = `
                <div class="cp-empty">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <p>Aún no tienes órdenes finalizadas.</p>
                </div>`;
            return;
        }

        container.innerHTML = historial.map(item => {
            const placa = item.vehiculo?.placa || 'Sin vehículo';
            const servicio = item.detalles?.[0]?.servicio?.nombre || 'Servicio completado';
            const total = item.total ? `Bs. ${Number(item.total).toLocaleString('es-BO', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}` : 'Sin total';
            return `
                <div class="cp-history-item card-3d">
                    <div class="cp-history-title">${servicio}</div>
                    <div class="cp-history-meta">${placa} • ${cp_formatFecha(item.fechaSalida || item.fechaIngreso)}</div>
                    <div class="cp-history-footer">
                        <span class="cp-status-badge" data-status="${item.estado || 'Completado'}">${item.estado || 'Completado'}</span>
                        <strong>${total}</strong>
                    </div>
                </div>
            `;
        }).join('');

        cp_initTiltEffect();
    } catch (e) {
        console.error('cp_loadHistorial error:', e);
        container.innerHTML = '<div class="cp-empty"><i class="fa-solid fa-circle-exclamation"></i><p>No se pudo cargar el historial.</p></div>';
    }
}

=======

    } catch (e) {
        container.innerHTML = '<p style="color:#64748b; font-size:0.85rem;">Error al cargar los permisos.</p>';
    }
}

// ─── CU03: CATÁLOGO (Servicio + TipoServicio) ─────────────────────────────────
const cpColorSchemes = [
    { border: 'border-purple', icon: 'cp-icon-purple', badge: 'cp-badge-purple', fa: 'fa-star' },
    { border: 'border-orange', icon: 'cp-icon-orange', badge: 'cp-badge-orange', fa: 'fa-wrench' },
    { border: 'border-green',  icon: 'cp-icon-green',  badge: 'cp-badge-green',  fa: 'fa-screwdriver-wrench' },
    { border: 'border-blue',   icon: 'cp-icon-blue',   badge: 'cp-badge-blue',   fa: 'fa-car' },
    { border: 'border-red',    icon: 'cp-icon-red',    badge: 'cp-badge-red',    fa: 'fa-oil-can' },
    { border: 'border-cyan',   icon: 'cp-icon-cyan',   badge: 'cp-badge-cyan',   fa: 'fa-gears' },
];

async function cp_loadCatalogo() {
    try {
        const [sRes, tRes] = await Promise.all([
            fetch('/api/servicios', { headers: cpHeaders }),
            fetch('/api/tipos-servicio', { headers: cpHeaders })
        ]);

        cp_allServicios = sRes.ok ? await sRes.json() : [];
        cp_allTipos     = tRes.ok ? await tRes.json() : [];

        // Actualizar contador KPI en Inicio
        const kpiServ = document.getElementById('cp-kpi-servicios-val');
        if (kpiServ) kpiServ.textContent = cp_allServicios.length;

        // Crear pills de tipo de servicio
        const pillsContainer = document.getElementById('cp-tipo-pills');
        if (pillsContainer && cp_allTipos.length > 0) {
            const tiposHtml = cp_allTipos.map(t =>
                `<button class="cp-pill" data-tipo="${t.idTipoServicio}">${t.nombre}</button>`
            ).join('');
            pillsContainer.innerHTML = `<button class="cp-pill active" data-tipo="todos">Todos los servicios</button>${tiposHtml}`;

            pillsContainer.querySelectorAll('.cp-pill').forEach(pill => {
                pill.addEventListener('click', function () {
                    pillsContainer.querySelectorAll('.cp-pill').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    const tipo = this.dataset.tipo;
                    if (tipo === 'todos') {
                        cp_renderCatalogo(cp_allServicios);
                    } else {
                        cp_renderCatalogo(cp_allServicios.filter(s => s.idTipoServicio == tipo));
                    }
                });
            });
        }

        cp_renderCatalogo(cp_allServicios);

    } catch (e) {
        document.getElementById('cp-catalog-container').innerHTML =
            '<div class="cp-loading">Error al cargar el catálogo.</div>';
    }
}

function cp_renderCatalogo(servicios) {
    const container = document.getElementById('cp-catalog-container');
    if (!container) return;

    if (!servicios || servicios.length === 0) {
        container.innerHTML = `
            <div class="cp-empty" style="grid-column:1/-1">
                <i class="fa-solid fa-box-open"></i>
                <p>No se encontraron servicios disponibles en esta categoría.</p>
            </div>`;
        return;
    }

    container.innerHTML = servicios.map((s, i) => {
        const scheme = cpColorSchemes[i % cpColorSchemes.length];
        const tipo = cp_allTipos.find(t => t.idTipoServicio === s.idTipoServicio);
        const tipoNombre = tipo?.nombre || 'Servicio';
        const precio = parseFloat(s.precioBase).toLocaleString('es-BO', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        const duracion = s.duracionEstimada ? `${s.duracionEstimada} min aprox.` : 'Consultar tiempo';

        return `
            <div class="cp-service-card card-3d">
                <div class="cp-card-top">
                    <div class="cp-service-icon ${scheme.icon}">
                        <i class="fa-solid ${scheme.fa}"></i>
                    </div>
                    <span class="cp-service-badge ${scheme.badge}">${tipoNombre}</span>
                </div>
                <h3>${s.nombre}</h3>
                <p class="cp-service-desc">Servicio automotriz especializado con garantía de calidad y atención profesional.</p>
                <div class="cp-service-footer">
                    <div>
                        <div class="cp-service-price">Bs. ${precio}</div>
                        <div class="cp-service-price-meta"><i class="fa-regular fa-clock"></i> ${duracion}</div>
                    </div>
                    <button class="cp-btn cp-btn-primary" style="padding: 0.5rem 0.9rem; font-size: 0.8rem; border-radius: 12px;">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        `;
    }).join('');

    // Re-vincular inclinación 3D en los nuevos elementos renderizados
    cp_initTiltEffect();
}

// ─── CU04: PROVEEDORES ────────────────────────────────────────────────────────
async function cp_loadProveedores() {
    try {
        const res = await fetch('/api/proveedores', { headers: cpHeaders });
        cp_allProveedores = res.ok ? await res.json() : [];
        
        // Actualizar contador KPI en Inicio
        const kpiProv = document.getElementById('cp-kpi-prov-val');
        if (kpiProv) kpiProv.textContent = cp_allProveedores.length;

        cp_renderProveedores(cp_allProveedores);
    } catch (e) {
        document.getElementById('cp-proveedores-container').innerHTML =
            '<div class="cp-empty"><i class="fa-solid fa-circle-exclamation"></i><p>Error al cargar proveedores.</p></div>';
    }
}

function cp_renderProveedores(proveedores) {
    const container = document.getElementById('cp-proveedores-container');
    if (!container) return;

    if (!proveedores || proveedores.length === 0) {
        container.innerHTML = `
            <div class="cp-empty" style="grid-column: 1 / -1;">
                <i class="fa-solid fa-truck-fade"></i>
                <p>No se encontraron proveedores registrados.</p>
            </div>`;
        return;
    }

    container.innerHTML = proveedores.map(p => `
        <div class="cp-proveedor-card card-3d">
            <div class="cp-proveedor-header">
                <div class="cp-proveedor-logo">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="cp-proveedor-info">
                    <h4 class="cp-proveedor-name">${p.razonSocial}</h4>
                    <div class="cp-proveedor-meta">
                        <i class="fa-solid fa-phone" style="font-size:0.75rem;"></i> ${p.telefono || 'Sin teléfono'}
                    </div>
                </div>
            </div>
            
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span class="cp-proveedor-nit">NIT: ${p.nit}</span>
                <span class="cp-status-badge cp-status-completed"><i class="fa-solid fa-circle-check"></i> Aliado Oficial</span>
            </div>

            <div class="cp-proveedor-contact">
                <span style="font-size:0.82rem; color:#64748b; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">
                    <i class="fa-regular fa-envelope" style="color:#6366f1;"></i> ${p.email || 'contacto@proveedor.com'}
                </span>
            </div>
        </div>
    `).join('');

    cp_initTiltEffect();
}

function filterProveedores(q) {
    const query = q.toLowerCase();
    const filtrados = cp_allProveedores.filter(p =>
        p.razonSocial.toLowerCase().includes(query) ||
        p.nit.toLowerCase().includes(query) ||
        (p.email && p.email.toLowerCase().includes(query))
    );
    cp_renderProveedores(filtrados);
}

// ─── NAVEGACIÓN POR PESTAÑAS ──────────────────────────────────────────────────
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
function switchClientTab(tab) {
    document.querySelectorAll('.cp-tab-content').forEach(t => t.classList.remove('active'));
    const target = document.getElementById(`cp-tab-${tab}`);
    if (target) target.classList.add('active');

    document.querySelectorAll('.cp-nav-link').forEach(l => l.classList.remove('active'));
    const navBtn = document.getElementById(`cp-nav-btn-${tab}`);
    if (navBtn) navBtn.classList.add('active');

<<<<<<< HEAD
    if (tab === 'historial') {
        cp_loadHistorial();
    }

    if (tab === 'notificaciones') {
        cp_loadNotificaciones();
    }
}

function cp_openEditProfileModal() {
    if (!cp_userProfile) return;

    const nombreInput = document.getElementById('cp_edit_nombre');
    const telefonoInput = document.getElementById('cp_edit_telefono');
    const direccionInput = document.getElementById('cp_edit_direccion');
    const emailInput = document.getElementById('cp_edit_email');
    const passwordInput = document.getElementById('cp_edit_password');

    if (nombreInput) nombreInput.value = cp_userProfile.nombreCompleto || cp_userProfile.nombreUsuario || '';
    if (telefonoInput) telefonoInput.value = cp_userProfile.telefono || '';
    if (direccionInput) direccionInput.value = cp_userProfile.direccion || '';
    if (emailInput) emailInput.value = cp_userProfile.email || '';
    if (passwordInput) passwordInput.value = '';

    switchClientTab('editar-perfil');
}

function cp_closeEditProfileModal() {
    switchClientTab('perfil');
=======
    if (tab === 'mis-servicios' && typeof cp_loadSolicitudes === 'function') {
        cp_loadSolicitudes();
    }
}

// ─── EDICIÓN DE PERFIL ──────────────────────────────────────────────────────
function cp_openEditProfileModal() {
    if (!cp_userProfile) return;
    
    document.getElementById('cp_edit_nombre').value = cp_userProfile.nombreUsuario;
    document.getElementById('cp_edit_email').value = cp_userProfile.email;
    document.getElementById('cp_edit_password').value = '';
    
    document.getElementById('cp_edit_empresa').value = localStorage.getItem('cp_empresa') || 'Comercial Taller S.A.';
    document.getElementById('cp_edit_telefono').value = localStorage.getItem('cp_telefono') || '+591 70000000';
    document.getElementById('cp_edit_ciudad').value = localStorage.getItem('cp_ciudad') || 'Santa Cruz';
    
    document.getElementById('cp-edit-profile-modal').style.display = 'flex';
}

function cp_closeEditProfileModal() {
    document.getElementById('cp-edit-profile-modal').style.display = 'none';
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
}

async function cp_handleEditProfile(e) {
    e.preventDefault();
    if (!cp_userProfile) return;

<<<<<<< HEAD
    const nombre = document.getElementById('cp_edit_nombre')?.value || '';
    const telefono = document.getElementById('cp_edit_telefono')?.value || '';
    const direccion = document.getElementById('cp_edit_direccion')?.value || '';
    const email = document.getElementById('cp_edit_email')?.value || '';
    const password = document.getElementById('cp_edit_password')?.value || '';

    const body = {
        nombreCompleto: nombre,
        telefono,
        direccion,
        email
    };

    if (password.trim() !== '') {
        body.contrasena = password;
    }

    try {
        const res = await fetch('/api/client/profile', {
            method: 'PUT',
            headers: cpHeaders,
            credentials: 'same-origin',
=======
    const nombre = document.getElementById('cp_edit_nombre').value;
    const email = document.getElementById('cp_edit_email').value;
    const pass = document.getElementById('cp_edit_password').value;

    let body = {
        nombreUsuario: nombre,
        email: email
    };
    
    if (pass.trim() !== '') {
        body.contrasena = pass;
    }

    try {
        const empresa = document.getElementById('cp_edit_empresa').value;
        const telefono = document.getElementById('cp_edit_telefono').value;
        const ciudad = document.getElementById('cp_edit_ciudad').value;
        
        localStorage.setItem('cp_empresa', empresa);
        localStorage.setItem('cp_telefono', telefono);
        localStorage.setItem('cp_ciudad', ciudad);

        const res = await fetch(`/api/usuarios/${cp_userProfile.idUsuario}`, {
            method: 'PUT',
            headers: cpHeaders,
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
            body: JSON.stringify(body)
        });

        if (res.ok) {
            alert('Perfil actualizado con éxito');
<<<<<<< HEAD
            switchClientTab('perfil');
=======
            cp_closeEditProfileModal();
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
            await cp_loadProfile();
        } else {
            const err = await res.json();
            alert('Error al actualizar: ' + (err.message || 'Datos inválidos'));
        }
    } catch (error) {
        console.error('Error editando perfil:', error);
        alert('Error al conectar con el servidor');
    }
}

<<<<<<< HEAD
const originalInitClientPortal = initClientPortal;
initClientPortal = async function () {
    await originalInitClientPortal();
=======
// ─── MANEJO DE SOLICITUDES DE SERVICIO ──────────────────────────────────────
function cp_openSolicitudModal() {
    const select = document.getElementById('cp_sol_servicio');
    if (select && cp_allServicios.length > 0) {
        select.innerHTML = '<option value="">— Selecciona un servicio —</option>' +
            cp_allServicios.map(s => `<option value="${s.idServicio}">${s.nombre} (Bs. ${s.precioBase})</option>`).join('');
    }
    document.getElementById('cp-solicitud-modal').style.display = 'flex';
}

function cp_closeSolicitudModal() {
    document.getElementById('cp-solicitud-modal').style.display = 'none';
}

async function cp_handleSolicitud(e) {
    e.preventDefault();
    const idServicio = document.getElementById('cp_sol_servicio').value;
    const placa = document.getElementById('cp_sol_placa').value;
    const desc = document.getElementById('cp_sol_descripcion').value;

    if (!idServicio || !placa) {
        alert('Por favor completa los campos obligatorios');
        return;
    }

    const servicio = cp_allServicios.find(s => s.idServicio == idServicio);
    const nuevaSol = {
        id: Date.now(),
        servicio: servicio ? servicio.nombre : 'Servicio Técnico',
        placa: placa,
        descripcion: desc,
        estado: 'Pendiente',
        fecha: new Date().toLocaleDateString('es-ES', { day: '2-digit', month: 'short', year: 'numeric' })
    };

    let solicitudes = JSON.parse(localStorage.getItem('cp_solicitudes') || '[]');
    solicitudes.unshift(nuevaSol);
    localStorage.setItem('cp_solicitudes', JSON.stringify(solicitudes));

    alert('¡Solicitud registrada correctamente! Un asesor de nuestro taller te contactará a la brevedad.');
    cp_closeSolicitudModal();
    cp_loadSolicitudes();
}

function cp_loadSolicitudes() {
    const container = document.getElementById('cp-solicitudes-container');
    if (!container) return;

    let solicitudes = JSON.parse(localStorage.getItem('cp_solicitudes') || '[]');
    if (solicitudes.length === 0) {
        container.innerHTML = `
            <div class="cp-quick-access" style="text-align:center; padding:3rem 1.5rem;">
                <i class="fa-solid fa-wrench" style="font-size:2.5rem; color:#a5b4fc; margin-bottom:1rem;"></i>
                <h3 style="font-size:1.1rem; color:#0f172a; margin-bottom:0.4rem;">No tienes solicitudes activas</h3>
                <p style="font-size:0.88rem; color:#64748b; margin-bottom:1.5rem;">Haz clic en el botón superior para solicitar una revisión o mantenimiento para tu vehículo.</p>
                <button class="cp-btn cp-btn-primary" onclick="cp_openSolicitudModal()"><i class="fa-solid fa-plus"></i> Solicitar primer servicio</button>
            </div>`;
        return;
    }

    container.innerHTML = solicitudes.map(s => `
        <div class="cp-solicitud-card">
            <div class="cp-solicitud-info">
                <div class="cp-solicitud-title">${s.servicio} — Vehículo: <span style="color:#6366f1;">${s.placa}</span></div>
                <div class="cp-solicitud-sub">${s.descripcion ? s.descripcion : 'Sin observaciones adicionales'} • Registrado el ${s.fecha}</div>
            </div>
            <div>
                <span class="cp-solicitud-badge" style="background:#fffbeb; color:#d97706;"><i class="fa-solid fa-clock"></i> ${s.estado}</span>
            </div>
        </div>
    `).join('');
}

// Enganchar carga de solicitudes en initClientPortal
const originalInitClientPortal = initClientPortal;
initClientPortal = async function() {
    await originalInitClientPortal();
    cp_loadSolicitudes();
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
};

