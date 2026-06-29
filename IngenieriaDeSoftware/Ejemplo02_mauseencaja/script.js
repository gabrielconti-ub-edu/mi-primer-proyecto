// Arreglo con 8 colores llamativos en formato HEX
const colores = [
    '#E74C3C', // Rojo
    '#3498DB', // Azul
    '#2ECC71', // Verde
    '#F1C40F', // Amarillo
    '#9B59B6', // Morado
    '#E67E22', // Naranja
    '#1ABC9C', // Turquesa
    '#34495E'  // Gris Oscuro
];

// Seleccionamos todas las divisiones con la clase 'caja'
const cajas = document.querySelectorAll('.caja');

// Asignamos el color de fondo y el popup de forma dinámica
cajas.forEach((caja, indice) => {
    const colorAsignado = colores[indice];
    
    // 1. Aplicamos el color de fondo mediante CSS en línea
    caja.style.backgroundColor = colorAsignado;
    
    // 2. Agregamos el atributo title para el popup nativo del navegador
    caja.setAttribute('title', `El color de fondo es: ${colorAsignado}`);
});
