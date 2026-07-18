// ================================================================
// client.js — Portal del Cliente
// Usa los mismos endpoints del sistema admin:
//   CU01: /api/me, /api/login, /api/logout
//   CU02: /api/me (con rol y permisos)
//   CU03: /api/servicios, /api/tipos-servicio
//   CU04: /api/proveedores
// ================================================================

const cpHeaders = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
};

// Estado del portal
let cp_allServicios = [];
let cp_allProveedores = [];
let cp_allTipos = [];
let cp_userProfile = null;

// ─── INIT ─────────────────────────────────────────────────────────────────────
async function initClientPortal() {
    // Evitar inicializar múltiples veces
    if (window._cpInitialized) return;
    window._cpInitialized = true;

    await cp_loadProfile();
    await cp_loadCatalogo();
    await cp_loadProveedores();
    switchClientTab('inicio');
}

// ─── CU02: PERFIL ─────────────────────────────────────────────────────────────
async function cp_loadProfile() {
    try {
        const res = await fetch('/api/me', { headers: cpHeaders });
        if (!res.ok) return;
        const user = await res.json();
        cp_userProfile = user;

        const nombre = user.nombreUsuario || 'Cliente';
        const inicial = nombre.charAt(0).toUpperCase();
        const rol = user.rol?.nombre || 'Sin rol';

        // Navbar
        document.getElementById('cp-nav-name').textContent = nombre;
        document.getElementById('cp-avatar-initial').textContent = inicial;

        // Pestaña perfil principal
        document.getElementById('cp-profile-avatar-large').textContent = inicial;
        document.getElementById('cp-profile-name-large').textContent = nombre;
        document.getElementById('cp-profile-company').textContent = 'Cliente SisGest';
        
        // Fecha de creación
        const sinceText = user.created_at ? 'Cliente desde ' + new Date(user.created_at).toLocaleDateString('es-ES', {month: 'long', year: 'numeric'}) : 'Cliente desde 2024';
        document.getElementById('cp-profile-since-large').textContent = sinceText;

        // Datos Personales
        document.getElementById('cp-info-nombre').textContent = nombre;
        document.getElementById('cp-info-email').textContent = user.email;
        document.getElementById('cp-info-rol').textContent = rol;
        // Campos que no existen nativamente en la tabla usuario pero los simulamos visualmente para cumplir el diseño
        const storedEmpresa = localStorage.getItem('cp_empresa') || 'Comercial SisGest S.A.';
        const storedTelefono = localStorage.getItem('cp_telefono') || '+591 70000000';
        const storedCiudad = localStorage.getItem('cp_ciudad') || 'Santa Cruz';

        document.getElementById('cp-info-empresa').textContent = storedEmpresa;
        document.getElementById('cp-info-telefono').textContent = storedTelefono;
        document.getElementById('cp-info-ciudad').textContent = storedCiudad;
        
        // Actualizar header con la empresa
        document.getElementById('cp-profile-company').textContent = storedEmpresa;

        // Permisos del rol
        cp_loadPermisos(user.rol?.idRol);

    } catch (e) {
        console.error('cp_loadProfile error:', e);
    }
}

async function cp_loadPermisos(idRol) {
    const container = document.getElementById('cp-permisos-container');
    if (!container) return;

    if (!idRol) {
        container.innerHTML = '<p class="cp-text-muted">Sin permisos asignados.</p>';
        return;
    }

    try {
        const res = await fetch('/api/permisos', { headers: cpHeaders });
        if (!res.ok) {
            container.innerHTML = '<p class="cp-text-muted">No se pudieron cargar los permisos.</p>';
            return;
        }

        const todos = await res.json();
        // Filtrar permisos del rol del usuario actual
        const misPermisos = todos.filter(p => p.idRol == idRol);

        if (misPermisos.length === 0) {
            container.innerHTML = '<p class="cp-text-muted">No hay permisos registrados para tu rol.</p>';
            return;
        }

        container.innerHTML = misPermisos.map(p => `
            <span class="cp-permiso-chip">
                <i class="fa-solid fa-circle-check"></i>
                ${p.nombre} <span style="font-size:0.7rem;color:#94a3b8;">(${p.modulo})</span>
            </span>
        `).join('');

    } catch (e) {
        container.innerHTML = '<p class="cp-text-muted">Error al cargar permisos.</p>';
    }
}

// ─── CU03: CATÁLOGO (Servicio + TipoServicio) ─────────────────────────────────
const cpColorSchemes = [
    { border: 'border-purple', icon: 'cp-icon-purple', badge: 'cp-badge-purple', fa: 'fa-star' },
    { border: 'border-orange', icon: 'cp-icon-orange', badge: 'cp-badge-orange', fa: 'fa-wrench' },
    { border: 'border-green',  icon: 'cp-icon-green',  badge: 'cp-badge-green',  fa: 'fa-screwdriver-wrench' },
    { border: 'border-blue',   icon: 'cp-icon-blue',   badge: 'cp-badge-blue',   fa: 'fa-car' },
    { border: 'border-red',    icon: 'cp-icon-red',    badge: 'cp-badge-red',    fa: 'fa-oil-can' },
];

async function cp_loadCatalogo() {
    try {
        const [sRes, tRes] = await Promise.all([
            fetch('/api/servicios', { headers: cpHeaders }),
            fetch('/api/tipos-servicio', { headers: cpHeaders })
        ]);

        cp_allServicios = sRes.ok ? await sRes.json() : [];
        cp_allTipos     = tRes.ok ? await tRes.json() : [];

        // Crear pills de tipo de servicio
        const pillsContainer = document.getElementById('cp-tipo-pills');
        if (pillsContainer && cp_allTipos.length > 0) {
            const tiposHtml = cp_allTipos.map(t =>
                `<button class="cp-pill" data-tipo="${t.idTipoServicio}">${t.nombre}</button>`
            ).join('');
            pillsContainer.innerHTML = `<button class="cp-pill active" data-tipo="todos">Todos</button>${tiposHtml}`;

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
                No hay servicios disponibles en esta categoría.
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
        const duracion = s.duracionEstimada ? `· ${s.duracionEstimada} min` : '';

        return `
            <div class="cp-service-card ${scheme.border}">
                <div class="cp-card-top">
                    <div class="cp-service-icon ${scheme.icon}">
                        <i class="fa-solid ${scheme.fa}"></i>
                    </div>
                    <span class="cp-service-badge ${scheme.badge}">${tipoNombre}</span>
                </div>
                <h3>${s.nombre}</h3>
                <p style="color:#94a3b8; font-size:0.8rem;">${duracion ? 'Duración estimada: ' + s.duracionEstimada + ' min' : 'Consultar disponibilidad'}</p>
                <div class="cp-service-price">Bs. ${precio}</div>
            </div>
        `;
    }).join('');
}

// ─── CU04: PROVEEDORES ────────────────────────────────────────────────────────
async function cp_loadProveedores() {
    try {
        const res = await fetch('/api/proveedores', { headers: cpHeaders });
        cp_allProveedores = res.ok ? await res.json() : [];
        cp_renderProveedores(cp_allProveedores);
    } catch (e) {
        document.getElementById('cp-proveedores-container').innerHTML =
            '<div class="cp-empty"><i class="fa-solid fa-circle-exclamation"></i>Error al cargar proveedores.</div>';
    }
}

function cp_renderProveedores(proveedores) {
    const container = document.getElementById('cp-proveedores-container');
    if (!container) return;

    if (!proveedores || proveedores.length === 0) {
        container.innerHTML = `
            <div class="cp-empty">
                <i class="fa-solid fa-truck"></i>
                No hay proveedores registrados.
            </div>`;
        return;
    }

    container.innerHTML = proveedores.map(p => `
        <div class="cp-proveedor-item">
            <div class="cp-prov-icon"><i class="fa-solid fa-building"></i></div>
            <div class="cp-prov-info">
                <h4>${p.razonSocial}</h4>
                <p>NIT: ${p.nit}${p.telefono ? ' · Tel: ' + p.telefono : ''}${p.email ? ' · ' + p.email : ''}</p>
            </div>
            <div class="cp-prov-meta">
                <span class="cp-status-badge cp-status-completed">
                    <i class="fa-solid fa-circle-check"></i> Activo
                </span>
            </div>
        </div>
    `).join('');
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
function switchClientTab(tab) {
    document.querySelectorAll('.cp-tab-content').forEach(t => t.classList.remove('active'));
    const target = document.getElementById(`cp-tab-${tab}`);
    if (target) target.classList.add('active');

    document.querySelectorAll('.cp-nav-link').forEach(l => l.classList.remove('active'));
    const navBtn = document.getElementById(`cp-nav-btn-${tab}`);
    if (navBtn) navBtn.classList.add('active');
}

// ─── EDICIÓN DE PERFIL ──────────────────────────────────────────────────────
function cp_openEditProfileModal() {
    if (!cp_userProfile) return;
    
    document.getElementById('cp_edit_nombre').value = cp_userProfile.nombreUsuario;
    document.getElementById('cp_edit_email').value = cp_userProfile.email;
    document.getElementById('cp_edit_password').value = '';
    
    document.getElementById('cp_edit_empresa').value = localStorage.getItem('cp_empresa') || 'Comercial SisGest S.A.';
    document.getElementById('cp_edit_telefono').value = localStorage.getItem('cp_telefono') || '+591 70000000';
    document.getElementById('cp_edit_ciudad').value = localStorage.getItem('cp_ciudad') || 'Santa Cruz';
    
    document.getElementById('cp-edit-profile-modal').style.display = 'flex';
}

function cp_closeEditProfileModal() {
    document.getElementById('cp-edit-profile-modal').style.display = 'none';
}

async function cp_handleEditProfile(e) {
    e.preventDefault();
    if (!cp_userProfile) return;

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
        // Guardar campos simulados en el LocalStorage
        const empresa = document.getElementById('cp_edit_empresa').value;
        const telefono = document.getElementById('cp_edit_telefono').value;
        const ciudad = document.getElementById('cp_edit_ciudad').value;
        
        localStorage.setItem('cp_empresa', empresa);
        localStorage.setItem('cp_telefono', telefono);
        localStorage.setItem('cp_ciudad', ciudad);

        const res = await fetch(`/api/usuarios/${cp_userProfile.idUsuario}`, {
            method: 'PUT',
            headers: cpHeaders,
            body: JSON.stringify(body)
        });

        if (res.ok) {
            alert('Perfil actualizado con éxito');
            cp_closeEditProfileModal();
            // Recargar perfil para actualizar UI
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

