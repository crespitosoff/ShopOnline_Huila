// ======================================
// ShopOnline Huila - Frontend Validation
// ======================================

document.addEventListener('DOMContentLoaded', () => {
    initializeClienteForm();
    initializeEmpleadoForm();
});

// ======================================
// CLIENTES
// ======================================

function initializeClienteForm() {
    const form = document.getElementById('clienteForm');
    if (!form) return;

    form.addEventListener('submit', (event) => {
        clearErrors();
        let isValid = true;

        const nombre = form.nombre;
        const email = form.email;

        if (nombre.value.trim() === '') {
            showError(nombre, 'El nombre es obligatorio');
            isValid = false;
        }

        if (email.value.trim() === '') {
            showError(email, 'El correo es obligatorio');
            isValid = false;
        } else if (!validateEmail(email.value)) {
            showError(email, 'Ingrese un correo válido');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
}

// ======================================
// EMPLEADOS
// ======================================

function initializeEmpleadoForm() {
    const form = document.getElementById('empleadoForm');
    if (!form) return;

    form.addEventListener('submit', (event) => {
        clearErrors();
        let isValid = true;

        const nombre = form.nombre;
        const salario = form.salario;
        const fecha = form.fecha_ingreso;
        const cargo = form.id_cargo;

        if (nombre.value.trim() === '') {
            showError(nombre, 'El nombre es obligatorio');
            isValid = false;
        }

        if (cargo.value === '') {
            showError(cargo, 'Seleccione un cargo');
            isValid = false;
        }

        if (salario.value === '') {
            showError(salario, 'El salario es obligatorio');
            isValid = false;
        } else if (isNaN(salario.value) || Number(salario.value) <= 0) {
            showError(salario, 'Ingrese un salario válido');
            isValid = false;
        }

        if (fecha.value === '') {
            showError(fecha, 'La fecha es obligatoria');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
}

// ======================================
// UTILITIES
// ======================================

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showError(input, message) {
    input.classList.add('input-error');
    const error = document.createElement('small');
    error.className = 'error-message';
    error.innerText = message;
    input.parentElement.appendChild(error);
}

function clearErrors() {
    document.querySelectorAll('.error-message').forEach(error => error.remove());
    document.querySelectorAll('.input-error').forEach(input => {
        input.classList.remove('input-error');
    });
}