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
