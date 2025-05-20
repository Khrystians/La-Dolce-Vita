<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f6f6f6;
    }
    .sidebar {
      background-color: white;
      height: 200vh; /* Ajusta la altura de la barra lateral */
      padding: 20px;
      border-right: 1px solid #ddd;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Añade sombra al sidebar */
    }
    .sidebar .user-info {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar .user-info img {
      width: 100px; /* Aumenta el tamaño de la imagen */
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .sidebar .user-info h6 {
      font-size: 1.2rem;
      margin: 0;
    }
    .sidebar .divider {
      border-top: 1px solid #ddd;
      margin: 15px 0;
    }
    .nav-link {
      font-size: 1.5rem; /* Aumenta aún más el tamaño del texto */
      color: #6c757d; /* Cambia el color a gris */
      transition: color 0.2s ease-in-out; /* Transición suave para el color */
      display: flex;
      align-items: center;
      gap: 10px; /* Espaciado entre el ícono y el texto */
    }
    .nav-link:hover {
      color: #343a40; /* Cambia el color al pasar el cursor */
    }
    .nav-link.active {
      color: #000; /* Cambia el color del link seleccionado a negro */
      font-weight: bold; /* Resalta el link seleccionado */
    }
    .logout-btn {
      margin-top: auto;
      text-align: center;
    }
    .logout-btn button {
      font-size: 1rem;
      color: white;
      background-color: #c94b4b;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    .logout-btn button:hover {
      background-color: #a33a3a;
    }
    .top-bar {
      background-color: #c94b4b;
      color: white;
      padding: 10px 0;
      display: flex;
      align-items: center; /* Centra verticalmente */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Añade sombra al topbar */
    }
    .top-bar .col {
      text-align: center;
      border-right: 1px solid white;
      font-size: 1.2rem; /* Aumenta el tamaño del texto */
      display: flex;
      flex-direction: column;
      justify-content: center; /* Centra horizontalmente */
    }
    .top-bar .col:last-child {
      border-right: none;
    }
    .top-bar .col span {
      color:rgb(31, 198, 70); /* Muestra el dinero ganado en verde */
      font-weight: bold;
      /* border: 1px solid white;  Añade un ligero borde blanco */
      padding: 2px 5px; /* Espaciado interno */
      border-radius: 5px; /* Bordes redondeados */
    }
    .category-item {
      background-color: white;
      border: none;
      padding: 20px;
      margin: 2rem; /* Aumenta la separación entre los divs */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out; /* Añade transición para la animación */
      display: flex;
      flex-direction: column; /* Coloca el logo encima del texto */
      align-items: center;
      justify-content: center;
      width: 9rem; /* Div cuadrado */
      height: 10rem; /* Ajusta la altura para incluir el texto */
      text-align: center;
      cursor: pointer;
    }
    .category-item:hover {
      transform: scale(1.1); /* Aumenta ligeramente el tamaño al pasar el cursor */
    }
    .category-item img {
      width: 5rem; /* Tamaño del logo */
      height: 5rem;
      margin-bottom: 5px; /* Espacio entre el logo y el texto */
    }
    .category-item span {
      font-size: 1.2rem; /* Aumenta el tamaño del texto */
      font-family: 'Georgia', serif; /* Aplica una tipografía elegante */
    }
    .category-item.active {
      background-color: #c94b4b;
      color: white;
    }
    .categories-container {
      display: flex;
      justify-content: center; /* Centra los divs horizontalmente */
      flex-wrap: wrap; /* Permite que los divs se ajusten en varias filas */
    }
    .menu-card {
      border-radius: 0; /* Elimina los bordes redondeados */
      overflow: hidden; /* Asegura que el contenido no se desborde */
      padding: 20px; /* Añade más espacio interno */
      width: 300px; /* Reduce el ancho de las tarjetas */
      margin: auto; /* Centra las tarjetas dentro de su columna */
    }
    .menu-card img {
      height: 13rem;
      object-fit: cover;
      margin-bottom: 20px; /* Aumenta el espacio entre la imagen y el contenido */
      border-radius: 8px; /* Redondea ligeramente los bordes de la imagen */
    }
    .menu-card button {
      font-size: 1.2rem; /* Aumenta el tamaño del texto de los botones */
      /* font-family: 'Georgia', serif;  Aplica la fuente Georgia */
      font-weight: normal; /* Sin negrita */
    }
    .menu-card h6 {
      font-size: 1.5rem; /* Aumenta el tamaño del título */
      margin-top: -1rem; /* Reduce el espacio entre el título y la imagen */
    }
    .menu-card .allergens {
      display: flex;
      justify-content: center;
      gap: 10px; /* Espaciado entre los iconos */
      margin-top: 10px; /* Espacio entre el contenido y los iconos */
    }
    .menu-card .allergens img {
      width: 2.7rem; /* Aumenta el tamaño de los iconos */
      height: 2.7rem;
    }
    .footer {
      background-color: #c94b4b; /* Mismo color que el topbar */
      color: white;
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column">
      <!-- Logo y Nombre del Restaurante -->
      <div class="text-center mb-4">
        <img src="../Assets/Images/La Dolce Vita icon 1.png" alt="Logo" class="img-fluid mb-3"  style="width: 11rem;"> <!-- Aumenta el tamaño del logo -->
        <h4 style="font-size: 1.8rem; margin-top: -1rem;">LA DOLCE VITA</h4> <!-- Aumenta el tamaño del texto -->
      </div>

      <!-- Línea de separación -->
      <div class="divider"></div>

      <!-- Fecha actual -->
      <div class="text-center mb-3">
        <small class="text-muted"><?php echo date('d/m/Y'); ?></small> <!-- Muestra la fecha actual -->
      </div>

      <!-- User Info -->
      <div class="user-info">
        <img src="https://thumbs.dreamstime.com/b/usuario-del-miembro-perfil-icono-hombre-vector-s%C3%ADmbolo-de-perconal-en-el-fondo-aislado-blanco-141728154.jpg" alt="Usuario">
        <h6>Administrador</h6>
      </div>

      <!-- Línea de separación -->
      <div class="divider"></div>

      <!-- Navigation Links -->
      <nav class="nav flex-column mt-4">
        <a class="nav-link" href="Administrador-Finanzas-Categorias.php"><i class="bi bi-bar-chart"></i> Finanzas</a>
        <a class="nav-link" href="Administrador-Calendario.php"><i class="bi bi-calendar"></i> Calendario</a>
        <a class="nav-link" href="Administrador-Eventos.php"><i class="bi bi-calendar-event"></i> Eventos</a>
        <a class="nav-link" href="#"><i class="bi bi-people"></i> Equipo</a>
        <a class="nav-link" href="#"><i class="bi bi-egg-fried"></i> Cocina</a> <!-- Nuevo enlace -->
        <a class="nav-link active" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
        <a class="nav-link" href="#"><i class="bi bi-plus-circle"></i> Añadir plato</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> Información General</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="#"><i class="bi bi-bell"></i> Notificaciones <span class="badge bg-danger">3</span></a> <!-- Notificaciones -->
      </nav>

      <!-- Línea de separación -->
      <div class="divider mt-5"></div>

      <!-- Botón de Redes Sociales -->
      <div class="social-btn mb-3 text-center">
        <button class="btn btn-success w-75">Redes Sociales</button> <!-- Cambiado a verde -->
      </div>

      <!-- Botón de Deslogearse -->
      <div class="logout-btn text-center">
        <button class="btn btn-danger w-75 mb-3">Deslogearse</button>
      </div>

      <!-- Footer -->
      <div class="footer mt-auto">
        <small>Versión 1.0.0</small>
        <br>
        <small>© 2023 La Dolce Vita</small>
      </div>
    </div>

    <!-- Main content -->
    <div class="col-md-10">

      <!-- Top bar -->
      <div class="row top-bar text-white mb-4">
        <div class="col text-center">
          <img src="../Assets/Images/logos/carrito_de_compra.png" alt="Ventas" style="width: 4rem; height: 3rem; display: block; margin: 0 auto;">
          Ventas en general
        </div>
        <div class="col">Año<br><span>2024,47€</span></div>
        <div class="col">Mes<br><span>2024,47€</span></div>
        <div class="col">Semana<br><span>2024,47€</span></div>
        <div class="col">Hoy<br><span>2024,47€</span></div>
        <div class="col text-center">
          <img src="../Assets/Images/logos/dinero.png" alt="Dinero" style="width: 4rem; height: 3rem; display: block; margin: 0 auto;">
        </div>
      </div>

      <!-- Categorías -->
      <div class="categories-container px-4 mb-4">
        <div class="category-item active">
          <img src="../Assets/Images/logos/entradas.png" alt="Entradas">
          <span>Entradas</span>
        </div>
        <div class="category-item">
          <img src="../Assets/Images/logos/pasta.png" alt="Pasta">
          <span>Pasta</span>
        </div>
        <div class="category-item">
          <img src="../Assets/Images/logos/pizza.png" alt="Pizzas">
          <span>Pizzas</span>
        </div>
        <div class="category-item">
          <img src="../Assets/Images/logos/antipasta.png" alt="AntiPasta">
          <span>AntiPasta</span>
        </div>
        <div class="category-item">
          <img src="../Assets/Images/logos/bebidas.png" alt="Bebidas">
          <span>Bebidas</span>
        </div>
        <div class="category-item">
          <img src="../Assets/Images/logos/postre.png" alt="Postres">
          <span>Postres</span>
        </div>
      </div>

      <!-- Menú items -->
      <div class="row row-cols-1 row-cols-md-4 g-4 px-4">
        <!-- Tarjeta 1 -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314837/CARTA/CUORE%20FELICE/la-tagliatella-trio-di-bruschette.jpg" class="card-img-top" alt="Tortellini frito">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Tortellini frito</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
                <img src="../Assets/Images/logos/lacteos.png" alt="Lactosa">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314836/CARTA/CUORE%20FELICE/la-tagliatella-pizza-all-uovo.jpg" class="card-img-top" alt="Pizza al huevo">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Pizza al huevo</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/huevo.png" alt="Huevo">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724315055/CARTA/TARTAR_CARPACCIO/la-tagliatella-tartar-di-salmone.jpg" class="card-img-top" alt="Tartar de salmón">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Tartar de salmón</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/pescado.png" alt="Pescado">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-danger btn-sm w-100">Eliminar del menú</button>
            </div>
          </div>
        </div>

        <!-- Otra tarjeta -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314899/CARTA/INSALATE/la-tagliatella-insalata-affumicata.jpg" class="card-img-top" alt="Tortellini frito">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Tortellini frito</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/pescado.png" alt="Pescado">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>

        <!-- Nueva fila -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314899/CARTA/INSALATE/la-tagliatella-insalata-affumicata.jpg" class="card-img-top" alt="Ensalada ahumada">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Ensalada ahumada</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724315055/CARTA/TARTAR_CARPACCIO/la-tagliatella-tartar-di-salmone.jpg" class="card-img-top" alt="Tartar de salmón">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Tartar de salmón</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/pescado.png" alt="Pescado">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-danger btn-sm w-100">Eliminar del menú</button>
            </div>
          </div>
        </div>

        <!-- Otra fila -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314836/CARTA/CUORE%20FELICE/la-tagliatella-pizza-all-uovo.jpg" class="card-img-top" alt="Pizza al huevo">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Pizza al huevo</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/huevo.png" alt="Huevo">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314837/CARTA/CUORE%20FELICE/la-tagliatella-trio-di-bruschette.jpg" class="card-img-top" alt="Bruschetta">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Bruschetta</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
                <img src="../Assets/Images/logos/lacteos.png" alt="Lactosa">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>

        <!-- Nueva tarjeta 1 -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314836/CARTA/CUORE%20FELICE/la-tagliatella-lasagna.jpg" class="card-img-top" alt="Lasaña">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Lasaña</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/gluten.png" alt="Gluten">
                <img src="../Assets/Images/logos/lacteos.png" alt="Lactosa">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>

        <!-- Nueva tarjeta 2 -->
        <div class="col">
          <div class="card menu-card shadow-sm">
            <img src="https://res.cloudinary.com/hesvvq3zo/image/upload/c_scale,w_500,/v1724314837/CARTA/CUORE%20FELICE/la-tagliatella-tiramisu.jpg" class="card-img-top" alt="Tiramisú">
            <div class="card-body text-center">
              <h6 class="card-title mb-1">Tiramisú</h6>
              <div class="allergens">
                <img src="../Assets/Images/logos/huevo.png" alt="Huevo">
                <img src="../Assets/Images/logos/lacteos.png" alt="Lactosa">
              </div>
              <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>
              <button class="btn btn-success btn-sm w-100">Añadir al menú</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>