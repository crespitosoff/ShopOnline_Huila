-- Migración Fase 2: Columnas generadas (VIRTUAL) para IDs
USE shoponline;

-- pedidos
ALTER TABLE pedidos ADD COLUMN codigo_pedido VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('ORD-', LPAD(id_pedido, 4, '0'))) VIRTUAL;

-- clientes
ALTER TABLE clientes ADD COLUMN codigo_cliente VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('CLI-', LPAD(id_cliente, 4, '0'))) VIRTUAL;

-- empleados
ALTER TABLE empleados ADD COLUMN codigo_empleado VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('EMP-', LPAD(id_empleado, 4, '0'))) VIRTUAL;

-- productos
ALTER TABLE productos ADD COLUMN codigo_producto VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('PRD-', LPAD(id_producto, 4, '0'))) VIRTUAL;

-- envios
ALTER TABLE envios ADD COLUMN codigo_envio VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('ENV-', LPAD(id_envio, 4, '0'))) VIRTUAL;

-- pagos
ALTER TABLE pagos ADD COLUMN codigo_pago VARCHAR(10) 
  GENERATED ALWAYS AS (CONCAT('PAG-', LPAD(id_pago, 4, '0'))) VIRTUAL;
