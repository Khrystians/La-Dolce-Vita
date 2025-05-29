// Manejo de clic en categorías y carga dinámica de platos activos
document.querySelectorAll('.category-item').forEach(function(cat) {
  cat.addEventListener('click', function() {
    document.querySelectorAll('.category-item').forEach(function(c) {
      c.classList.remove('active');
      // Restaurar logo normal
      var img = c.querySelector('img');
      var base = img.getAttribute('alt').toLowerCase();
      img.src = "../Assets/Images/logos/" + base + ".png";
    });
    cat.classList.add('active');
    // Cambiar logo a _negro
    var img = cat.querySelector('img');
    var base = img.getAttribute('alt').toLowerCase();
    img.src = "../Assets/Images/logos/" + base + "_negro.png";
    var catId = cat.getAttribute('data-category-id');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'obtener_platos_cliente.php?category_id=' + catId, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('menu-items').innerHTML = xhr.responseText;
        afterMenuItemsUpdate();
      }
    };
    xhr.send();
  });
});

// Buscador de platos (filtra por nombre de plato)
document.getElementById('buscador-platos').addEventListener('input', function() {
  var filtro = this.value.toLowerCase();
  document.querySelectorAll('#menu-items .card.menu-card-cliente').forEach(function(card) {
    var nombre = card.querySelector('.card-title').textContent.toLowerCase();
    card.parentElement.style.display = nombre.includes(filtro) ? '' : 'none';
  });
});

// Animación de entrada para los platos
function animarPlatos() {
  document.querySelectorAll('#menu-items .menu-card-cliente').forEach(function(card, i) {
    card.classList.add('oculto');
    setTimeout(function() {
      card.classList.remove('oculto');
      card.classList.add('animar');
      setTimeout(function() {
        card.classList.remove('animar');
      }, 400);
    }, 60 * i);
  });
}

// Animar la aparición de los pedidos en el sidebar izquierdo
function animarPedidosSidebar() {
  var cards = document.querySelectorAll('.sidebar .order-card');
  cards.forEach(function(card, i) {
    setTimeout(function() {
      card.classList.remove('oculto');
      card.classList.add('animar');
      setTimeout(function() {
        card.classList.remove('animar');
      }, 400);
    }, 60 * i);
  });
}

// --- FUNCIONALIDAD AÑADIR AL SIDEBAR DERECHO ---
function attachAddButtons() {
  document.querySelectorAll('.menu-card-cliente .btn-success').forEach(function(btn) {
    btn.onclick = function() {
      var card = btn.closest('.menu-card-cliente');
      var img = card.querySelector('img.card-img-top').src;
      var nombre = card.querySelector('.card-title').textContent;
      var categoria = document.querySelector('.category-item.active span').textContent;
      var priceAttr = card.getAttribute('data-precio');
      var price = 0;
      if (priceAttr) {
        price = parseFloat(priceAttr);
      } else {
        var priceEl = card.querySelector('.price');
        if (priceEl) {
          var priceText = priceEl.textContent.replace(/[^\d.,]/g, '').replace(',', '.');
          price = parseFloat(priceText) || 0;
        }
      }
      var sidebar = document.querySelector('.sidebar-right');
      var items = sidebar.querySelectorAll('.item-card');
      var found = false;
      items.forEach(function(item) {
        var t = item.querySelector('.item-title');
        if (t && t.textContent === nombre) {
          var qtySpan = item.querySelector('.quantity span');
          qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
          found = true;
          // Animación de "bump" al actualizar cantidad
          item.classList.add('animar');
          setTimeout(function(){ item.classList.remove('animar'); }, 400);
        }
      });
      if (!found) {
        var div = document.createElement('div');
        div.className = 'item-card oculto';
        div.setAttribute('data-precio', price);
        div.innerHTML = `
          <img src="${img}" alt="${nombre}" />
          <div class="item-details">
            <p class="item-title">${nombre}</p>
            <p class="item-subtitle">${categoria}</p>
            <p class="item-price" style="display:none;">${price.toFixed(2)}</p>
          </div>
          <div class="quantity">
            <button class="qty-btn">-</button>
            <span>1</span>
            <button class="qty-btn add">+</button>
          </div>
        `;
        // Insertar antes del divider rojo
        var divider = sidebar.querySelector('.sidebar-divider-red');
        sidebar.insertBefore(div, divider);
        // Añadir funcionalidad a los botones + y -
        attachQtyButtons(div);
        // Animación de entrada
        setTimeout(function() {
          div.classList.remove('oculto');
          div.classList.add('animar');
          setTimeout(function() {
            div.classList.remove('animar');
          }, 400);
        }, 30);
      }
      actualizarTotalPedido();
    };
  });
}

function attachQtyButtons(context) {
  var minus = context.querySelector('.qty-btn:not(.add)');
  var plus = context.querySelector('.qty-btn.add');
  var qtySpan = context.querySelector('.quantity span');
  minus.onclick = function() {
    var qty = parseInt(qtySpan.textContent);
    if (qty > 1) {
      qtySpan.textContent = qty - 1;
    } else {
      // Eliminar el producto si la cantidad llega a 0
      context.remove();
    }
    actualizarTotalPedido();
  };
  plus.onclick = function() {
    qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
    actualizarTotalPedido();
  };
}

// Actualiza el coste total del pedido en el sidebar derecho
function actualizarTotalPedido() {
  var total = 0;
  document.querySelectorAll('.sidebar-right .item-card').forEach(function(item) {
    var qty = parseInt(item.querySelector('.quantity span').textContent);
    var price = 0;
    // Obtener el precio del producto
    var priceAttr = item.getAttribute('data-precio');
    if (priceAttr) {
      price = parseFloat(priceAttr);
    } else {
      var priceEl = item.querySelector('.item-price');
      if (priceEl) {
        price = parseFloat(priceEl.textContent.replace(',', '.')) || 0;
      }
    }
    total += qty * price;
  });
  var totalEl = document.querySelector('.cost-summary .price');
  if (totalEl) {
    totalEl.textContent = total > 0 ? '€' + total.toFixed(2) : '€0.00';
  }
}

// --- REGISTRAR PEDIDO ---
function registrarPedidoHandler() {
  // Recopilar productos del sidebar derecho
  var productos = [];
  document.querySelectorAll('.sidebar-right .item-card').forEach(function(item) {
    productos.push({
      nombre: item.querySelector('.item-title').textContent,
      cantidad: parseInt(item.querySelector('.quantity span').textContent),
      precio: parseFloat(item.getAttribute('data-precio')) || 0
    });
  });
  if (productos.length === 0) {
    alert('Añade al menos un producto antes de realizar el pedido.');
    return;
  }
  // Recoger nombre del pedido
  var nombrePedido = document.querySelector('.pedido-input').value || '';
  // Recoger mesa (usuario de sesión)
  var mesa = document.querySelector('h2').textContent;
  // Enviar por AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'registrar_pedido.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        if (res.success) {
          alert('Pedido realizado correctamente');
          // Limpiar productos del sidebar derecho
          document.querySelectorAll('.sidebar-right .item-card').forEach(function(item){ item.remove(); });
          actualizarTotalPedido();
          location.reload(); // Recargar la página para actualizar el estado de los pedidos
        } else {
          alert('Error al registrar el pedido');
        }
      } catch(e) {
        alert('Pedido realizado correctamente');
        document.querySelectorAll('.sidebar-right .item-card').forEach(function(item){ item.remove(); });
        actualizarTotalPedido();
        location.reload(); // Recargar la página para actualizar el estado de los pedidos
      }
    } else {
      alert('Error de conexión');
    }
  };
  xhr.send(JSON.stringify({
    mesa: mesa,
    nombre_pedido: nombrePedido,
    productos: productos
  }));
}

// MODAL DETALLE PLATO
function attachDetalleButtons() {
  document.querySelectorAll('.menu-card-cliente .btn-outline-primary').forEach(function(btn) {
    btn.onclick = function() {
      var card = btn.closest('.menu-card-cliente');
      var nombre = card.querySelector('.card-title').textContent;
      var categoria = document.querySelector('.category-item.active span').textContent;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'obtener_detalle_plato.php?nombre=' + encodeURIComponent(nombre) + '&categoria=' + encodeURIComponent(categoria), true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          try {
            var data = JSON.parse(xhr.responseText);
            var precio = data.precio ? '€' + parseFloat(data.precio).toFixed(2) : 'Sin precio';
            var descripcion = data.descripcion || 'Sin descripción';
            alert('Precio: ' + precio + '\nDescripción: ' + descripcion);
          } catch(e) {
            alert('No se pudo cargar el detalle del plato.');
          }
        } else {
          alert('No se pudo cargar el detalle del plato.');
        }
      };
      xhr.send();
    };
  });
}

// Llamar después de cargar platos dinámicamente
function afterMenuItemsUpdate() {
  attachAddButtons();
  attachDetalleButtons();
  animarPlatos();
}

// Inicializar eventos al cargar la página
attachAddButtons();
attachDetalleButtons();
document.querySelectorAll('.sidebar-right .item-card').forEach(attachQtyButtons);
actualizarTotalPedido();
animarPlatos();
animarPedidosSidebar();

// Mostrar botón de confirmación antes de enviar el pedido con transición
document.getElementById('btn-realizar-pedido').addEventListener('click', function() {
  var btnRealizar = this;
  var btnConfirmar = document.getElementById('btn-confirmar-pedido');
  // Ocultar con transición
  btnRealizar.classList.add('oculto');
  setTimeout(function() {
    btnRealizar.style.display = 'none';
    btnConfirmar.style.display = '';
    btnConfirmar.classList.add('oculto');
    // Forzar reflow para que la animación se aplique correctamente
    void btnConfirmar.offsetWidth;
    btnConfirmar.classList.remove('oculto');
    btnConfirmar.classList.add('animar');
    setTimeout(function() {
      btnConfirmar.classList.remove('animar');
    }, 400);
  }, 300);
});

document.getElementById('btn-confirmar-pedido').addEventListener('click', registrarPedidoHandler);

// Evento para finalizar y registrar ganancias
document.getElementById('btn-finalizar-pedidos').addEventListener('click', function() {
  // Primera confirmación
  if (!confirm('¿Desea finalizar y registrar las ganancias de todos los pedidos de esta mesa?')) return;
  // Segunda confirmación
  if (!confirm('¿Está seguro? Esta acción eliminará todos los pedidos de la mesa.')) return;
  var btn = this;
  btn.disabled = true;
  btn.textContent = 'Procesando...';
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    btn.disabled = false;
    btn.textContent = 'Finalizar';
    // Recargar la página siempre tras la petición
    location.reload();
  };
  xhr.send('finalizar_pedidos=1');
});

// --- NOTIFICAR AL CAMARERO ---
document.querySelector('.sidebar-right .submit-btn[style*="background-color:#f1c40f"]').addEventListener('click', function() {
  var mesa = document.querySelector('h2').textContent;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        if (res.notificacion_enviada) {
          alert('Notificación enviada al camarero.');
        } else {
          alert('No se pudo enviar la notificación.');
        }
      } catch(e) {
        alert('Notificación enviada al camarero.');
      }
    } else {
      alert('Error de conexión.');
    }
  };
  xhr.send('notificar_camarero=1&mesa=' + encodeURIComponent(mesa));
});

// --- NUEVO: Enviar nota al camarero ---
document.getElementById('btn-enviar-nota').addEventListener('click', function() {
  var nota = document.getElementById('nota-camarero').value.trim();
  var msg = document.getElementById('nota-msg');
  if (!nota) {
    msg.textContent = 'Por favor, escriba una nota antes de enviar.';
    msg.style.color = '#e74c3c';
    return;
  }
  this.disabled = true;
  msg.textContent = 'Enviando...';
  msg.style.color = '#333';
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    document.getElementById('btn-enviar-nota').disabled = false;
    try {
      var res = JSON.parse(xhr.responseText);
      if (res.nota_enviada) {
        msg.textContent = 'Nota enviada al camarero.';
        msg.style.color = '#27ae60';
        document.getElementById('nota-camarero').value = '';
      } else {
        msg.textContent = 'No se pudo enviar la nota.';
        msg.style.color = '#e74c3c';
      }
    } catch(e) {
      msg.textContent = 'Nota enviada al camarero.';
      msg.style.color = '#27ae60';
      document.getElementById('nota-camarero').value = '';
    }
  };
  xhr.onerror = function() {
    document.getElementById('btn-enviar-nota').disabled = false;
    msg.textContent = 'Error de conexión.';
    msg.style.color = '#e74c3c';
  };
  xhr.send('enviar_nota_camarero=1&nota=' + encodeURIComponent(nota));
});
