class FormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.errors = {};
        this.init();
    }
    init() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        this.form.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('blur', (e) => this.validateField(e.target));
            input.addEventListener('input', (e) => this.clearError(e.target));
        });
    }
    validateField(field) {
        const fieldName = field.name;
        let isValid = true;
        switch(fieldName) {
            case 'nombre': case 'apellido': case 'cargo':
                isValid = this.validateRequired(field.value) && field.value.trim().length >= 2;
                break;
            case 'cedula': case 'telefono':
                isValid = this.validateRequired(field.value) && /^\d+$/.test(field.value) && field.value.length >= 5;
                break;
            case 'salario':
                isValid = this.validateRequired(field.value) && /^\d+$/.test(field.value) && parseFloat(field.value) > 0;
                break;
            case 'fecha_ingreso':
                isValid = this.validateRequired(field.value) && new Date(field.value) <= new Date();
                break;
            default:
                isValid = this.validateRequired(field.value);
        }
        if (!isValid) this.setError(field, `${fieldName} inválido`);
        return isValid;
    }
    validateRequired(value) { return value.trim() !== ''; }
    setError(field, message) {
        this.clearError(field);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-error';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
        field.style.borderColor = '#dc3545';
    }
    clearError(field) {
        const error = field.parentNode.querySelector('.alert-error');
        if (error) error.remove();
        field.style.borderColor = '#e1e5e9';
    }
    handleSubmit(e) {
        e.preventDefault();
        let isValid = true;
        this.form.querySelectorAll('[required]').forEach(field => {
            if (!this.validateField(field)) isValid = false;
        });
        if (isValid) {
            alert('✅ ¡Validado! Listo para backend');
        }
    }
}
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('clienteForm')) new FormValidator('clienteForm');
    if (document.getElementById('empleadoForm')) new FormValidator('empleadoForm');
});