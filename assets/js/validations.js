// ======================================
// ShopOnline Huila - Frontend Validation
// ======================================

document.addEventListener('DOMContentLoaded', () => {

    initializeDeleteButtons();

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

        event.preventDefault();

        clearErrors();

        let isValid = true;

        const nombre = form.nombre;

        const email = form.email;

        // Nombre
        if (nombre.value.trim() === '') {

            showError(nombre, 'El nombre es obligatorio');

            isValid = false;
        }

        // Email
        if (email.value.trim() === '') {

            showError(email, 'El correo es obligatorio');

            isValid = false;

        } else if (!validateEmail(email.value)) {

            showError(email, 'Ingrese un correo válido');

            isValid = false;
        }

        if (!isValid) return;

        const submitButton = form.querySelector('button[type="submit"]');

        submitButton.disabled = true;

        submitButton.innerText = 'Guardando...';

        setTimeout(() => {

            showNotification(
                'Cliente guardado correctamente',
                'success'
            );

            submitButton.disabled = false;

            submitButton.innerText = 'Guardar Cliente';

            form.reset();

        }, 1000);

    });

}

// ======================================
// EMPLEADOS
// ======================================

function initializeEmpleadoForm() {

    const form = document.getElementById('empleadoForm');

    if (!form) return;

    form.addEventListener('submit', (event) => {

        event.preventDefault();

        clearErrors();

        let isValid = true;

        const nombre = form.nombre;

        const salario = form.salario;

        const fecha = form.fecha_ingreso;

        const cargo = form.id_cargo;

        // Nombre
        if (nombre.value.trim() === '') {

            showError(nombre, 'El nombre es obligatorio');

            isValid = false;
        }

        // Cargo
        if (cargo.value === '') {

            showError(cargo, 'Seleccione un cargo');

            isValid = false;
        }

        // Salario
        if (salario.value === '') {

            showError(salario, 'El salario es obligatorio');

            isValid = false;

        } else if (
            isNaN(salario.value) ||
            Number(salario.value) <= 0
        ) {

            showError(
                salario,
                'Ingrese un salario válido'
            );

            isValid = false;
        }

        // Fecha
        if (fecha.value === '') {

            showError(
                fecha,
                'La fecha es obligatoria'
            );

            isValid = false;
        }

        if (!isValid) return;

        const submitButton = form.querySelector('button[type="submit"]');

        submitButton.disabled = true;

        submitButton.innerText = 'Guardando...';

        setTimeout(() => {

            showNotification(
                'Empleado guardado correctamente',
                'success'
            );

            submitButton.disabled = false;

            submitButton.innerText = 'Guardar Empleado';

            form.reset();

        }, 1000);

    });

}

// ======================================
// DELETE BUTTONS
// ======================================

function initializeDeleteButtons() {

    const deleteButtons = document.querySelectorAll('.btn-danger');

    deleteButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const confirmDelete = confirm(
                '¿Está seguro de eliminar este registro?'
            );

            if (confirmDelete) {

                showNotification(
                    'Registro eliminado correctamente',
                    'success'
                );
            }

        });

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

    document
        .querySelectorAll('.error-message')
        .forEach(error => error.remove());

    document
        .querySelectorAll('.input-error')
        .forEach(input => {
            input.classList.remove('input-error');
        });

}

function showNotification(message, type) {

    const notification = document.createElement('div');

    notification.className = `notification ${type}`;

    notification.innerText = message;

    document.body.appendChild(notification);

    setTimeout(() => {

        notification.classList.add('show');

    }, 100);

    setTimeout(() => {

        notification.classList.remove('show');

        setTimeout(() => {

            notification.remove();

        }, 300);

    }, 3000);

}