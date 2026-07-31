<div id="mecanicoPortal" class="op-portal" style="display: none;">
    <nav class="op-navbar">
        <div class="op-navbar-brand">
            <div class="op-navbar-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div>
                <div class="op-navbar-title">SisGest Pro</div>
                <div class="op-navbar-sub">Portal de Mecánico</div>
            </div>
        </div>

        <div class="op-nav-links">
            <button class="op-nav-btn active" id="mp-nav-bandeja" data-tab="bandeja" onclick="switchMecTab('bandeja')">
                <i class="fa-solid fa-inbox"></i> <span>Bandeja</span>
            </button>
            <button class="op-nav-btn" id="mp-nav-orden" data-tab="orden" onclick="switchMecTab('orden')">
                <i class="fa-solid fa-clipboard-list"></i> <span>Mi Orden</span>
            </button>
            <button class="op-nav-btn" id="mp-nav-repuestos" data-tab="repuestos" onclick="switchMecTab('repuestos')">
                <i class="fa-solid fa-box-open"></i> <span>Repuestos</span>
            </button>
            <button class="op-nav-btn" id="mp-nav-diagnostico" data-tab="diagnostico" onclick="switchMecTab('diagnostico')">
                <i class="fa-solid fa-stethoscope"></i> <span>Diagnóstico</span>
            </button>
        </div>

        <div class="op-nav-right">
            <label class="op-toggle-wrap" for="mp-toggle-disp">
                <span id="mp-toggle-state" style="font-size:.82rem; color:var(--text-secondary,#9db8b0);">Ocupado</span>
                <div class="op-toggle">
                    <input type="checkbox" id="mp-toggle-disp" onchange="toggleDisponible()">
                    <span class="op-toggle-slider"></span>
                </div>
            </label>
            <div style="font-size:.82rem; color:var(--text-secondary,#9db8b0);">
                <strong id="mp-username" style="color:#fff;">Cargando...</strong><br>
                <span style="font-size:.72rem; color:var(--text-muted,#5f9c92);">Mecánico</span>
            </div>
            <div id="mp-avatar" style="width:36px; height:36px; border-radius:50%; background:var(--gradient-primary,linear-gradient(100deg,#b6f24a,#22d3c5)); color:#04100e; font-weight:900; font-size:1rem; display:flex; align-items:center; justify-content:center;">M</div>
            <button class="op-btn-ghost" onclick="openLogoutModal()" style="padding:.4rem .8rem; font-size:.82rem;">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </nav>

    <div id="mp-banner" class="mp-banner" style="display:none; margin:1.5rem 1.5rem 0;"></div>

    <div id="mp-tab-bandeja" class="op-main mp-tab-content active">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.75rem; gap:1rem; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:1.5rem; font-weight:800; color:#fff; margin:0;">Bandeja de órdenes</h2>
                <p style="color:var(--text-muted,#5f9c92); font-size:.85rem; margin:.25rem 0 0;" id="mp-date-label">Cargando fecha...</p>
            </div>
            <button class="op-btn-primary" onclick="loadBandeja()">
                <i class="fa-solid fa-rotate-right"></i> Actualizar
            </button>
        </div>

        <div class="op-stats-grid" style="margin-bottom:1.25rem;">
            <div class="glass-card op-stat-card">
                <div class="op-stat-icon" style="background:rgba(56,189,248,0.15); color:var(--state-info,#38bdf8);">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <div class="op-stat-val" id="mp-kpi-disponibles">0</div>
                    <div class="op-stat-lbl">Disponibles</div>
                </div>
            </div>
            <div class="glass-card op-stat-card">
                <div class="op-stat-icon" style="background:rgba(182,242,74,0.15); color:var(--accent-primary,#b6f24a);">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <div>
                    <div class="op-stat-val" id="mp-kpi-asignadas">0</div>
                    <div class="op-stat-lbl">Mis asignadas</div>
                </div>
            </div>
            <div class="glass-card op-stat-card">
                <div class="op-stat-icon" style="background:rgba(245,158,11,0.15); color:var(--state-warning,#f59e0b);">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
                <div>
                    <div class="op-stat-val" id="mp-kpi-diagnosticos">0</div>
                    <div class="op-stat-lbl">Diagnósticos</div>
                </div>
            </div>
        </div>

        <div class="glass-card mp-section-card">
            <div class="mp-section-head">
                <div>
                    <h3>Disponibles para tomar</h3>
                    <p>Órdenes sin mecánico asignado y listas para aceptar.</p>
                </div>
                <span class="mp-count-badge" id="mp-count-disponibles">0</span>
            </div>
            <div id="mp-lista-disponibles" class="mp-card-grid"></div>
        </div>

        <div class="glass-card mp-section-card">
            <div class="mp-section-head">
                <div>
                    <h3>Mis órdenes asignadas</h3>
                    <p>Tu flujo activo con progreso y próximos pasos.</p>
                </div>
                <span class="mp-count-badge" id="mp-count-asignadas">0</span>
            </div>
            <div id="mp-lista-asignadas" class="mp-card-grid"></div>
        </div>
    </div>

    <div id="mp-tab-orden" class="op-main mp-tab-content" style="display:none;">
        <div class="glass-card">
            <div class="mp-section-head">
                <div>
                    <h2 id="mp-orden-title">Orden de trabajo</h2>
                    <p id="mp-orden-subtitle">Selecciona una orden para ver el progreso.</p>
                </div>
                <div class="mp-card-actions">
                    <button class="op-btn-ghost" onclick="switchMecTab('bandeja')">
                        <i class="fa-solid fa-arrow-left"></i> Volver
                    </button>
                    <button class="op-btn-primary" id="mp-btn-avanzar" onclick="avanzarEtapa()">
                        <i class="fa-solid fa-forward-step"></i> Avanzar etapa
                    </button>
                </div>
            </div>
            <div id="mp-orden-meta" class="mp-order-meta" style="margin-bottom:1rem;"></div>
            <div class="op-stepper" id="mp-stepper"></div>
            <div class="mp-card-actions" style="margin-top:.5rem;">
                <button class="op-btn-ghost" onclick="switchMecTab('diagnostico')">
                    <i class="fa-solid fa-stethoscope"></i> Ir a diagnóstico
                </button>
                <button class="op-btn-ghost" onclick="switchMecTab('repuestos')">
                    <i class="fa-solid fa-box-open"></i> Repuestos usados
                </button>
            </div>
        </div>
    </div>

    <div id="mp-tab-diagnostico" class="op-main mp-tab-content" style="display:none;">
        <div class="glass-card">
            <div class="mp-section-head">
                <div>
                    <h3>Diagnóstico del vehículo</h3>
                    <p>Registra el problema detectado y la especialidad asociada.</p>
                </div>
            </div>
            <div class="mp-form-grid">
                <label>
                    Orden activa
                    <select id="mp-diag-orden" class="mp-select"></select>
                </label>
                <label>
                    Descripción del problema
                    <textarea id="mp-diag-desc" class="mp-textarea" rows="6" placeholder="Describe el fallo, síntomas y observaciones del mecánico..."></textarea>
                </label>
                <div>
                    <label style="margin-bottom:.6rem;">Especialidades</label>
                    <div id="mp-diag-chips" class="mp-chip-list"></div>
                </div>
                <div>
                    <label style="margin-bottom:.6rem;">Severidad</label>
                    <div class="mp-severity-grid">
                        <label class="mp-severity-option">
                            <input type="radio" name="mp-severity" value="Baja">
                            <span>🔵 Baja</span>
                        </label>
                        <label class="mp-severity-option">
                            <input type="radio" name="mp-severity" value="Media" checked>
                            <span>🟡 Media</span>
                        </label>
                        <label class="mp-severity-option">
                            <input type="radio" name="mp-severity" value="Alta">
                            <span>🔴 Alta</span>
                        </label>
                    </div>
                </div>
                <div class="mp-card-actions">
                    <button class="op-btn-primary" onclick="guardarDiagnostico()">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar diagnóstico
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="mp-tab-repuestos" class="op-main mp-tab-content" style="display:none;">
        <div class="glass-card">
            <div class="mp-section-head">
                <div>
                    <h3>Repuestos y consumo</h3>
                    <p>Busca repuestos de stock y registra su uso en la orden.</p>
                </div>
            </div>
            <div class="mp-card-actions" style="margin-bottom:1rem;">
                <input id="mp-rep-search" class="mp-input" type="text" placeholder="Buscar por nombre o código" onkeyup="if(event.key==='Enter') loadRepuestos(this.value)">
                <button class="op-btn-primary" onclick="loadRepuestos(document.getElementById('mp-rep-search').value)">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                </button>
            </div>
            <div id="mp-rep-resultados" class="mp-card-grid"></div>
            <div id="mp-reg-uso-form" class="glass-card" style="display:none; margin-top:1.25rem;">
                <div class="mp-section-head">
                    <div>
                        <h4 style="margin:0;">Registrar uso</h4>
                        <p style="margin:.2rem 0 0;">Completa la cantidad y la orden asociada.</p>
                    </div>
                </div>
                <div class="mp-form-grid">
                    <label>
                        Repuesto
                        <input id="mp-uso-repuesto" class="mp-input" type="text" readonly>
                    </label>
                    <label>
                        Cantidad
                        <input id="mp-uso-cantidad" class="mp-input" type="number" min="1" value="1">
                    </label>
                    <label>
                        Orden asociada
                        <select id="mp-uso-orden" class="mp-select"></select>
                    </label>
                    <div class="mp-card-actions">
                        <button class="op-btn-primary" onclick="confirmarUsoRepuesto()">
                            <i class="fa-solid fa-check"></i> Confirmar uso
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mp-modal-confirmar-terminado" class="mp-modal-backdrop" style="display:none;">
        <div class="glass-card mp-modal-card">
            <div style="display:flex; align-items:center; gap:.75rem; margin-bottom:1rem;">
                <div style="width:48px; height:48px; border-radius:12px; background:rgba(16,185,129,0.15); color:var(--state-success,#10b981); display:flex; align-items:center; justify-content:center; font-size:1.2rem;">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <h3 style="margin:0; color:#fff;">¿Confirmar finalización?</h3>
                    <p style="margin:.2rem 0 0; color:var(--text-muted,#5f9c92);">El cliente recibirá una notificación automática.</p>
                </div>
            </div>
            <div class="mp-card-actions" style="justify-content:flex-end;">
                <button class="op-btn-ghost" onclick="cerrarModalTerminado()">Cancelar</button>
                <button class="op-btn-primary" onclick="confirmarTerminado()">Sí, marcar listo</button>
            </div>
        </div>
    </div>
</div>
