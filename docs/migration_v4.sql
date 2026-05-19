-- Migración Fase 4: Renombrar codigo_ a SKU_ y eliminar nombre virtual
USE shoponline;

-- CLIENTES
ALTER TABLE clientes DROP COLUMN nombre;
ALTER TABLE clientes CHANGE COLUMN codigo_cliente SKU_cliente VARCHAR(10) GENERATED ALWAYS AS (CONCAT('CLI-', LPAD(id_cliente, 4, '0'))) VIRTUAL;

-- EMPLEADOS
ALTER TABLE empleados DROP COLUMN nombre;
ALTER TABLE empleados CHANGE COLUMN codigo_empleado SKU_empleado VARCHAR(10) GENERATED ALWAYS AS (CONCAT('EMP-', LPAD(id_empleado, 4, '0'))) VIRTUAL;

-- PRODUCTOS
ALTER TABLE productos CHANGE COLUMN codigo_producto SKU_producto VARCHAR(10) GENERATED ALWAYS AS (CONCAT('PRD-', LPAD(id_producto, 4, '0'))) VIRTUAL;

-- PEDIDOS
ALTER TABLE pedidos CHANGE COLUMN codigo_pedido SKU_pedido VARCHAR(10) GENERATED ALWAYS AS (CONCAT('ORD-', LPAD(id_pedido, 4, '0'))) VIRTUAL;

-- PAGOS
ALTER TABLE pagos CHANGE COLUMN codigo_pago SKU_pago VARCHAR(10) GENERATED ALWAYS AS (CONCAT('PAG-', LPAD(id_pago, 4, '0'))) VIRTUAL;

-- ENVIOS
ALTER TABLE envios CHANGE COLUMN codigo_envio SKU_envio VARCHAR(10) GENERATED ALWAYS AS (CONCAT('ENV-', LPAD(id_envio, 4, '0'))) VIRTUAL;
