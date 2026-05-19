-- Migración Fase 3: Atomización de Nombres
USE shoponline;

-- === CLIENTES ===
ALTER TABLE clientes
  ADD COLUMN primer_nombre VARCHAR(50) NOT NULL DEFAULT '' AFTER id_cliente,
  ADD COLUMN segundo_nombre VARCHAR(50) DEFAULT NULL AFTER primer_nombre,
  ADD COLUMN primer_apellido VARCHAR(50) NOT NULL DEFAULT '' AFTER segundo_nombre,
  ADD COLUMN segundo_apellido VARCHAR(50) DEFAULT NULL AFTER primer_apellido;

-- Migrar datos existentes (asume formato "Nombre Apellido")
UPDATE clientes SET
  primer_nombre = SUBSTRING_INDEX(nombre, ' ', 1),
  primer_apellido = SUBSTRING_INDEX(nombre, ' ', -1)
WHERE nombre IS NOT NULL AND nombre != '';

-- Columna virtual para nombre completo (retrocompatibilidad)
ALTER TABLE clientes DROP COLUMN nombre;
ALTER TABLE clientes ADD COLUMN nombre VARCHAR(200)
  GENERATED ALWAYS AS (
    TRIM(CONCAT_WS(' ', NULLIF(primer_nombre, ''), NULLIF(segundo_nombre, ''), NULLIF(primer_apellido, ''), NULLIF(segundo_apellido, '')))
  ) VIRTUAL;

-- === EMPLEADOS ===
ALTER TABLE empleados
  ADD COLUMN primer_nombre VARCHAR(50) NOT NULL DEFAULT '' AFTER id_empleado,
  ADD COLUMN segundo_nombre VARCHAR(50) DEFAULT NULL AFTER primer_nombre,
  ADD COLUMN primer_apellido VARCHAR(50) NOT NULL DEFAULT '' AFTER segundo_nombre,
  ADD COLUMN segundo_apellido VARCHAR(50) DEFAULT NULL AFTER primer_apellido;

UPDATE empleados SET
  primer_nombre = SUBSTRING_INDEX(nombre, ' ', 1),
  primer_apellido = SUBSTRING_INDEX(nombre, ' ', -1)
WHERE nombre IS NOT NULL AND nombre != '';

ALTER TABLE empleados DROP COLUMN nombre;
ALTER TABLE empleados ADD COLUMN nombre VARCHAR(200)
  GENERATED ALWAYS AS (
    TRIM(CONCAT_WS(' ', NULLIF(primer_nombre, ''), NULLIF(segundo_nombre, ''), NULLIF(primer_apellido, ''), NULLIF(segundo_apellido, '')))
  ) VIRTUAL;
