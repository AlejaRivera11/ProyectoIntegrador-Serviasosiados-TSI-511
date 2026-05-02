<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviasociados – Taller Automotriz</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <!-- ============ HEADER / NAVEGACIÓN ============ -->
    <header>
        <div class="nav-contenedor">
            <div class="logo">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="sidebar-logo">
                <span>Serviasociados</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#testimonios">Testimonios</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    @auth
                        <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    @else
                        <li><a href="{{ route('login') }}"> Iniciar Sesión </a></li>
                        <li><a href="{{ route('register') }}">Registrar </a></li>
                    @endauth
                </ul>

            </nav>
        </div>
    </header>

    <!-- ============ SECCIÓN 1: INICIO ============ -->
    <section id="inicio" class="seccion-inicio">
        <div class="contenedor">
            <h1>Tu vehículo en las mejores manos</h1>
            <p>
                En Serviasociados ofrecemos mantenimiento, diagnóstico y reparación
                para todo tipo de vehículos. Agenda tu cita fácilmente y olvídate de las filas.
            </p>
            <div class="inicio-botones">
                <a href="{{ route('login') }}" class="btn-principal">Agendar cita</a>
                <a href="#servicios" class="btn-secundario">Ver servicios</a>
            </div>
        </div>
    </section>

    <!-- ============ SECCIÓN 2: SERVICIOS ============ -->
    <section id="servicios" class="seccion-gris">
        <div class="contenedor">
            <h2>Nuestros Servicios</h2>
            <p class="subtitulo-sesion">Contamos con técnicos certificados para atender cualquier necesidad de tu
                vehículo.</p>

            <div class="tarjetas">

                <div class="tarjeta">
                    <span class="icono">🛢</span>
                    <h3>Cambio de aceite y filtros</h3>
                    <p>Mantenemos tu motor protegido con aceites de calidad y cambio de filtros originales.</p>
                </div>

                <div class="tarjeta">
                    <span class="icono">🔩</span>
                    <h3>Mantenimiento preventivo</h3>
                    <p>Revisión completa de todos los sistemas del vehículo para evitar fallas futuras.</p>
                </div>

                <div class="tarjeta">
                    <span class="icono">🛑</span>
                    <h3>Sistema de frenos</h3>
                    <p>Revisión, ajuste y cambio de pastillas, discos y líquido de frenos.</p>
                </div>

                <div class="tarjeta">
                    <span class="icono">⚡</span>
                    <h3>Sistema eléctrico</h3>
                    <p>Diagnóstico y reparación de batería, alternador y sistema de arranque.</p>
                </div>

                <div class="tarjeta">
                    <span class="icono">❄</span>
                    <h3>Aire acondicionado</h3>
                    <p>Carga de gas, revisión de compresor y reparación del sistema de climatización.</p>
                </div>

                <div class="tarjeta">
                    <span class="icono">🔍</span>
                    <h3>Diagnóstico general</h3>
                    <p>Revisión completa del vehículo con herramientas de diagnóstico actualizadas.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ SECCIÓN PARALLAX ============ -->
    <section class="seccion-parallax">
        <div class="parallax-contenido">
            <h2>Más de 10 años cuidando tu vehículo</h2>
            <p>Técnicos certificados, repuestos originales y atención personalizada en Cali.</p>
            <a href="#contacto" class="btn-principal">Agendar cita ahora</a>
        </div>
    </section>

    <!-- ============ SECCIÓN 3: NOSOTROS ============ -->
    <section id="nosotros" class="seccion-blanca">
        <div class="contenedor">
            <h2>¿Por qué elegirnos?</h2>
            <p class="subtitulo-sesion">Llevamos más de 10 años cuidando los vehículos de nuestros clientes en Cali.</p>

            <div class="nosotros-grid">

                <div class="nosotros-texto">
                    <p>
                        Serviasociados nació con el objetivo de brindar un servicio automotriz
                        honesto, rápido y de calidad. Sabemos lo importante que es tu vehículo
                        en tu día a día, por eso trabajamos para devolvértelo en las mejores
                        condiciones en el menor tiempo posible.
                    </p>

                    <ul class="lista-beneficios">
                        <li>✔ Técnicos certificados con más de 10 años de experiencia</li>
                        <li>✔ Repuestos originales de proveedores autorizados</li>
                        <li>✔ Presupuesto sin compromiso antes de iniciar cualquier trabajo</li>
                        <li>✔ Garantía de 30 días en mano de obra</li>
                    </ul>
                </div>

                <div class="nosotros-stats">
                    <div class="stat">
                        <span class="stat-numero">+500</span>
                        <span class="stat-texto">Clientes atendidos</span>
                    </div>
                    <div class="stat">
                        <span class="stat-numero">10+</span>
                        <span class="stat-texto">Años de experiencia</span>
                    </div>
                    <div class="stat">
                        <span class="stat-numero">6</span>
                        <span class="stat-texto">Especialidades</span>
                    </div>
                    <div class="stat">
                        <span class="stat-numero">98%</span>
                        <span class="stat-texto">Clientes satisfechos</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ SECCIÓN 4: TESTIMONIOS ============ -->
    <section id="testimonios" class="seccion-gris">
        <div class="contenedor">
            <h2>Lo que dicen nuestros clientes</h2>
            <p class="subtitulo-sesion">Más de 500 clientes confían en nosotros para el cuidado de sus vehículos.</p>

            <div class="tarjetas">

                <div class="tarjeta testimonio">
                    <p class="estrellas">★★★★★</p>
                    <p class="texto-testimonio">
                        "Llevé mi carro con un ruido extraño y en el mismo día me lo entregaron
                        reparado. El diagnóstico fue claro y el precio justo. ¡100% recomendados!"
                    </p>
                    <p class="autor"><strong>Carlos Rodríguez</strong> – Chevrolet Spark GT</p>
                </div>

                <div class="tarjeta testimonio">
                    <p class="estrellas">★★★★★</p>
                    <p class="texto-testimonio">
                        "Excelente atención desde el primer momento. Me explicaron todo el proceso
                        paso a paso y el trabajo quedó perfecto. Definitivamente vuelvo."
                    </p>
                    <p class="autor"><strong>María López</strong> – Renault Logan</p>
                </div>

                <div class="tarjeta testimonio">
                    <p class="estrellas">★★★★☆</p>
                    <p class="texto-testimonio">
                        "Muy buena experiencia. El sistema de citas es muy cómodo, no tuve que
                        esperar. El taller está bien organizado y los técnicos son muy profesionales."
                    </p>
                    <p class="autor"><strong>Jorge Peña</strong> – Mazda 3</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ SECCIÓN 5: CONTACTO ============ -->
    <section id="contacto" class="seccion-blanca">
        <div class="contenedor">
            <h2>Contáctanos</h2>
            <p class="subtitulo-sesion">Escríbenos o visítanos. También puedes agendar tu cita directamente en línea.
            </p>

            <div class="contacto-grid">

                <div class="contacto-info">
                    <h3>Información de contacto</h3>

                    <ul class="lista-contacto">
                        <li>
                            <span class="icono">📍</span>
                            <div>
                                <strong>Dirección</strong>
                                <p>Calle 44 #12-29, Barrio El Troncal, Cali – Colombia</p>
                            </div>
                        </li>
                        <li>
                            <span class="icono">📞</span>
                            <div>
                                <strong>Teléfono</strong>
                                <p>311 719 5434</p>
                            </div>
                        </li>
                        <li>
                            <span class="icono">✉</span>
                            <div>
                                <strong>Correo</strong>
                                <p>contacto@serviasociados.com</p>
                            </div>
                        </li>
                        <li>
                            <span class="icono">🕐</span>
                            <div>
                                <strong>Horario</strong>
                                <p>Lunes a Viernes: 7:00 AM – 6:00 PM<br>Sábados: 7:00 AM – 1:00 PM</p>
                            </div>
                        </li>
                    </ul>

                    <a href="cita.html" class="btn-principal" style="display:inline-block; margin-top:24px;">
                        📅 Ir al formulario de citas
                    </a>
                </div>

                <div class="contacto-form">
                    <h3>Envíanos un mensaje</h3>
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" placeholder="Tu nombre completo" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" id="correo" placeholder="tucorreo@ejemplo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <input type="text" id="asunto" placeholder="¿En qué te podemos ayudar?">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea id="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
                        </div>
                        <button type="submit">Enviar mensaje</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ FOOTER ============ -->
    <footer>
        <div class="contenedor footer-contenido">

            <div class="footer-marca">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="sidebar-logo">
                <span>Serviasociados</span>
                <p>Taller Automotriz de Confianza.<br>Cali, Colombia.</p>
            </div>

            <div class="footer-nav">
                <h4>Navegación</h4>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#testimonios">Testimonios</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-datos">
                <h4>Contacto</h4>
                <p>📍 Calle 44 #12-29, Barrio El Troncal, Cali</p>
                <p>📞 311 719 5434</p>
                <p>✉ contacto@serviasociados.com</p>
                <p>🕐 Lun–Vie: 7AM–6PM · Sáb: 7AM–1PM</p>
            </div>

        </div>
        <div class="footer-bottom">
            <p>© 2025 Serviasociados · Todos los derechos reservados · Programación III – UNIAJC</p>
        </div>
    </footer>

</body>

</html>
