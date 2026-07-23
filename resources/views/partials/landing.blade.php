<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Automotriz — Gestión Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg-0: #05060d;
            --bg-1: #0a0d1a;
            --bg-2: #10142a;
            --accent-1: #6366f1;
            --accent-2: #38bdf8;
            --accent-3: #fbbf24;
            --text-0: #f5f6fb;
            --text-1: #b7bcd6;
            --text-2: #7d84a8;
            --glass-border: rgba(255, 255, 255, 0.08);
            --font-display: 'Sora', sans-serif;
            --font-body: 'Manrope', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                radial-gradient(ellipse 900px 600px at 15% -10%, rgba(99, 102, 241, 0.25), transparent 60%),
                radial-gradient(ellipse 800px 600px at 100% 10%, rgba(56, 189, 248, 0.18), transparent 55%),
                var(--bg-0);
            color: var(--text-0);
            font-family: var(--font-body);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        .fixed-top-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        /* ===== NAVBAR ===== */
        .landing-navbar {
            padding: 18px 0;
            background: rgba(8, 10, 20, 0.55);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border-bottom: 1px solid var(--glass-border);
            transition: padding .3s ease, background .3s ease;
        }

        .landing-navbar.scrolled {
            padding: 10px 0;
            background: rgba(6, 8, 16, 0.85);
        }

        .landing-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .landing-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--accent-1), #4338ca);
            color: #fff;
            font-size: 18px;
            box-shadow: 0 10px 24px -8px rgba(99, 102, 241, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            transform-style: preserve-3d;
        }

        .landing-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .landing-brand-text span {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 16px;
            color: var(--text-0);
        }

        .landing-brand-text small {
            font-size: 11px;
            color: var(--text-2);
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .landing-nav-links .nav-link {
            color: var(--text-1);
            font-weight: 600;
            font-size: 14.5px;
            position: relative;
            padding: 6px 2px;
            transition: color .2s ease;
        }

        .landing-nav-links .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-1), var(--accent-2));
            transition: width .25s ease;
            border-radius: 2px;
        }

        .landing-nav-links .nav-link:hover {
            color: var(--text-0);
        }

        .landing-nav-links .nav-link:hover::after {
            width: 100%;
        }

        .btn-login-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(145deg, var(--accent-1), #4338ca);
            color: #fff;
            border: none;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 22px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 12px 26px -8px rgba(99, 102, 241, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-login-nav:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 34px -10px rgba(99, 102, 241, 0.8);
        }

        /* ===== HERO ===== */
        .landing-hero {
            padding: 190px 0 80px;
            position: relative;
        }

        .min-vh-75 {
            min-height: 75vh;
        }

        .badge-premium {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(251, 191, 36, 0.1);
            color: var(--accent-3);
            border: 1px solid rgba(251, 191, 36, 0.35);
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .landing-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: clamp(2.2rem, 4.5vw, 3.6rem);
            line-height: 1.1;
            color: var(--text-0);
            margin-bottom: 22px;
            letter-spacing: -.01em;
        }

        .landing-title span {
            background: linear-gradient(120deg, var(--accent-2), var(--accent-1) 70%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .landing-subtitle {
            color: var(--text-1);
            font-size: 17px;
            line-height: 1.7;
            max-width: 520px;
        }

        .btn-primary-3d {
            background: linear-gradient(145deg, var(--accent-1), #4338ca);
            color: #fff;
            border: none;
            font-weight: 700;
            font-size: 15px;
            padding: 16px 30px;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 18px 34px -10px rgba(99, 102, 241, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-primary-3d:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 24px 44px -10px rgba(99, 102, 241, 0.85);
        }

        .landing-3d-showcase {
            position: relative;
            perspective: 1400px;
            padding: 40px;
        }

        .glass-card-3d {
            position: relative;
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015));
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 28px;
            padding: 56px 40px;
            text-align: center;
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            transform: rotateX(6deg) rotateY(-10deg);
            transition: transform .1s ease-out;
            will-change: transform;
        }

        .car-icon-3d {
            color: var(--accent-2);
            filter: drop-shadow(0 25px 35px rgba(56, 189, 248, 0.35));
            animation: floatY 4.5s ease-in-out infinite;
            transform: translateZ(70px);
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateZ(70px) translateY(0);
            }

            50% {
                transform: translateZ(70px) translateY(-14px);
            }
        }

        @keyframes float3D {
            0% {
                transform: translateZ(80px) translateY(0) rotate(0deg);
            }

            100% {
                transform: translateZ(80px) translateY(-16px) rotate(8deg);
            }
        }

        .glass-stats {
            display: flex;
            flex-direction: column;
            gap: 12px;
            transform: translateZ(50px);
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            color: var(--text-1);
        }

        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: .5;
            pointer-events: none;
            animation: orbDrift 8s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 220px;
            height: 220px;
            background: var(--accent-1);
            top: -40px;
            left: -40px;
        }

        .orb-2 {
            width: 260px;
            height: 260px;
            background: var(--accent-2);
            bottom: -60px;
            right: -40px;
            animation-delay: 2s;
        }

        @keyframes orbDrift {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(20px, -20px);
            }
        }

        /* ===== REVEAL ON SCROLL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== ABOUT / PROFILES ===== */
        .landing-about {
            padding: 100px 0 80px;
        }

        .section-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            color: var(--text-0);
        }

        .section-subtitle {
            color: var(--text-2);
            font-size: 15.5px;
        }

        .profile-card-3d {
            position: relative;
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.01));
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 36px 28px;
            text-align: center;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: transform .12s ease-out, box-shadow .3s ease;
            will-change: transform;
        }

        .profile-card-3d:hover {
            box-shadow: 0 30px 60px -20px rgba(99, 102, 241, 0.45);
        }

        .profile-bg-glow {
            position: absolute;
            inset: -40%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25), transparent 65%);
            opacity: 0;
            transition: opacity .3s ease;
        }

        .profile-card-3d:hover .profile-bg-glow {
            opacity: 1;
        }

        .profile-image-wrapper {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            margin: 0 auto 20px;
            overflow: hidden;
            border: 3px solid rgba(99, 102, 241, 0.4);
            position: relative;
            z-index: 1;
            box-shadow: 0 18px 32px -10px rgba(0, 0, 0, 0.5);
            transform: translateZ(40px);
        }

        .profile-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-content {
            position: relative;
            z-index: 1;
            transform: translateZ(30px);
        }

        .profile-content h3 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 19px;
            margin-bottom: 2px;
            color: var(--text-0);
        }

        .profile-content h4 {
            font-size: 12.5px;
            color: var(--accent-2);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 14px;
        }

        .profile-content p {
            color: var(--text-2);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .profile-social {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .profile-social a {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-1);
            border: 1px solid var(--glass-border);
            transition: all .2s ease;
        }

        .profile-social a:hover {
            background: var(--accent-1);
            color: #fff;
            transform: translateY(-3px);
        }

        /* ===== SERVICES ===== */
        .landing-services {
            padding: 80px 0;
        }

        .service-card {
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.01));
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 36px 24px;
            text-align: center;
            transition: transform .3s ease, box-shadow .3s ease;
            height: 100%;
            backdrop-filter: blur(4px);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px -20px rgba(99, 102, 241, 0.4);
        }

        .service-card i {
            color: var(--accent-2);
            margin-bottom: 16px;
            display: block;
        }

        .service-card h5 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-0);
        }

        .service-card p {
            color: var(--text-2);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ===== TESTIMONIALS ===== */
        .landing-testimonials {
            padding: 80px 0;
        }

        .testimonial-card {
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.01));
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px 24px;
            text-align: left;
            height: 100%;
            transition: transform .3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-6px);
        }

        .testimonial-card .stars {
            color: var(--accent-3);
            margin-bottom: 10px;
        }

        .testimonial-card p {
            color: var(--text-1);
            font-size: 15px;
            line-height: 1.6;
        }

        .testimonial-card .client-info {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 16px;
        }

        .testimonial-card .client-info img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-1);
        }

        .testimonial-card .client-info h6 {
            font-weight: 700;
            color: var(--text-0);
            margin: 0;
            font-size: 15px;
        }

        .testimonial-card .client-info small {
            color: var(--text-2);
            font-size: 13px;
        }

        /* ===== LOCATIONS ===== */
        .landing-locations {
            padding: 80px 0 120px;
        }

        .location-card-3d {
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.015));
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 30px 60px -25px rgba(0, 0, 0, 0.6);
        }

        .location-card-3d h3 {
            font-family: var(--font-display);
        }

        /* ===== CONTACT ===== */
        .landing-contact {
            padding: 80px 0;
        }

        .contact-form .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-0);
            border-radius: 14px;
            padding: 14px 18px;
            font-family: var(--font-body);
            transition: border .2s;
        }

        .contact-form .form-control:focus {
            border-color: var(--accent-1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .contact-form .form-control::placeholder {
            color: var(--text-2);
        }

        .contact-form .btn-submit {
            background: linear-gradient(145deg, var(--accent-1), #4338ca);
            border: none;
            padding: 14px 32px;
            border-radius: 14px;
            font-weight: 700;
            color: #fff;
            transition: transform .2s, box-shadow .2s;
        }

        .contact-form .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 30px -8px rgba(99, 102, 241, 0.6);
        }

        /* ===== FOOTER ===== */
        .landing-footer {
            background: rgba(6, 8, 16, 0.8);
            border-top: 1px solid var(--glass-border);
            padding: 60px 0 30px;
            backdrop-filter: blur(10px);
        }

        .landing-footer h5 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .landing-footer a {
            color: var(--text-2);
            transition: color .2s;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .landing-footer a:hover {
            color: var(--text-0);
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-1);
            font-size: 16px;
            transition: all .2s;
        }

        .footer-social a:hover {
            background: var(--accent-1);
            color: #fff;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid var(--glass-border);
            padding-top: 20px;
            margin-top: 30px;
            font-size: 14px;
            color: var(--text-2);
        }

        /* Responsive */
        @media (max-width:991px) {
            .landing-hero {
                padding: 130px 0 60px;
            }

            .glass-card-3d {
                transform: none;
            }
        }
    </style>
</head>

<body>

    <div id="landingScreen">
        <nav class="landing-navbar fixed-top-custom" id="mainNavbar">
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
                        onclick="document.getElementById('landingServices').scrollIntoView({behavior:'smooth'}); return false;"
                        class="nav-link">Servicios</a>
                    <a href="#"
                        onclick="document.getElementById('landingAbout').scrollIntoView({behavior:'smooth'}); return false;"
                        class="nav-link">Equipo</a>
                    <a href="#"
                        onclick="document.getElementById('landingTestimonials').scrollIntoView({behavior:'smooth'}); return false;"
                        class="nav-link">Testimonios</a>
                    <a href="#"
                        onclick="document.getElementById('landingLocations').scrollIntoView({behavior:'smooth'}); return false;"
                        class="nav-link">Ubicación</a>
                    <a href="#"
                        onclick="document.getElementById('landingContact').scrollIntoView({behavior:'smooth'}); return false;"
                        class="nav-link">Contacto</a>
                </div>
                <div class="landing-nav-actions tilt-element">
                    <button onclick="showLoginScreen()" class="btn-login-nav">
                        <i class="fa-solid fa-right-to-bracket"></i> <span>Ingresar</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- ===== HERO ===== -->
        <div class="landing-hero">
            <div class="container">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6 landing-hero-content reveal">
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
                        <div class="landing-3d-showcase reveal">
                            <div class="glass-card-3d tilt-element" id="heroCard">
                                <i class="fa-solid fa-car-side fa-4x car-icon-3d mb-4" style="font-size: 5rem;"></i>
                                <div class="glass-stats">
                                    <div class="stat-item"><i class="fa-solid fa-check text-success"></i> +10k
                                        Reparaciones</div>
                                    <div class="stat-item"><i class="fa-solid fa-star text-warning"></i> 4.9/5
                                        Calificación</div>
                                </div>
                                <div
                                    style="position:absolute; top:-20px; right:-20px; font-size:2.5rem; color:#38bdf8; animation: float3D 4s infinite alternate;">
                                    <i class="fa-solid fa-gear"></i>
                                </div>
                                <div
                                    style="position:absolute; bottom:-10px; left:-10px; font-size:2rem; color:#fbbf24; animation: float3D 5s infinite alternate-reverse;">
                                    <i class="fa-solid fa-bolt"></i>
                                </div>
                            </div>
                            <div class="glow-orb orb-1"></div>
                            <div class="glow-orb orb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== SERVICIOS ===== -->
        <div id="landingServices" class="landing-services">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <span class="badge-premium mb-3">Lo que ofrecemos</span>
                    <h2 class="section-title">Nuestros Servicios</h2>
                    <p class="section-subtitle">Soluciones integrales para mantener tu vehículo en óptimas condiciones
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6 reveal">
                        <div class="service-card tilt-element">
                            <i class="fa-solid fa-oil-can fa-3x"></i>
                            <h5>Cambio de Aceite</h5>
                            <p>Mantenimiento preventivo con aceites sintéticos de primera calidad.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 reveal">
                        <div class="service-card tilt-element">
                            <i class="fa-solid fa-brake-warning fa-3x"></i>
                            <h5>Frenos y Suspensión</h5>
                            <p>Revisión y reparación de frenos, amortiguadores y dirección.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 reveal">
                        <div class="service-card tilt-element">
                            <i class="fa-solid fa-car-battery fa-3x"></i>
                            <h5>Diagnóstico Eléctrico</h5>
                            <p>Escaneo y solución de fallas eléctricas y electrónicas.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 reveal">
                        <div class="service-card tilt-element">
                            <i class="fa-solid fa-tools fa-3x"></i>
                            <h5>Reparación General</h5>
                            <p>Motor, transmisión, sistema de enfriamiento y más.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ACERCA DE ===== -->
        <div id="landingAbout" class="landing-about">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <span class="badge-premium mb-3">Conoce al Equipo</span>
                    <h2 class="section-title">Acerca de Nosotros</h2>
                    <p class="section-subtitle">Profesionales expertos apasionados por el mundo automotriz</p>
                </div>
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card-3d tilt-element reveal">
                            <div class="profile-bg-glow"></div>
                            <div class="profile-image-wrapper">
                                <img src="https://i.pravatar.cc/300?img=11" alt="Luis Rene">
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
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card-3d tilt-element reveal">
                            <div class="profile-bg-glow"></div>
                            <div class="profile-image-wrapper">
                                <img src="https://i.pravatar.cc/300?img=47" alt="Erivaldo Fuentes">
                            </div>
                            <div class="profile-content">
                                <h3>Erivaldo Fuentes</h3>
                                <h4>Desarrollo de Backend</h4>
                                <p>Especializado en Laravel, backend, bases de datos y programación en general.</p>
                                <div class="profile-social">
                                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card-3d tilt-element reveal">
                            <div class="profile-bg-glow"></div>
                            <div class="profile-image-wrapper">
                                <img src="https://i.pravatar.cc/300?img=33" alt="Moises Moreno">
                            </div>
                            <div class="profile-content">
                                <h3>Moises Moreno</h3>
                                <h4>Desarrollo de Frontend</h4>
                                <p>Apasionado del frontend, me gusta desarrollar interfaces bonitas, modernas y fáciles
                                    de usar.</p>
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

        <!-- ===== TESTIMONIOS ===== -->
        <div id="landingTestimonials" class="landing-testimonials">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <span class="badge-premium mb-3">Opiniones</span>
                    <h2 class="section-title">Lo que dicen nuestros clientes</h2>
                    <p class="section-subtitle">Experiencias reales que avalan nuestra calidad</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4 reveal">
                        <div class="testimonial-card">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i></div>
                            <p>"Mi auto nunca había quedado tan bien. El diagnóstico fue preciso y el servicio rápido.
                                Totalmente recomendado."</p>
                            <div class="client-info">
                                <img src="https://i.pravatar.cc/100?img=12" alt="Cliente">
                                <div>
                                    <h6>María Gómez</h6>
                                    <small>Cliente frecuente</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal">
                        <div class="testimonial-card">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i></div>
                            <p>"Excelente atención, muy profesionales. Me explicaron cada detalle de la reparación.
                                Volveré sin dudarlo."</p>
                            <div class="client-info">
                                <img src="https://i.pravatar.cc/100?img=8" alt="Cliente">
                                <div>
                                    <h6>Carlos Ruiz</h6>
                                    <small>Cliente recurrente</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal">
                        <div class="testimonial-card">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star-half-stroke"></i></div>
                            <p>"El mejor taller de la ciudad. Tienen tecnología de punta y el personal es muy
                                capacitado. 100% confiable."</p>
                            <div class="client-info">
                                <img src="https://i.pravatar.cc/100?img=20" alt="Cliente">
                                <div>
                                    <h6>Ana Martínez</h6>
                                    <small>Cliente satisfecha</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== UBICACIONES ===== -->
        <div id="landingLocations" class="landing-locations">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <h2 class="section-title">Nuestras Ubicaciones</h2>
                    <p class="section-subtitle">Encuéntranos cerca de ti en nuestras sucursales estratégicas</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <div class="location-card-3d tilt-element text-start p-5 reveal"
                            style="border-left: 4px solid #6366f1;">
                            <h3 class="text-white mb-4"><i class="fa-solid fa-building text-info me-3"
                                    style="font-size: 1.5rem;"></i>Sede Principal</h3>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fa-solid fa-map-pin text-info mt-1 me-3"></i>
                                <p class="text-light mb-0" style="opacity: 0.9;">Av. Principal 1234, Zona Empresarial
                                    Norte, Ciudad Central. Edificio Talleres Pro.</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa-solid fa-phone text-info me-3"></i>
                                <p class="text-light mb-0" style="opacity: 0.9;">+591 (635) 8775</p>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <i class="fa-solid fa-envelope text-info me-3"></i>
                                <p class="text-light mb-0" style="opacity: 0.9;">contacto@tallerautomotriz.com</p>
                            </div>
                            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                                <span
                                    class="badge bg-success bg-opacity-25 text-success p-2 px-3 border border-success border-opacity-50 rounded-pill fs-6"
                                    style="box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);">
                                    <i class="fa-solid fa-door-open me-2"></i>Abierto Ahora (08:00 - 18:00)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="location-card-3d tilt-element p-2 reveal">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.83543450937!2d144.9537353155041!3d-37.81720974202166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sus!4v1602243456789!5m2!1sen!2sus"
                                width="100%" height="450" frameborder="0"
                                style="border:0; border-radius: 16px; filter: contrast(1.1) brightness(0.9);"
                                allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== CONTACTO ===== -->
        <div id="landingContact" class="landing-contact">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <span class="badge-premium mb-3">Ponte en contacto</span>
                    <h2 class="section-title">¿Tienes alguna consulta?</h2>
                    <p class="section-subtitle">Escríbenos y te responderemos a la brevedad</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="profile-card-3d tilt-element p-4 reveal">
                            <form class="contact-form"
                                onsubmit="alert('Gracias por tu mensaje. Te contactaremos pronto.'); return false;">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label text-light">Nombre completo</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Tu nombre"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-light">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="tucorreo@ejemplo.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mensaje" class="form-label text-light">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" rows="4"
                                        placeholder="¿En qué podemos ayudarte?" required></textarea>
                                </div>
                                <button type="submit" class="btn-submit w-100">
                                    <i class="fa-regular fa-paper-plane me-2"></i> Enviar mensaje
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== FOOTER ===== -->
        <footer class="landing-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="landing-logo mb-3">
                            <div class="landing-brand-icon">
                                <i class="fa-solid fa-wrench"></i>
                            </div>
                            <div class="landing-brand-text">
                                <span>Taller Automotriz</span>
                                <small>Gestión Premium</small>
                            </div>
                        </div>
                        <p style="color:var(--text-2);font-size:14px;">Comprometidos con la excelencia y la satisfacción
                            de nuestros clientes. Calidad y confianza en cada servicio.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Enlaces rápidos</h5>
                        <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;">Inicio</a><br>
                        <a href="#"
                            onclick="document.getElementById('landingServices').scrollIntoView({behavior:'smooth'}); return false;">Servicios</a><br>
                        <a href="#"
                            onclick="document.getElementById('landingAbout').scrollIntoView({behavior:'smooth'}); return false;">Equipo</a><br>
                        <a href="#"
                            onclick="document.getElementById('landingTestimonials').scrollIntoView({behavior:'smooth'}); return false;">Testimonios</a><br>
                        <a href="#"
                            onclick="document.getElementById('landingContact').scrollIntoView({behavior:'smooth'}); return false;">Contacto</a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Síguenos</h5>
                        <div class="footer-social d-flex gap-2">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                        <p class="mt-3" style="font-size:14px;color:var(--text-2);">
                            <i class="fa-regular fa-envelope me-1"></i> contacto@tallerautomotriz.com<br>
                            <i class="fa-regular fa-clock me-1"></i> Lun - Vie 08:00 - 18:00
                        </p>
                    </div>
                </div>
                <div class="footer-bottom text-center">
                    &copy; 2026 Taller Automotriz. Todos los derechos reservados. |
                    <a href="#" style="color:var(--text-2);font-size:13px;">Aviso legal</a> ·
                    <a href="#" style="color:var(--text-2);font-size:13px;">Política de privacidad</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function showLoginScreen() {
            alert('Función de inicio de sesión. Conéctala con tu lógica de Laravel.');
        }
        function scrollToLocations() {
            document.getElementById('landingLocations').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Navbar scroll
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Reveal on scroll
        const revealEls = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(el => io.observe(el));

        // Tilt 3D para todos los elementos .tilt-element
        document.querySelectorAll('.tilt-element').forEach(el => {
            el.style.transformStyle = 'preserve-3d';
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const cx = rect.width / 2;
                const cy = rect.height / 2;
                const rotateY = ((x - cx) / cx) * 8;
                const rotateX = -((y - cy) / cy) * 8;
                el.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(0)`;
            });
            el.addEventListener('mouseleave', () => {
                el.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        });

        // Tilt especial para la tarjeta hero
        const heroCard = document.getElementById('heroCard');
        if (heroCard) {
            heroCard.addEventListener('mousemove', (e) => {
                const rect = heroCard.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                heroCard.style.transform = `rotateX(${6 - y * 14}deg) rotateY(${-10 + x * 16}deg)`;
            });
            heroCard.addEventListener('mouseleave', () => {
                heroCard.style.transform = 'rotateX(6deg) rotateY(-10deg)';
            });
        }
    </script>
</body>

</html>