// ----- AJUSTA AQUÍ la URL base de tu API -----
// Debe apuntar al archivo index.php de la API que atiende GET/POST/PUT/DELETE
const apiBaseUrl = "http://localhost/IngenieriaDeSoftwareIFTS18/Ej13_API-REST_BackEnd_PHPconMySQL/index.php/clientes"; // <-- ajustar

document.addEventListener("DOMContentLoaded", () => {
  cargarClientes();

  document.getElementById("clienteForm").addEventListener("submit", guardarCliente);
  document.getElementById("cancelarBtn").addEventListener("click", limpiarFormulario);
});

// ----------------- CARGAR CLIENTES -----------------
function cargarClientes() {
  mostrarMensaje("Cargando clientes...", "info");
  fetch(apiBaseUrl, { method: "GET", headers: { "Accept": "application/json" } })
    .then(checkStatus)
    .then(r => r.json())
    .then(data => {
      llenarTabla(Array.isArray(data) ? data : []);
      mostrarMensaje("", "clear");
    })
    .catch(err => {
      console.error("Error al cargar clientes:", err);
      mostrarMensaje("Error al cargar clientes. Revisa consola.", "error");
    });
}

function llenarTabla(data) {
  const tabla = document.getElementById("clientesTable");
  tabla.innerHTML = "";

  if (!data || data.length === 0) {
    tabla.innerHTML = `<tr><td colspan="6" style="text-align:center;">No hay clientes</td></tr>`;
    return;
  }

  data.forEach(cli => {
    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td>${cli.CLIENTE_ID ?? ""}</td>
      <td>${escapeHtml(cli.NOMBRE_CLI ?? "")}</td>
      <td>${escapeHtml(cli.DOMICILIO ?? "")}</td>
      <td>${escapeHtml(cli.MAIL ?? "")}</td>
      <td>${escapeHtml(cli.TELEFONO ?? "")}</td>
      <td>
        <button class="action-btn action-edit" data-id="${cli.CLIENTE_ID}">Editar</button>
        <button class="action-btn action-delete" data-id="${cli.CLIENTE_ID}">Eliminar</button>
      </td>
    `;
    tabla.appendChild(fila);
  });

  // Delegación de eventos para botones (más eficiente)
  tabla.querySelectorAll(".action-edit").forEach(btn => {
    btn.addEventListener("click", () => editarCliente(btn.dataset.id));
  });
  tabla.querySelectorAll(".action-delete").forEach(btn => {
    btn.addEventListener("click", () => eliminarCliente(btn.dataset.id));
  });
}

// ----------------- GUARDAR (POST / PUT) -----------------
function guardarCliente(e) {
  e.preventDefault();

  const id = document.getElementById("CLIENTE_ID").value;
  const payload = {
    nombre: document.getElementById("NOMBRE_CLI").value.trim(),
    domicilio: document.getElementById("DOMICILIO").value.trim(),
    mail: document.getElementById("MAIL").value.trim(),
    telefono: document.getElementById("TELEFONO").value.trim()
  };

  if (!payload.nombre || !payload.mail) {
    mostrarMensaje("Nombre y Email son obligatorios.", "error");
    return;
  }

  const url = id ? `${apiBaseUrl}/${encodeURIComponent(id)}` : apiBaseUrl;
  const method = id ? "PUT" : "POST";

  fetch(url, {
    method,
    headers: { "Content-Type": "application/json", "Accept": "application/json" },
    body: JSON.stringify(payload)
  })
    .then(checkStatus)
    .then(r => r.json())
    .then(res => {
      mostrarMensaje(res.mensaje || "Operación exitosa", "success");
      limpiarFormulario();
      cargarClientes();
    })
    .catch(err => {
      console.error("Error al guardar cliente:", err);
      mostrarMensaje("Error al guardar cliente. Revisa consola.", "error");
    });
}

// ----------------- EDITAR (GET con id) -----------------
function editarCliente(id) {
  if (!id) return;
  mostrarMensaje("Cargando cliente...", "info");

  fetch(`${apiBaseUrl}/${encodeURIComponent(id)}`, {
    method: "GET",
    headers: { "Accept": "application/json" }
  })
    .then(checkStatus)
    .then(r => r.json())
    .then(cli => {
      if (!cli || Object.keys(cli).length === 0) {
        mostrarMensaje("Cliente no encontrado", "error");
        return;
      }
      document.getElementById("CLIENTE_ID").value = cli.CLIENTE_ID ?? "";
      document.getElementById("NOMBRE_CLI").value = cli.NOMBRE_CLI ?? "";
      document.getElementById("DOMICILIO").value = cli.DOMICILIO ?? "";
      document.getElementById("MAIL").value = cli.MAIL ?? "";
      document.getElementById("TELEFONO").value = cli.TELEFONO ?? "";
      document.getElementById("guardarBtn").textContent = "Actualizar";
      mostrarMensaje("", "clear");
    })
    .catch(err => {
      console.error("Error al obtener cliente:", err);
      mostrarMensaje("Error al obtener cliente. Revisa consola.", "error");
    });
}

// ----------------- ELIMINAR -----------------
function eliminarCliente(id) {
  if (!id) return;
  if (!confirm("¿Deseas eliminar este cliente?")) return;

  fetch(`${apiBaseUrl}/${encodeURIComponent(id)}`, {
    method: "DELETE",
    headers: { "Accept": "application/json" }
  })
    .then(checkStatus)
    .then(r => r.json())
    .then(res => {
      mostrarMensaje(res.mensaje || "Cliente eliminado", "success");
      cargarClientes();
    })
    .catch(err => {
      console.error("Error al eliminar cliente:", err);
      mostrarMensaje("Error al eliminar cliente. Revisa consola.", "error");
    });
}

// ----------------- UTILIDADES -----------------
function limpiarFormulario() {
  document.getElementById("clienteForm").reset();
  document.getElementById("CLIENTE_ID").value = "";
  document.getElementById("guardarBtn").textContent = "Guardar";
  mostrarMensaje("", "clear");
}

function mostrarMensaje(texto, tipo) {
  const el = document.getElementById("mensaje");
  if (!el) return;
  if (tipo === "clear") { el.textContent = ""; el.style.color = ""; return; }
  el.textContent = texto;
  if (tipo === "error") el.style.color = "#b33939";
  else if (tipo === "success") el.style.color = "#28a745";
  else el.style.color = "#333";
}

// Chequear status HTTP y lanzar error si no está ok
function checkStatus(response) {
  if (response.ok) return response;
  return response.text().then(text => {
    let msg = text;
    try { msg = JSON.parse(text); } catch (e) {}
    const error = new Error("HTTP " + response.status + " - " + (msg.error || msg.mensaje || response.statusText));
    error.response = response;
    throw error;
  });
}

// Escapar HTML simple para evitar inyección en tabla
function escapeHtml(str) {
  return String(str)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}
