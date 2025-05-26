<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Top Bar</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      padding: 0;
    }

    .top-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
      background-color: #fff;
      margin: 0; /* Sin margen, pegado al borde superior */
      box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .logo-section {
      display: flex;
      align-items: center;
    }

    .logo-section img {
      height: 5rem;
      margin-right: 1rem;
    }

    .logo-section span {
      font-size: 2rem;
      font-style: italic; /* En cursiva */
    }

    .divider {
      width: 1px;
      height: 60px;
      background-color: #ccc;
      margin: 0 20px;
    }

    .mesa-container {
      display: flex;
      flex-wrap: nowrap;
      gap: 16px;
      padding: 16px;
      background-color: #fff; /* Cambiado de #f7f7f7 a blanco */
      border-radius: 6px;
      max-width: 900px;
      overflow-x: auto;
      scroll-behavior: smooth;
    }

    .mesa-box {
      border: 2px solid #333;
      padding: 18px 28px;
      border-radius: 12px;
      text-align: center;
      cursor: pointer;
      background: linear-gradient(135deg, #fff 70%, #ffe5b4 100%);
      box-shadow: 0 4px 18px rgba(0,0,0,0.18), 0 1.5px 4px rgba(0,0,0,0.13); /* Sombra oscura */
      transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
      min-width: 90px;
      min-height: 70px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex: 0 0 auto;
    }

    .mesa-box:hover {
      background: linear-gradient(135deg, #fffbe6 70%, #ffd6a0 100%);
      transform: translateY(-4px) scale(1.04);
      box-shadow: 0 8px 32px rgba(0,0,0,0.25), 0 2px 8px rgba(0,0,0,0.18); /* Sombra oscura al hacer hover */
      border-color: #c0392b;
    }

    .mesa-title {
      font-size: 15px;
      color: #555;
      margin-bottom: 4px;
      letter-spacing: 1px;
    }

    .mesa-id {
      font-size: 22px;
      font-weight: bold;
      color: #c0392b; /* Cambiado a rojo */
      letter-spacing: 2px;
    }

    .finalizar {
      display: flex;
      align-items: center;
      color: #c0392b;
      font-weight: 700;
      cursor: pointer;
      font-size: 2rem; /* Más grande */
      padding: 0.5rem 1.2rem;
      gap: 0.7rem;
      letter-spacing: 1px;
      transition: font-size 0.2s;
    }

    .finalizar img {
      height: 4rem;
      margin-right: 10px;
    }

    .slider-btn {
      width: 4rem;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin: 0 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.07);
      user-select: none;
      position: relative;
      top: 50%;
      transform: translateY(0%);
      z-index: 2;
      font-size: 0;
      padding: 0;
      background: #fff;
      border: none;
      outline: none;
    }
    #slider-left {
      background-image: url('../Assets/Images/logos/arrow-izquierda.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #slider-right {
      background-image: url('../Assets/Images/logos/arrow-derecha.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #slider-left:hover,
    #slider-right:hover {
      background-size: 2.7rem 2.7rem;
    }
    #slider-left::before,
    #slider-right::before {
      content: none !important;
    }
    #slider-left:after,
    #slider-right:after {
      content: none !important;
    }
    .slider-btn:hover {
     
      color: #fff;
    }

    /* Aquí comienzan los estilos de las tarjetas */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 0px;
    }

    .container {
      display: flex;
      gap: 28px;
      flex-wrap: nowrap;
      justify-content: flex-start;
      margin-top: 2rem;
      overflow-x: auto;
      scroll-behavior: smooth;
      max-width: 100vw;
      /* Mostrar solo 5 tarjetas a la vez */
      width: calc(340px * 5 + 28px * 4); /* 5 tarjetas + 4 gaps */
    }
    .carousel-btn {
      width: 4rem;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin: 0 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.07);
      user-select: none;
      position: relative;
      top: 50%;
      transform: translateY(550%);
      z-index: 2;
      font-size: 0;
      padding: 0;
      background: #fff;
      border: none;
      outline: none;
    }
    #carousel-left {
      background-image: url('../Assets/Images/logos/arrow-izquierda.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #carousel-right {
      background-image: url('../Assets/Images/logos/arrow-derecha.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #carousel-left:hover,
    #carousel-right:hover {
      background-size: 2.7rem 2.7rem;
    }
    #carousel-left::before,
    #carousel-right::before {
      content: none !important;
    }
    #carousel-left:after,
    #carousel-right:after {
      content: none !important;
    }
    .carousel-btn:hover {

    }

    /* Aquí terminan los estilos de las tarjetas */
    @media (max-width: 900px) {
      .container {
        max-width: 100vw;
      }
    }

    .mesa-card {
      width: 340px;
      min-width: 340px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.13);
      overflow: hidden;
      flex: 0 0 auto;
      margin: 15px 14px;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .mesa-header {
      text-align: center;
      padding: 15px 0 5px;
      font-size: 27px;
      font-weight: bold;
    }

    .pedido-subtitle {
      text-align: center;
      font-size: 16px;
      color: #555;
      border-bottom: 1px solid #ccc;
      margin: 0 10px 10px;
      padding-bottom: 10px;
      position: relative;
    }

    .pedido-subtitle::after {
      content: "";
      position: absolute;
      bottom: -1px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 2px;
      background-color: #c0392b;
    }

    .accordion {
      border-top: 1px solid #ccc;
    }

    .accordion-header {
      background-color: #ccc;
      padding: 10px 15px;
      cursor: pointer;
      font-weight: 300;
      border-top: 2px solid #222;
      border-bottom: 2px solid #222;
      text-align: center;
      justify-content: center;
      display: flex;
      font-size: 17px;
    }

    .accordion-content {
      display: block;
      max-height: 0;
      overflow: hidden;
      background-color: #fff;
      transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1), padding 0.35s;
      padding: 0 15px;
    }

    .accordion.active .accordion-content {
      display: block;
      max-height: 500px;
      padding: 10px 15px;
      /* Ajusta max-height si tus contenidos pueden ser más grandes */
    }

    .plato-item {
      display: flex;
      justify-content: space-between;
      padding: 13px 18px;
      border-bottom: 1px solid #eee;
      font-size: 16px;
    }

    .plato-item:last-child {
      border-bottom: none;
    }

    .footer-bar {
      background-color: #c0392b;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 18px;
      padding: 1rem 1rem;
      margin-top: auto;
    }

    .footer-bar button {
      padding: 0.6rem 1.5rem; /* Más grande */
      border-radius: 8px;
      border: 1px solid #111; /* Borde negro delgado */
      font-size: 20px; /* Más grande */
      font-family: 'Montserrat', Arial, sans-serif; /* Cambia tipografía */
      font-weight: 100; /* Más grueso */
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      margin: 5rem 6px;
      letter-spacing: 1px;
      color: #111; /* Letras negras */
      position: relative;
      overflow: hidden;
      padding-left: 1.5rem; /* Espacio mínimo para el icono */
      text-align: center;   /* Centrado por defecto */
    }
    .footer-bar button:hover {
      padding-left: 2.1rem;
      text-align: left;
      transition: padding-left 0.7s cubic-bezier(0.4,0,0.2,1), text-align 0.7s cubic-bezier(0.4,0,0.2,1);
    }
    .footer-bar .btn-preparar::after,
    .footer-bar .btn-eliminar::after {
      content: '';
      display: inline-block;
      position: absolute;
      left: 8px;
      top: 50%;
      transform: translateY(-50%) scale(0.6);
      opacity: 0;
      width: 22px;
      height: 22px;
      background: none;
      transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1);
      pointer-events: none;
    /* Play icon SVG en verde */
      background-image: url('data:image/svg+xml;utf8,<svg fill="%2327ae60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="7,4 19,12 7,20" /></svg>');
      background-repeat: no-repeat;
      background-size: 22px 22px;
    }
    .footer-bar .btn-preparar:hover::after {
      opacity: 1;
      transform: translateY(-50%) scale(1);
    }
    .footer-bar .btn-eliminar::after {
      content: '';
      display: inline-block;
      position: absolute;
      left: 8px;
      top: 50%;
      transform: translateY(-50%) scale(0.6);
      opacity: 0;
      width: 22px;
      height: 22px;
      background: none;
      transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1);
      pointer-events: none;
    /* X icon SVG en rojo */
      background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18" stroke="%23e74c3c" stroke-width="2"/><line x1="18" y1="6" x2="6" y2="18" stroke="%23e74c3c" stroke-width="2"/></svg>');
      background-repeat: no-repeat;
      background-size: 22px 22px;
    }
    .footer-bar .btn-eliminar:hover::after {
      opacity: 1;
      transform: translateY(-50%) scale(1);
    }

    /* Estilos para abrir los acordeones */
    .accordion.active .accordion-content {
      display: block;
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <!-- Logo + Nombre -->
    <div class="logo-section">
      <img src="../Assets/Images/La Dolce Vita icon 1.png" alt="logo" />
      <span><strong>LA DOLCE VITA</strong></span>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Mesas Slider -->
    <button class="slider-btn" id="slider-left">&#8592;</button>
    <div class="mesa-container" id="mesa-slider">
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">1</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">2</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">3</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">4</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">5</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">6</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">7</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">8</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">9</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">10</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">11</div>
      </div>
      <div class="mesa-box">
        <div class="mesa-title">Mesa</div>
        <div class="mesa-id">12</div>
      </div>
    </div>
    <button class="slider-btn" id="slider-right">&#8594;</button>

    <!-- Finalizar -->
    <div class="finalizar">
      <img src="../Assets/Images/logos/checking.png" alt="icono salir"/>
      <span>Finalizar</span>
    </div>
  </div>
  <!-- Aquí termina el top-bar -->

  <!-- Carrusel de pedidos -->
  <div style="display: flex; align-items: flex-start; justify-content: center;">
    <button class="carousel-btn" id="carousel-left"></button>
    <div class="container" id="pedido-carousel">
      <!-- Tarjeta de mesa ejemplo 1 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa X</div>
        <div class="pedido-subtitle">Nombre del pedido</div>

        <!-- Acordeón por categoría -->
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Pan de ajo</span><span>2</span></div>
            <div class="plato-item"><span>Ensalada César</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tortelini frito</span><span>3</span></div>
            <div class="plato-item"><span>Tortelini frito</span><span>3</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Spaghetti</span><span>2</span></div>
            <div class="plato-item"><span>Lasagna</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Margherita</span><span>1</span></div>
            <div class="plato-item"><span>Pepperoni</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Agua</span><span>2</span></div>
            <div class="plato-item"><span>Refresco</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tiramisú</span><span>1</span></div>
            <div class="plato-item"><span>Panna Cotta</span><span>2</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 2 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa X</div>
        <div class="pedido-subtitle">Nombre del pedido</div>

        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Capresse</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Bruschetta</span><span>4</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Ravioli</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Cuatro Quesos</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Vino</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Cannoli</span><span>2</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 3 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa X</div>
        <div class="pedido-subtitle">Pedido especial</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tabla de quesos</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Carpaccio</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Fettuccine Alfredo</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Hawaiana</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Limonada</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Helado</span><span>3</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 4 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa X</div>
        <div class="pedido-subtitle">Cumpleaños</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Ensalada mixta</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Olivas</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Penne Arrabiata</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Vegetariana</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Agua mineral</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Pastel de cumpleaños</span><span>1</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 5 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa 5</div>
        <div class="pedido-subtitle">Mesa familiar</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Ensalada Capresse</span><span>2</span></div>
            <div class="plato-item"><span>Pan de ajo</span><span>4</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Prosciutto</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tagliatelle</span><span>3</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Barbacoa</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Agua</span><span>5</span></div>
            <div class="plato-item"><span>Refresco</span><span>3</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tiramisú</span><span>2</span></div>
            <div class="plato-item"><span>Panna Cotta</span><span>1</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 6 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa 6</div>
        <div class="pedido-subtitle">Mesa amigos</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Bruschetta</span><span>3</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Olivas</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Spaghetti</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Diavola</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Cerveza</span><span>4</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Panna Cotta</span><span>2</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 7 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa 7</div>
        <div class="pedido-subtitle">Mesa romántica</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Ensalada de rúcula</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Carpaccio</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Gnocchi</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Funghi</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Vino tinto</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Tiramisú</span><span>1</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- Tarjeta de mesa ejemplo 8 -->
      <div class="mesa-card">
        <div class="mesa-header">Mesa 8</div>
        <div class="pedido-subtitle">Mesa ejecutiva</div>
        <div class="accordion">
          <div class="accordion-header">Entradas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Ensalada César</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Antipasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Bruschetta</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pasta</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Lasagna</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Pizza</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Margherita</span><span>1</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Bebidas</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Agua</span><span>2</span></div>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header">Postre</div>
          <div class="accordion-content">
            <div class="plato-item"><span>Panna Cotta</span><span>1</span></div>
          </div>
        </div>
        <div class="footer-bar">
          <button class="btn-preparar">Preparar</button>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>
      <!-- ...puedes seguir agregando más tarjetas si lo deseas... -->
    </div>
    <button class="carousel-btn" id="carousel-right"></button>
  </div>
  <!-- Fin carrusel de pedidos -->

  <!-- Botonera -->
  <style>
    .botonera {
      display: flex;
      gap: 30px;
      justify-content: center;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 0;
      background: #fff;
      border-radius: 0;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.06);
      padding: 18px 0;
      z-index: 100;
    }

    .botonera button {
      padding: 20px 45px;
      font-size: 1.5rem;
      font-weight: bold;
      border: 1px solid #333;
      border-radius: 6px;
      background-color: white;
      color: black;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .botonera button:hover {
      background-color: #eee;
    }

    .botonera .activo {
      background-color: #c54646;
      color: white;
      border: none;
    }
  </style>

  <div class="botonera">
    <button class="activo">PEDIDOS EN PENDIENTES</button>
    <button>PEDIDOS EN PROCESO</button>
    <button>PEDIDOS COMPLETADOS</button>
  </div>
  <!-- Fin botonera -->

  <!-- Script para manejo de acordeones y carruseles -->
  <script>
    // Manejo del acordeón
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const accordion = header.parentElement;
        accordion.classList.toggle('active');
      });
    });

    // Abrir siempre 3 categorías por tarjeta al cargar la página: Entradas, Bebidas y uno de Pasta/Antipasta/Pizza
    document.querySelectorAll('.mesa-card').forEach(card => {
      const accordions = card.querySelectorAll('.accordion');
      let foundEntradas = false, foundBebidas = false, foundExtra = false;
      // Primero abre Entradas y Bebidas
      accordions.forEach(acc => {
        const header = acc.querySelector('.accordion-header');
        if (!foundEntradas && header && header.textContent.trim().toLowerCase() === 'entradas') {
          acc.classList.add('active');
          foundEntradas = true;
        }
        if (!foundBebidas && header && header.textContent.trim().toLowerCase() === 'bebidas') {
          acc.classList.add('active');
          foundBebidas = true;
        }
      });
      // Luego abre uno de Pasta, Antipasta o Pizza (el primero que encuentre)
      for (const acc of accordions) {
        const header = acc.querySelector('.accordion-header');
        if (
          header &&
          !foundExtra &&
          ['pasta', 'antipasta', 'pizza'].includes(header.textContent.trim().toLowerCase())
        ) {
          acc.classList.add('active');
          foundExtra = true;
        }
      }
    });

    // Carrusel horizontal para pedidos
    const pedidoCarousel = document.getElementById('pedido-carousel');
    document.getElementById('carousel-left').onclick = () => {
      pedidoCarousel.scrollBy({ left: -300, behavior: 'smooth' });
    };
    document.getElementById('carousel-right').onclick = () => {
      pedidoCarousel.scrollBy({ left: 300, behavior: 'smooth' });
    };

    // Slider horizontal para mesas
    const slider = document.getElementById('mesa-slider');
    document.getElementById('slider-left').onclick = () => {
      slider.scrollBy({ left: -200, behavior: 'smooth' });
    };
    document.getElementById('slider-right').onclick = () => {
      slider.scrollBy({ left: 200, behavior: 'smooth' });
    };
  </script>
</body>
</html>