-- ============================================
-- DATOS SEMILLA ADICIONALES (Pruebas iniciales)
-- ============================================

USE shoponline;

-- Insertar cargos base si no existen
INSERT IGNORE INTO cargos (id_cargo, nombre) VALUES 
(1, 'Gerente de Almacén'),
(2, 'Coordinador de Logística'),
(3, 'Conductor de Entregas'),
(4, 'Especialista de Inventario');

-- Insertar categorías base si no existen
INSERT IGNORE INTO categorias (id_categoria, nombre) VALUES 
(1, 'Café Premium'),
(2, 'Productos de Cacao'),
(3, 'Artesanías'),
(4, 'Miel Local');

-- Insertar empleados de prueba (la contraseña es '12345' para todos, usar hash de prueba en prod)
INSERT IGNORE INTO empleados (id_empleado, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, email, password, id_cargo, salario, fecha_ingreso) VALUES 
(1, 'Carlos', 'Eduardo', 'Perez', 'Gomez', 'carlos.perez@shoponline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 3500000.00, '2023-01-15'),
(2, 'Maria', 'Fernanda', 'Lopez', 'Diaz', 'maria.lopez@shoponline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 2800000.00, '2023-03-10'),
(3, 'Juan', NULL, 'Ramirez', NULL, 'juan.ramirez@shoponline.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 1800000.00, '2023-06-01');

-- Insertar clientes de prueba
INSERT IGNORE INTO clientes (id_cliente, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, email, password, telefono) VALUES 
(1, 'Ana', 'Maria', 'Guzman', 'Velez', 'ana.guzman@cliente.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3001234567'),
(2, 'Luis', NULL, 'Martinez', 'Soto', 'luis.martinez@cliente.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3109876543');

-- Insertar productos de prueba
INSERT IGNORE INTO productos (id_producto, id_categoria, nombre, precio, stock, descripcion) VALUES 
(1, 1, 'Café Huilense Especial 500g', 35000.00, 50, 'Café de origen 100% arábica de las montañas del Huila.'),
(2, 2, 'Chocolate Amargo 70%', 12000.00, 100, 'Barra de chocolate amargo artesanal.'),
(3, 4, 'Miel Pura de Abeja 250ml', 15000.00, 30, 'Miel recolectada de la zona sur del Huila.');
