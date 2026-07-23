<!-- PANTALLA DE LANDING PAGE -->
<div id="landingScreen">
    <nav class="landing-navbar fixed-top-custom">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="landing-logo tilt-element">
                <div class="landing-brand-icon">
                    <i class="fa-solid fa-wrench"></i>
                </div>
                <div class="landing-brand-text">
                    <span>Taller Automotriz</span>
                    <small>Gestión Premium</small>
                </div>
            </div>
            <div class="landing-nav-links d-none d-md-flex align-items-center gap-4">
                <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
                    class="nav-link">Inicio</a>
                <a href="#"
                    onclick="document.getElementById('landingAbout').scrollIntoView({behavior: 'smooth', block: 'start'}); return false;"
                    class="nav-link">Acerca de nosotros</a>
                <a href="#" onclick="document.getElementById('landingLocations').scrollIntoView({behavior: 'smooth', block: 'start'}); return false;" class="nav-link">Sucursal</a>
            </div>
            <div class="landing-nav-actions tilt-element">
                <button onclick="showLoginScreen()" class="btn-login-nav">
                    <i class="fa-solid fa-right-to-bracket"></i> <span>Ingresar al Sistema</span>
                </button>
            </div>
        </div>
    </nav>

    <div class="landing-hero">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 landing-hero-content">
                    <span class="badge-premium mb-3">Servicio de Excelencia <i
                            class="fa-solid fa-star text-warning ms-1"></i></span>
                    <h1 class="landing-title">La Mejor Tecnología para tu <span>Vehículo</span></h1>
                    <p class="landing-subtitle">Descubre una nueva experiencia en mantenimiento automotriz.
                        Transparencia, rapidez y calidad garantizada en cada reparación.</p>
                    <div class="landing-hero-actions mt-4">
                        <button class="btn-primary-3d" onclick="scrollToLocations()">
                            <i class="fa-solid fa-map-location-dot me-2"></i> Ver Sucursales
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="landing-3d-showcase">
                        <!-- Graphic element representing 3D car/workshop -->
                        <div class="glass-card-3d tilt-element" style="box-shadow: 0 40px 80px -20px rgba(0,0,0,0.8), 0 0 50px rgba(99,102,241,0.3); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa-solid fa-car-side fa-4x car-icon-3d mb-4" style="font-size: 5rem; text-shadow: 0 20px 30px rgba(0,0,0,0.5);"></i>
                            <div class="glass-stats" style="transform: translateZ(50px);">
                                <div class="stat-item" style="box-shadow: 0 10px 20px rgba(0,0,0,0.3);"><i class="fa-solid fa-check text-success"></i> +10k Reparaciones
                                </div>
                                <div class="stat-item" style="box-shadow: 0 10px 20px rgba(0,0,0,0.3);"><i class="fa-solid fa-star text-warning"></i> 4.9/5 Calificación
                                </div>
                            </div>
                            
                            <!-- Elementos flotantes 3D adicionales -->
                            <div style="position:absolute; top:-20px; right:-20px; font-size:2.5rem; color:#38bdf8; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.5)); animation: float3D 4s infinite alternate; transform: translateZ(80px);"><i class="fa-solid fa-gear"></i></div>
                            <div style="position:absolute; bottom:-10px; left:-10px; font-size:2rem; color:#fbbf24; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.5)); animation: float3D 5s infinite alternate-reverse; transform: translateZ(60px);"><i class="fa-solid fa-bolt"></i></div>
                        </div>
                        <div class="glow-orb orb-1"></div>
                        <div class="glow-orb orb-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="landingAbout" class="landing-about">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-premium mb-3">Conoce al Equipo</span>
                <h2 class="section-title">Acerca de Nosotros</h2>
                <p class="section-subtitle">Profesionales expertos apasionados por el mundo automotriz</p>
            </div>
            <div class="row g-5 justify-content-center">
                <!-- Profile 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="profile-card-3d tilt-element">
                        <div class="profile-bg-glow"></div>
                        <div class="profile-image-wrapper">
                            <img src="https://i.pravatar.cc/300?img=11" alt="Carlos Ruiz">
                        </div>
                        <div class="profile-content">
                            <h3>Luis Rene</h3>
                            <h4>Programador</h4>
                            <p>Más de 3 años de experiencia en desarrollo de software y sistemas web.</p>
                            <div class="profile-social">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="profile-card-3d tilt-element">
                        <div class="profile-bg-glow"></div>
                        <div class="profile-image-wrapper">
                            <img src="https://i.pravatar.cc/300?img=47" alt="Ana Gómez">
                        </div>
                        <div class="profile-content">
                            <h3>Ana Gómez</h3>
                            <h4>Jefa de Mecánica</h4>
                            <p>Especialista en diagnósticos avanzados, transmisiones y motores de última generación.</p>
                            <div class="profile-social">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="profile-card-3d tilt-element">
                        <div class="profile-bg-glow"></div>
                        <div class="profile-image-wrapper">
                            <img src="https://i.pravatar.cc/300?img=33" alt="Luis Fernando">
                        </div>
                        <div class="profile-content">
                            <h3>Luis Fernando</h3>
                            <h4>Atención al Cliente</h4>
                            <p>Asegurando que cada reparación sea transparente y brindando el mejor servicio a cada
                                visitante.</p>
                            <div class="profile-social">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="landingLocations" class="landing-locations">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nuestras Ubicaciones</h2>
                <p class="section-subtitle">Encuéntranos cerca de ti en nuestras sucursales estratégicas</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="location-card-3d tilt-element text-start p-5" style="border-left: 4px solid #6366f1;">
                        <h3 class="text-white mb-4"><i class="fa-solid fa-building text-info me-3" style="font-size: 1.5rem;"></i>Sede Principal</h3>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-map-pin text-info mt-1 me-3"></i>
                            <p class="text-light mb-0" style="opacity: 0.9;">Av. Principal 1234, Zona Empresarial Norte, Ciudad Central. Edificio Talleres Pro.</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa-solid fa-phone text-info me-3"></i>
                            <p class="text-light mb-0" style="opacity: 0.9;">+1 (234) 567-8900</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fa-solid fa-envelope text-info me-3"></i>
                            <p class="text-light mb-0" style="opacity: 0.9;">contacto@tallerautomotriz.com</p>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                            <span class="badge bg-success bg-opacity-25 text-success p-2 px-3 border border-success border-opacity-50 rounded-pill fs-6" style="box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);">
                                <i class="fa-solid fa-door-open me-2"></i>Abierto Ahora (08:00 - 18:00)
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="location-card-3d tilt-element p-2">
                        <!-- Mapa Embebido de Ejemplo -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.83543450937!2d144.9537353155041!3d-37.81720974202166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sus!4v1602243456789!5m2!1sen!2sus"
                            width="100%" height="450" frameborder="0" style="border:0; border-radius: 16px; filter: contrast(1.1) brightness(0.9);"
                            allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>