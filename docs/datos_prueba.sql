-- ============================================
-- SCRIPT DE DEMOSTRACIÓN - FASE 7 (PULIDO)
-- ============================================
-- Nota: Ejecutar sobre shoponline existente.
-- Inserta datos semilla si no existen para hacer pruebas.
USE shoponline;

-- 1. CARGOS Y EMPLEADOS (5 empleados)
INSERT IGNORE INTO cargos (id_cargo, nombre) VALUES 
(1, 'Administrador'), (2, 'Vendedor'), (3, 'Logística'), (4, 'Soporte'), (5, 'Contador');

INSERT IGNORE INTO empleados (id_empleado, primer_nombre, primer_apellido, email, id_cargo, password, salario, fecha_ingreso, activo) VALUES
(1, 'Carlos', 'Huertas', 'carlos.h@shop.com', 1, '12345678', 1000000, '2023-10-26', 1),
(2, 'Maria', 'Lopez', 'maria.l@shop.com', 2, '12345678', 2000000, '2023-10-26', 1),
(3, 'Fernando', 'Moto', 'fer.m@shop.com', 3, '12345678', 3000000, '2023-10-26', 1),
(4, 'Camila', 'Rivas', 'cami.r@shop.com', 3, '12345678', 4000000, '2023-10-26', 1),
(5, 'Jorge', 'Perez', 'jorge.p@shop.com', 4, '12345678', 5000000, '2023-10-26', 1);

-- 2. CLIENTES (5 clientes)
INSERT IGNORE INTO clientes (id_cliente, primer_nombre, primer_apellido, email, telefono, activo, fecha_registro) VALUES
(1, 'Ana', 'Rodriguez', 'ana.r@mail.com', '3201112233', 1, '2023-10-26'),
(2, 'Luis', 'Gomez', 'luis.g@mail.com', '3202223344', 1, '2023-10-26'),
(3, 'Sofía', 'Castro', 'sofia.c@mail.com', '3203334455', 1, '2023-10-26'),
(4, 'Miguel', 'Diaz', 'miguel.d@mail.com', '3204445566', 1, '2023-10-26'),
(5, 'Laura', 'Muñoz', 'laura.m@mail.com', '3205556677', 1, '2023-10-26');

-- 3. CATEGORÍAS (5 categorías)
INSERT IGNORE INTO categorias (id_categoria, nombre) VALUES
(1, 'Cafés Especiales'), (2, 'Cacaos y Chocolates'), (3, 'Artesanías'), (4, 'Snacks Tradicionales'), (5, 'Bebidas Naturales');

-- 4. PRODUCTOS (15 productos)
INSERT IGNORE INTO productos (id_producto, nombre, descripcion, precio, stock, id_categoria, imagen, activo) VALUES
(1, 'Café Huila Origen 500g', 'Café especial tostado medio', 25000, 50, 1, 'img/cafe.jpg', 1),
(2, 'Café Garzón Premium 250g', 'Café especial tostado oscuro', 15000, 30, 1, 'img/cafe.jpg', 1),
(3, 'Café Pitalito Suave 500g', 'Café con notas cítricas', 24000, 40, 1, 'img/cafe.jpg', 1),
(4, 'Chocolate 70% Cacao 100g', 'Chocolate amargo artesanal', 12000, 100, 2, 'img/chocolate.jpg', 1),
(5, 'Cacao en polvo 250g', '100% puro para repostería', 18000, 15, 2, 'img/cacao.jpg', 1), -- Stock bajo
(6, 'Bombones rellenos caja 12', 'Rellenos de maracuyá y café', 22000, 25, 2, 'img/bombones.jpg', 1),
(7, 'Sombrero Suaza Tradicional', 'Hecho a mano', 85000, 5, 3, 'img/sombrero.jpg', 1), -- Stock bajo
(8, 'Mochila de Fique', 'Colores variados', 45000, 12, 3, 'img/mochila.jpg', 1),
(9, 'Chiva de Barro Pequeña', 'Artesanía de Pitalito', 25000, 45, 3, 'img/chiva.jpg', 1),
(10, 'Achiras Tradicionales 500g', 'Bizcocho de achira', 16000, 200, 4, 'img/achiras.jpg', 1),
(11, 'Achiras Picantes 250g', 'Con toque de ají', 9000, 80, 4, 'img/achiras.jpg', 1),
(12, 'Panela Cuadrada 1kg', 'Orgánica campesina', 6000, 150, 4, 'img/panela.jpg', 1),
(13, 'Jugo de Cholupa 1L', 'Bebida exótica del Huila', 14000, 35, 5, 'img/cholupa.jpg', 1),
(14, 'Vino de Naranja Artesanal', 'Fermentado natural', 35000, 20, 5, 'img/vino.jpg', 1),
(15, 'Miel de Abejas Macizo 500g', 'Miel pura de flora silvestre', 18000, 60, 5, 'img/miel.jpg', 1);

-- 5. PEDIDOS (10 pedidos simulados)
-- Se asume que el Trigger restará los stocks al insertar el detalle.

-- Pedido 1: Pagado y Enviado
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (1, 1, 'Calle 10 # 5-42', 75000, 3);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (1, 1, 3, 25000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (1, 1, 75000, 1);
INSERT IGNORE INTO envios (id_envio, id_pedido, id_empleado, guia_rastreo, id_estado) VALUES (1, 1, 3, 'TRK-AA1122', 2);

-- Pedido 2: Pendiente de Pago
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (2, 2, 'Cra 7 # 14-22', 45000, 1);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (2, 8, 1, 45000);

-- Pedido 3: Pagado y en Empaque
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (3, 3, 'Avenida 2 # 80', 32000, 2);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (3, 10, 2, 16000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (2, 3, 32000, 2);
INSERT IGNORE INTO envios (id_envio, id_pedido, id_empleado, id_estado) VALUES (2, 3, 4, 1);

-- Pedido 4: Pagado y Entregado (Histórico)
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (4, 4, 'Barrio Quirinal Mz C', 85000, 3);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (4, 7, 1, 85000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (3, 4, 85000, 3);
INSERT IGNORE INTO envios (id_envio, id_pedido, id_empleado, guia_rastreo, id_estado, fecha_entrega) VALUES (3, 4, 3, 'TRK-BB3344', 3, '2023-10-20 14:30:00');

-- Pedido 5: Pendiente
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (5, 5, 'Calle Principal Pitalito', 28000, 1);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (5, 13, 2, 14000);

-- Pedido 6: Pagado y Entregado
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (6, 1, 'Calle 10 # 5-42', 36000, 3);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (6, 5, 2, 18000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (4, 6, 36000, 1);
INSERT IGNORE INTO envios (id_envio, id_pedido, id_empleado, guia_rastreo, id_estado, fecha_entrega) VALUES (4, 6, 4, 'TRK-CC5566', 3, '2023-10-22 10:15:00');

-- Pedido 7 a 10... 
INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (7, 2, 'Cra 7 # 14-22', 12000, 1);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (7, 4, 1, 12000);

INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (8, 3, 'Avenida 2 # 80', 25000, 1);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (8, 9, 1, 25000);

INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (9, 4, 'Barrio Quirinal Mz C', 35000, 2);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (9, 14, 1, 35000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (5, 9, 35000, 3);

INSERT IGNORE INTO pedidos (id_pedido, id_cliente, direccion_envio, total, id_estado) VALUES (10, 5, 'Calle Principal Pitalito', 18000, 3);
INSERT IGNORE INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario) VALUES (10, 15, 1, 18000);
INSERT IGNORE INTO pagos (id_pago, id_pedido, monto, id_metodo) VALUES (6, 10, 18000, 2);
INSERT IGNORE INTO envios (id_envio, id_pedido, id_empleado, guia_rastreo, id_estado, fecha_entrega) VALUES (5, 10, 3, 'TRK-DD7788', 3, '2023-10-24 16:45:00');
