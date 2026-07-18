        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        let currentView = 'panel';
        let currentData = [];
        let allRoles = [];
        let allTiposServicio = [];
        let editingId = null;

        // View Configurations
        const viewConfigs = {
            panel: {
                title: "Panel principal",
                subtitle: "Sistema de Gestión Empresarial",
                search: false,
                cols: [],
                loadData: async () => []
            },
            usuarios: {
                title: "Usuarios",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Gestión de Usuarios",
                cardSubtitle: "usuarios registrados · CU02",
                actionText: "Nuevo usuario",
                actionFn: () => openAddModal('usuarios'),
                search: true,
                cols: ["#", "Nombre completo", "Correo electrónico", "Rol", "Estado", "Creado", "Acciones"],
                loadData: async () => {
                    const res = await fetch('/api/usuarios', { headers });
                    return res.ok ? await res.json() : [];
                }
            },
            roles: {
                title: "Roles",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Gestión de Roles",
                cardSubtitle: "roles configurados · CU02",
                actionText: "Nuevo rol",
                actionFn: () => openAddModal('roles'),
                search: true,
                cols: ["#", "NOMBRE DEL ROL", "DESCRIPCIÓN", "PERMISOS", "USUARIOS", "ACCIONES"],
                loadData: async () => {
                    const res = await fetch('/api/roles', { headers });
                    return res.ok ? await res.json() : [];
                }
            },
            permisos: {
                title: "Permisos",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Gestión de Permisos",
                cardSubtitle: "permisos registrados · CU02",
                actionText: "Nuevo permiso",
                actionFn: () => openAddModal('permisos'),
                search: true,
                cols: ["#", "Permiso", "Módulo", "ID Rol Relacionado", "Acciones"],
                loadData: async () => {
                    const res = await fetch('/api/permisos', { headers });
                    return res.ok ? await res.json() : [];
                }
            },
            'tipos-servicio': {
                title: "Tipos de Servicio",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Categorías de Servicio",
                cardSubtitle: "categorías para catálogo · CU03",
                actionText: "Nuevo tipo",
                actionFn: () => openAddModal('tipos-servicio'),
                search: true,
                cols: ["#", "Nombre Categoría", "Descripción", "Acciones"],
                loadData: async () => {
                    const res = await fetch('/api/tipos-servicio', { headers });
                    return res.ok ? await res.json() : [];
                }
            },
            servicios: {
                title: "Servicios",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Gestión de Servicios",
                cardSubtitle: "servicios del catálogo · CU03",
                actionText: "Nuevo servicio",
                actionFn: () => openAddModal('servicios'),
                search: true,
                cols: ["#", "Nombre Servicio", "Precio Base", "Duración Estimada", "Categoría", "Acciones"],
                loadData: async () => {
                    const res = await fetch('/api/servicios', { headers });
                    return res.ok ? await res.json() : [];
                }
            },
            proveedores: {
                title: "Proveedores",
                subtitle: "Sistema de Gestión Empresarial",
                cardTitle: "Gestión de Proveedores",
                cardSubtitle: "proveedores registrados · CU04",
                actionText: "Nuevo proveedor",
                actionFn: () => openAddModal('proveedores'),
                search: true,
                cols: ["#", "Razón Social", "NIT", "Teléfono", "Email", "Acciones"],
                loadData: async () => {
                    const res = await fetch('/api/proveedores', { headers });
                    return res.ok ? await res.json() : [];
                }
            }
        };

        // Switch View controller
        async function switchView(viewName) {
            currentView = viewName;
            editingId = null;

            document.querySelectorAll('.menu-item').forEach(el => el.classList.remove('active'));
            const activeNav = document.getElementById(`nav-${viewName}`);
            if (activeNav) activeNav.classList.add('active');

            const conf = viewConfigs[viewName];
            document.getElementById('viewTitle').textContent = conf.title;
            document.getElementById('viewSubtitle').textContent = conf.subtitle;

            const panelEl = document.getElementById('panelDashboard');
            const tableEl = document.getElementById('tableView');

            if (viewName === 'panel') {
                panelEl.style.display = 'block';
                tableEl.style.display = 'none';
                await loadPanelDashboard();
            } else {
                panelEl.style.display = 'none';
                tableEl.style.display = 'block';
                document.getElementById('cardTitle').textContent = conf.cardTitle;
                document.getElementById('cardSubtitle').textContent = conf.cardSubtitle;
                document.getElementById('cardActionText').textContent = conf.actionText;
                document.getElementById('searchContainerBox').style.display = conf.search ? 'block' : 'none';
                const head = document.getElementById('tableHead');
                head.innerHTML = '<tr>' + conf.cols.map(c => `<th>${c}</th>`).join('') + '</tr>';
                await refreshData();
            }
        }

        // Load all dashboard KPI data
        async function loadPanelDashboard() {
            try {
                const [usuRes, rolRes, servRes, provRes] = await Promise.all([
                    fetch('/api/usuarios', { headers }),
                    fetch('/api/roles', { headers }),
                    fetch('/api/servicios', { headers }),
                    fetch('/api/proveedores', { headers })
                ]);
                const usuarios   = usuRes.ok  ? await usuRes.json()  : [];
                const roles      = rolRes.ok  ? await rolRes.json()  : [];
                const servicios  = servRes.ok ? await servRes.json() : [];
                const proveedores= provRes.ok ? await provRes.json(): [];

                // KPI counters
                document.getElementById('kpi-usuarios').textContent   = usuarios.length;
                document.getElementById('kpi-roles').textContent      = roles.length;
                document.getElementById('kpi-servicios').textContent  = servicios.length;
                document.getElementById('kpi-proveedores').textContent = proveedores.length;

                // Bar chart
                const bars = [
                    { label: 'Usuarios',    val: usuarios.length,    color: '#2563eb' },
                    { label: 'Roles',       val: roles.length,       color: '#0891b2' },
                    { label: 'Servicios',   val: servicios.length,   color: '#d97706' },
                    { label: 'Proveedores', val: proveedores.length, color: '#059669' }
                ];
                const maxVal = Math.max(...bars.map(b => b.val), 1);
                const chartWrap = document.getElementById('barChartWrap');
                chartWrap.innerHTML = bars.map(b => {
                    const pct = Math.round((b.val / maxVal) * 100);
                    return `
                        <div class="bar-item">
                            <span class="bar-label">${b.label}</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width:${pct}%;background:${b.color};" data-pct="${pct}"></div>
                            </div>
                            <span class="bar-count">${b.val}</span>
                        </div>`;
                }).join('');
                // Animate bars
                setTimeout(() => {
                    document.querySelectorAll('.bar-fill').forEach(el => {
                        el.style.width = el.dataset.pct + '%';
                    });
                }, 50);

                // Recent users
                const recentWrap = document.getElementById('recentUsersWrap');
                if (usuarios.length === 0) {
                    recentWrap.innerHTML = `<p style="color:#94a3b8;font-size:0.85rem;padding:1rem 0;">Sin usuarios registrados.</p>`;
                } else {
                    recentWrap.innerHTML = usuarios.slice(0, 5).map(u => {
                        const initials = (u.nombreUsuario || 'U').substring(0, 2).toUpperCase();
                        const rol = u.rol ? u.rol.nombre : 'Sin rol';
                        return `
                        <div class="recent-user-row">
                            <div class="recent-user-avatar">${initials}</div>
                            <div class="recent-user-info">
                                <span class="recent-user-name">${u.nombreUsuario}</span>
                                <span class="recent-user-email">${u.email}</span>
                            </div>
                            <span class="recent-user-role">${rol}</span>
                        </div>`;
                    }).join('');
                }
            } catch (e) {
                console.error('Error cargando dashboard:', e);
            }
        }

        // Refresh database info and populate table
        async function refreshData() {
            const conf = viewConfigs[currentView];
            try {
                currentData = await conf.loadData();
                
                // Update subtitle counts if applicable
                if (currentView === 'usuarios') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} usuarios registrados · CU02`;
                } else if (currentView === 'roles') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} roles configurados · CU02`;
                } else if (currentView === 'permisos') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} permisos registrados · CU02`;
                } else if (currentView === 'tipos-servicio') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} categorías para catálogo · CU03`;
                } else if (currentView === 'servicios') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} servicios del catálogo · CU03`;
                } else if (currentView === 'proveedores') {
                    document.getElementById('cardSubtitle').textContent = `${currentData.length} proveedores registrados · CU04`;
                }

                renderTable(currentData);
            } catch (err) {
                console.error("Error cargando datos:", err);
            }
        }

        // Render data to table
        function renderTable(data) {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="10" style="text-align: center; color: var(--text-subtitle); padding: 2rem;">No hay registros encontrados.</td></tr>`;
                return;
            }

            data.forEach((item, index) => {
                let rowHtml = '';

                if (currentView === 'usuarios') {
                    const avatarText = item.nombreUsuario ? item.nombreUsuario.substring(0, 2).toUpperCase() : 'US';
                    const statusClass = item.estado === 1 ? 'activo' : 'inactivo';
                    const statusLabel = item.estado === 1 ? 'Activo' : 'Inactivo';
                    const createdDate = item.created_at ? new Date(item.created_at).toLocaleDateString('es-ES', { timeZone: 'UTC', year: 'numeric', month: 'short', day: 'numeric' }) : 'No disponible';
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td class="avatar-cell">
                                <div class="cell-avatar">${avatarText}</div>
                                <span>${item.nombreUsuario}</span>
                            </td>
                            <td>${item.email}</td>
                            <td><span class="role-badge">${item.rol ? item.rol.nombre : 'Sin Rol'}</span></td>
                            <td><span class="status-badge ${statusClass}">${statusLabel}</span></td>
                            <td style="color:#64748b; font-size:0.85rem;">${createdDate}</td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idUsuario})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idUsuario})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                } else if (currentView === 'roles') {
                    const countPermisos = item.permisos_count || 0;
                    const countUsuarios = item.usuarios_count || 0;
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${item.nombre}</strong></td>
                            <td style="color: #64748b;">${item.descripcion || '-'}</td>
                            <td><span style="background: #e0e7ff; color: #4338ca; padding: 0.35rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;">${countPermisos} permisos</span></td>
                            <td><span style="background: #f1f5f9; color: #475569; padding: 0.35rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;">${countUsuarios} usuarios</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idRol})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idRol})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                } else if (currentView === 'permisos') {
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${item.nombre}</strong></td>
                            <td><span class="role-badge" style="background-color: #f1f5f9; color: #475569;">${item.modulo}</span></td>
                            <td>ID: ${item.idRol}</td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idPermiso})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idPermiso})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                } else if (currentView === 'tipos-servicio') {
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${item.nombre}</strong></td>
                            <td>${item.descripcion || '-'}</td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idTipoServicio})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idTipoServicio})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                } else if (currentView === 'servicios') {
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${item.nombre}</strong></td>
                            <td>${item.precioBase} USD</td>
                            <td>${item.duracionEstimada ? item.duracionEstimada + ' min' : '-'}</td>
                            <td><span class="role-badge">${item.tipo_servicio ? item.tipo_servicio.nombre : 'ID: ' + item.idTipoServicio}</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idServicio})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idServicio})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                } else if (currentView === 'proveedores') {
                    rowHtml = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${item.razonSocial}</strong></td>
                            <td>${item.nit}</td>
                            <td>${item.telefono || '-'}</td>
                            <td>${item.email || '-'}</td>
                            <td class="actions-cell">
                                <button class="action-btn edit" onclick="openEditModal(${item.idProveedor})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" onclick="deleteRecord(${item.idProveedor})"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    `;
                }

                tbody.innerHTML += rowHtml;
            });
        }

        // Trigger action for active view
        function handleNewAction() {
            const conf = viewConfigs[currentView];
            conf.actionFn();
        }

        // --- AUTH & LOGIN CHECKS ---
        async function checkAuth(isManual = false) {
            try {
                const res = await fetch('/api/me', { headers });
                
                const loginScreen = document.getElementById('loginScreen');
                const sidebar = document.getElementById('dashboardSidebar');
                const wrapper = document.getElementById('dashboardWrapper');
                const clientPortal = document.getElementById('clientPortal');

                const avatarLetter = document.getElementById('avatarLetter');
                const profileName = document.getElementById('currentProfileName');
                const profileRole = document.getElementById('currentProfileRole');
                const headerAvatar = document.getElementById('headerAvatar');

                if (res.status === 200) {
                    const user = await res.json();
                    const initial = user.nombreUsuario ? user.nombreUsuario.substring(0, 1).toUpperCase() : '?';
                    
                    avatarLetter.textContent = initial;
                    headerAvatar.textContent = initial;
                    profileName.textContent = user.nombreUsuario;
                    profileRole.textContent = user.rol ? user.rol.nombre : 'Usuario';

                    const isCliente = user.rol && user.rol.nombre === 'Cliente';
                    
                    if (isCliente) {
                        // Show client portal, hide admin
                        loginScreen.style.display = 'none';
                        sidebar.style.display = 'none';
                        wrapper.style.display = 'none';
                        if (clientPortal) {
                            clientPortal.style.display = 'flex';
                            if (typeof initClientPortal === 'function') initClientPortal();
                        }
                    } else {
                        // Show admin dashboard, hide client portal
                        loginScreen.style.display = 'none';
                        sidebar.style.display = 'flex';
                        wrapper.style.display = 'flex';
                        if (clientPortal) clientPortal.style.display = 'none';

                        if (isManual) {
                            triggerToast('Conexión activa con el servidor');
                        }
                    }
                } else {
                    // Show login, hide everything
                    loginScreen.style.display = 'flex';
                    sidebar.style.display = 'none';
                    wrapper.style.display = 'none';
                    if (clientPortal) clientPortal.style.display = 'none';
                }
            } catch (err) {
                console.error("Auth check failed:", err);
            }
        }

        async function handleLoginSubmit(e) {
            e.preventDefault();
            const login = document.getElementById('loginUsername').value;
            const contrasena = document.getElementById('loginPassword').value;

            const res = await fetch('/api/login', {
                method: 'POST',
                headers,
                body: JSON.stringify({ login, contrasena })
            });

            if (res.ok) {
                triggerToast('Acceso concedido al sistema');
                checkAuth();
            } else {
                alert('Las credenciales proporcionadas son incorrectas.');
            }
        }

        function openLogoutModal() {
            if (confirm('¿Desea cerrar la sesión del sistema?')) {
                fetch('/api/logout', { method: 'POST', headers }).then(() => {
                    triggerToast('Sesión cerrada');
                    checkAuth();
                });
            }
        }

        function togglePasswordVisibility() {
            const passInput = document.getElementById('loginPassword');
            const icon = event.target;
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function fillCredentials(email, password) {
            const userField = document.getElementById('loginUsername');
            const passField = document.getElementById('loginPassword');
            userField.value = email;
            passField.value = password;
            // Briefly highlight the filled fields
            userField.style.borderColor = '#3b82f6';
            passField.style.borderColor = '#3b82f6';
            setTimeout(() => {
                userField.style.borderColor = '';
                passField.style.borderColor = '';
            }, 1200);
            passField.type = 'password';
            document.querySelector('.password-toggle-icon').classList.remove('fa-eye-slash');
            document.querySelector('.password-toggle-icon').classList.add('fa-eye');
        }

        // --- DYNAMIC FORM INJECTION & CRUD ---
        async function openAddModal() {
            editingId = null;
            document.getElementById('crudModalTitle').textContent = `Agregar a ${viewConfigs[currentView].title}`;
            await injectFields();
            document.getElementById('crudModal').style.display = 'flex';
        }

        async function openEditModal(id) {
            editingId = id;
            document.getElementById('crudModalTitle').textContent = `Editar en ${viewConfigs[currentView].title}`;
            await injectFields();

            // Populate form with existing data
            const item = currentData.find(d => {
                if (currentView === 'usuarios') return d.idUsuario === id;
                if (currentView === 'roles') return d.idRol === id;
                if (currentView === 'permisos') return d.idPermiso === id;
                if (currentView === 'tipos-servicio') return d.idTipoServicio === id;
                if (currentView === 'servicios') return d.idServicio === id;
                if (currentView === 'proveedores') return d.idProveedor === id;
            });

            if (item) {
                if (currentView === 'usuarios') {
                    document.getElementById('f_nombreUsuario').value = item.nombreUsuario;
                    document.getElementById('f_email').value = item.email;
                    document.getElementById('f_idRol').value = item.idRol;
                    document.getElementById('f_estado').value = item.estado;
                    document.getElementById('f_contrasena').required = false;
                    if (item.created_at) {
                        // Format date for input type="date" (YYYY-MM-DD)
                        document.getElementById('f_created_at').value = item.created_at.split('T')[0];
                    }
                } else if (currentView === 'roles') {
                    document.getElementById('f_nombre').value = item.nombre;
                    document.getElementById('f_descripcion').value = item.descripcion || '';
                } else if (currentView === 'permisos') {
                    document.getElementById('f_nombre').value = item.nombre;
                    document.getElementById('f_modulo').value = item.modulo;
                    document.getElementById('f_idRol').value = item.idRol;
                } else if (currentView === 'tipos-servicio') {
                    document.getElementById('f_nombre').value = item.nombre;
                    document.getElementById('f_descripcion').value = item.descripcion || '';
                } else if (currentView === 'servicios') {
                    document.getElementById('f_nombre').value = item.nombre;
                    document.getElementById('f_precioBase').value = item.precioBase;
                    document.getElementById('f_duracionEstimada').value = item.duracionEstimada || '';
                    document.getElementById('f_idTipoServicio').value = item.idTipoServicio;
                } else if (currentView === 'proveedores') {
                    document.getElementById('f_razonSocial').value = item.razonSocial;
                    document.getElementById('f_nit').value = item.nit;
                    document.getElementById('f_telefono').value = item.telefono || '';
                    document.getElementById('f_email').value = item.email || '';
                }
            }

            document.getElementById('crudModal').style.display = 'flex';
        }

        function closeCrudModal() {
            document.getElementById('crudModal').style.display = 'none';
        }

        async function injectFields() {
            const container = document.getElementById('dynamicFormFields');
            container.innerHTML = '';

            try {
                const rolRes = await fetch('/api/roles', { headers });
                allRoles = rolRes.ok ? await rolRes.json() : [];
                const tsRes = await fetch('/api/tipos-servicio', { headers });
                allTiposServicio = tsRes.ok ? await tsRes.json() : [];
            } catch (e) {
                console.error("Fallo cargando catálogos auxiliares");
            }

            if (currentView === 'usuarios') {
                const rolesOpts = allRoles.map(r => `<option value="${r.idRol}">${r.nombre}</option>`).join('');
                container.innerHTML = `
                    <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" class="form-control" id="f_nombreUsuario" required>
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control" id="f_email" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" id="f_contrasena" ${editingId ? '' : 'required'} placeholder="${editingId ? 'Dejar en blanco para no cambiar' : '******'}">
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <select class="form-control" id="f_idRol" required>
                            <option value="">Seleccione Rol</option>
                            ${rolesOpts}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" id="f_estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Creación</label>
                        <input type="date" class="form-control" id="f_created_at">
                        <small style="color: #94a3b8; font-size: 0.75rem;">Dejar en blanco para usar la fecha actual.</small>
                    </div>
                `;
            } else if (currentView === 'roles') {
                container.innerHTML = `
                    <div class="form-group">
                        <label>Nombre del Rol</label>
                        <input type="text" class="form-control" id="f_nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" id="f_descripcion">
                    </div>
                `;
            } else if (currentView === 'permisos') {
                const rolesOpts = allRoles.map(r => `<option value="${r.idRol}">${r.nombre}</option>`).join('');
                container.innerHTML = `
                    <div class="form-group">
                        <label>Nombre del Permiso</label>
                        <input type="text" class="form-control" id="f_nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Módulo</label>
                        <input type="text" class="form-control" id="f_modulo" required>
                    </div>
                    <div class="form-group">
                        <label>Rol Relacionado</label>
                        <select class="form-control" id="f_idRol" required>
                            <option value="">Seleccione Rol</option>
                            ${rolesOpts}
                        </select>
                    </div>
                `;
            } else if (currentView === 'tipos-servicio') {
                container.innerHTML = `
                    <div class="form-group">
                        <label>Nombre de Categoría</label>
                        <input type="text" class="form-control" id="f_nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" id="f_descripcion">
                    </div>
                `;
            } else if (currentView === 'servicios') {
                const tsOpts = allTiposServicio.map(ts => `<option value="${ts.idTipoServicio}">${ts.nombre}</option>`).join('');
                container.innerHTML = `
                    <div class="form-group">
                        <label>Nombre del Servicio</label>
                        <input type="text" class="form-control" id="f_nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Precio Base</label>
                        <input type="number" step="0.01" class="form-control" id="f_precioBase" required>
                    </div>
                    <div class="form-group">
                        <label>Duración Estimada (Minutos)</label>
                        <input type="number" class="form-control" id="f_duracionEstimada">
                    </div>
                    <div class="form-group">
                        <label>Categoría (Tipo Servicio)</label>
                        <select class="form-control" id="f_idTipoServicio" required>
                            <option value="">Seleccione Categoría</option>
                            ${tsOpts}
                        </select>
                    </div>
                `;
            } else if (currentView === 'proveedores') {
                container.innerHTML = `
                    <div class="form-group">
                        <label>Razón Social</label>
                        <input type="text" class="form-control" id="f_razonSocial" required>
                    </div>
                    <div class="form-group">
                        <label>NIT</label>
                        <input type="text" class="form-control" id="f_nit" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" id="f_telefono">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="f_email">
                    </div>
                `;
            }
        }

        async function handleCrudSubmit(e) {
            e.preventDefault();
            let body = {};
            let url = `/api/${currentView}`;
            let method = editingId ? 'PUT' : 'POST';

            if (editingId) {
                url += `/${editingId}`;
            }

            if (currentView === 'usuarios') {
                body.nombreUsuario = document.getElementById('f_nombreUsuario').value;
                body.email = document.getElementById('f_email').value;
                body.idRol = parseInt(document.getElementById('f_idRol').value, 10);
                body.estado = parseInt(document.getElementById('f_estado').value, 10);
                
                const fecha = document.getElementById('f_created_at').value;
                if (fecha) body.created_at = fecha;
                
                const pass = document.getElementById('f_contrasena').value;
                if (pass) body.contrasena = pass;
            } else if (currentView === 'roles') {
                body.nombre = document.getElementById('f_nombre').value;
                body.descripcion = document.getElementById('f_descripcion').value;
            } else if (currentView === 'permisos') {
                body.nombre = document.getElementById('f_nombre').value;
                body.modulo = document.getElementById('f_modulo').value;
                body.idRol = parseInt(document.getElementById('f_idRol').value, 10);
            } else if (currentView === 'tipos-servicio') {
                body.nombre = document.getElementById('f_nombre').value;
                body.descripcion = document.getElementById('f_descripcion').value;
            } else if (currentView === 'servicios') {
                body.nombre = document.getElementById('f_nombre').value;
                body.precioBase = parseFloat(document.getElementById('f_precioBase').value);
                const dur = document.getElementById('f_duracionEstimada').value;
                if (dur) body.duracionEstimada = parseInt(dur, 10);
                body.idTipoServicio = parseInt(document.getElementById('f_idTipoServicio').value, 10);
            } else if (currentView === 'proveedores') {
                body.razonSocial = document.getElementById('f_razonSocial').value;
                body.nit = document.getElementById('f_nit').value;
                body.telefono = document.getElementById('f_telefono').value;
                body.email = document.getElementById('f_email').value;
            }

            const res = await fetch(url, {
                method,
                headers,
                body: JSON.stringify(body)
            });

            if (res.ok) {
                triggerToast(editingId ? 'Registro actualizado con éxito' : 'Registro creado con éxito');
                closeCrudModal();
                refreshData();
            } else {
                const data = await res.json();
                let errorMsg = data.message || 'Fallo en la operación';
                if (data.errors) {
                    errorMsg += '\n\n' + Object.values(data.errors).flat().join('\n');
                }
                alert(`Error: ${errorMsg}`);
            }
        }

        async function deleteRecord(id) {
            if (!confirm('¿Está seguro de que desea eliminar este registro?')) return;
            const res = await fetch(`/api/${currentView}/${id}`, {
                method: 'DELETE',
                headers
            });

            if (res.ok) {
                triggerToast('Registro eliminado');
                refreshData();
            } else {
                alert('No se pudo eliminar el registro.');
            }
        }

        // --- SEARCH FILTER ---
        function handleSearch(q) {
            const query = q.toLowerCase();
            const filtered = currentData.filter(d => {
                if (currentView === 'usuarios') {
                    return d.nombreUsuario.toLowerCase().includes(query) || d.email.toLowerCase().includes(query);
                } else if (currentView === 'roles') {
                    return d.nombre.toLowerCase().includes(query) || (d.descripcion && d.descripcion.toLowerCase().includes(query));
                } else if (currentView === 'permisos') {
                    return d.nombre.toLowerCase().includes(query) || d.modulo.toLowerCase().includes(query);
                } else if (currentView === 'tipos-servicio') {
                    return d.nombre.toLowerCase().includes(query);
                } else if (currentView === 'servicios') {
                    return d.nombre.toLowerCase().includes(query);
                } else if (currentView === 'proveedores') {
                    return d.razonSocial.toLowerCase().includes(query) || d.nit.toLowerCase().includes(query);
                }
                return true;
            });
            renderTable(filtered);
        }

        // --- TOAST NOTIFICATIONS ---
        function triggerToast(text) {
            document.getElementById('toastText').textContent = text;
            document.getElementById('toastBox').style.display = 'flex';
        }

        function closeToast() {
            document.getElementById('toastBox').style.display = 'none';
        }

        // Initial setup
        checkAuth();
        switchView('panel');
