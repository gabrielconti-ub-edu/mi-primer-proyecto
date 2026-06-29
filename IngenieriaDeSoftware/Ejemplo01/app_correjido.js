// ================== Datos en memoria ==================
let clientes = [];
let nextId = 1;

// ================== Referencias DOM ==================
const tablaClientes = document.querySelector("#tablaClientes tbody");
const form = document.getElementById("clienteForm");
const btnCancelar = document.getElementById("btnCancelar");
const inputId = document.getElementById("cliente_id");
const btnSubmit = form.querySelector("button[type='submit']");

// ================== API REST Fake ==================

// GET
function apiGetClientes() {
  return Promise.resolve(clientes);
}

// POST
function apiCrearCliente(cliente) {
  cliente.CLIENTE_ID = nextId++;
  clientes.push(cliente);
  return Promise.resolve(cliente);
}

// PUT
function apiActualizarCliente(id, cliente) {
  const index = clientes.findIndex(c => c.CLIENTE_ID === id);
  if (index >= 0) {
    clientes[index] = { CLIENTE_ID: id, ...cliente };
    return Promise.resolve(clientes[index]);
  }
  return Promise.reject("Cliente no encontrado");
}

// DELETE
function apiEliminarCliente(id) {
  clientes = clientes.filter(c => c.CLIENTE_ID !== id);
  return Promise.resolve();
}

// ================== UI ==================

// Render tabla
function renderClientes() {
  apiGetClientes().then(data => {
    tablaClientes.innerHTML = "";
    data.forEach(cliente => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${cliente.CLIENTE_ID}</td>
        <td>${cliente.NOMBRE_CLI}</td>
        <td>${cliente.DOMICILIO}</td>
        <td>${cliente.MAIL}</td>
        <td>${cliente.TELEFONO}</td>
        <td>
          <button onclick="editarCliente(${cliente.CLIENTE_ID})">Editar</button>
          <button onclick="eliminarCliente(${cliente.CLIENTE_ID})">Eliminar</button>
        </td>
      `;
      tablaClientes.appendChild(row);
    });
  });
}

// Limpiar formulario + modo crear
function limpiarFormulario() {
  form.reset();
  inputId.value = "";
  btnSubmit.textContent = "Agregar cliente";
}

// Submit (crear / editar)
form.addEventListener("submit", function (e) {
  e.preventDefault();

  const id = parseInt(inputId.value);

  const cliente = {
    NOMBRE_CLI: document.getElementById("nombre_cli").value,
    DOMICILIO: document.getElementById("domicilio").value,
    MAIL: document.getElementById("mail").value,
    TELEFONO: document.getElementById("telefono").value,
  };

  // Validación básica
  if (!cliente.NOMBRE_CLI.trim()) {
    alert("El nombre es obligatorio");
    return;
  }

  if (!isNaN(id) && id > 0) {
    // EDITAR
    apiActualizarCliente(id, cliente)
      .then(() => {
        renderClientes();
        limpiarFormulario();
      })
      .catch(err => alert(err));
  } else {
    // CREAR
    apiCrearCliente(cliente).then(() => {
      renderClientes();
      limpiarFormulario();
    });
  }
});

// Botón cancelar
btnCancelar.addEventListener("click", limpiarFormulario);

// Editar cliente
function editarCliente(id) {
  const cliente = clientes.find(c => c.CLIENTE_ID === id);
  if (!cliente) return;

  inputId.value = cliente.CLIENTE_ID;
  document.getElementById("nombre_cli").value = cliente.NOMBRE_CLI;
  document.getElementById("domicilio").value = cliente.DOMICILIO;
  document.getElementById("mail").value = cliente.MAIL;
  document.getElementById("telefono").value = cliente.TELEFONO;

  btnSubmit.textContent = "Guardar cambios";
}

// Eliminar cliente
function eliminarCliente(id) {
  if (confirm("¿Seguro que quieres eliminar este cliente?")) {
    apiEliminarCliente(id).then(() => {
      renderClientes();
      limpiarFormulario(); // <- evita quedar en modo edición
    });
  }
}

// Inicialización
renderClientes();