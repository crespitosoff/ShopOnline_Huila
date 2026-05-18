-- ============================================
-- BASE DE DATOS: ShopOnline Huila
-- Script completo para inicialización
-- ============================================

-- (Opcional) Crear base de datos
CREATE DATABASE IF NOT EXISTS shoponline;
USE shoponline;

-- ============================================
-- TABLAS DE CATÁLOGO
-- Estas deben crearse primero (referenciadas por otras tablas)
-- ============================================

CREATE TABLE estado_pedido (
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL UNIQUE,
    descripcion TEXT
) ENGINE=InnoDB;

CREATE TABLE estado_envio (
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE metodo_pago (
    id_metodo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    activo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB;

-- ============================================
-- TABLAS PRINCIPALES
-- ============================================

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    activo BOOLEAN DEFAULT TRUE,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE cargos (
    id_cargo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_cargo INT NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    fecha_ingreso DATE NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    
    INDEX idx_emp_cargo (id_cargo),

    CONSTRAINT fk_emp_cargo 
        FOREIGN KEY (id_cargo) 
        REFERENCES cargos(id_cargo)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.0 CHECK (precio >= 0),
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),
    descripcion TEXT,
    imagen VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    
    INDEX idx_prod_categoria (id_categoria),
    
    CONSTRAINT fk_prod_cat 
        FOREIGN KEY (id_categoria) 
        REFERENCES categorias(id_categoria)
) ENGINE=InnoDB;

-- ============================================
-- PEDIDOS (núcleo del sistema)
-- ============================================

CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    direccion_envio TEXT NOT NULL,
    
    -- Denormalización controlada:
    -- Se almacena para mantener histórico y mejorar rendimiento
    total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    
    id_estado INT NOT NULL DEFAULT 1,
    
    INDEX idx_ped_cliente (id_cliente),
    INDEX idx_ped_estado (id_estado),

    CONSTRAINT fk_ped_cli 
        FOREIGN KEY (id_cliente) 
        REFERENCES clientes(id_cliente)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_ped_est 
        FOREIGN KEY (id_estado) 
        REFERENCES estado_pedido(id_estado)
) ENGINE=InnoDB;

-- ============================================
-- PAGOS (1:1 con pedidos)
-- ============================================

CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL UNIQUE,
    monto DECIMAL(10,2) NOT NULL CHECK (monto > 0),
    fecha_pago DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_metodo INT NOT NULL,
    
    INDEX idx_pago_pedido (id_pedido),
    INDEX idx_pago_metodo (id_metodo),

    CONSTRAINT fk_pago_ped 
        FOREIGN KEY (id_pedido) 
        REFERENCES pedidos(id_pedido),

    CONSTRAINT fk_pago_met 
        FOREIGN KEY (id_metodo) 
        REFERENCES metodo_pago(id_metodo)
) ENGINE=InnoDB;

-- ============================================
-- DETALLE DE PEDIDOS (tabla intermedia)
-- Relación muchos a muchos entre pedidos y productos
-- ============================================

CREATE TABLE detalle_pedidos (
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    
    -- PK compuesta evita duplicados
    PRIMARY KEY (id_pedido, id_producto),
    
    cantidad INT NOT NULL,
    
    -- Guarda el precio histórico del producto
    precio_unitario DECIMAL(10,2) NOT NULL,
    
    INDEX idx_det_producto (id_producto),
    
    CONSTRAINT fk_det_ped 
        FOREIGN KEY (id_pedido) 
        REFERENCES pedidos(id_pedido),

    CONSTRAINT fk_det_prod 
        FOREIGN KEY (id_producto) 
        REFERENCES productos(id_producto)
) ENGINE=InnoDB;

-- ============================================
-- ENVÍOS
-- Un pedido tiene un envío
-- Un empleado gestiona el envío
-- ============================================

CREATE TABLE envios (
    id_envio INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL UNIQUE,
    id_empleado INT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_entrega DATETIME,
    guia_rastreo VARCHAR(100),
    id_estado INT NOT NULL DEFAULT 1,
    
    INDEX idx_env_pedido (id_pedido),
    INDEX idx_env_empleado (id_empleado),
    INDEX idx_env_estado (id_estado),

    CONSTRAINT fk_env_ped 
        FOREIGN KEY (id_pedido) 
        REFERENCES pedidos(id_pedido),

    CONSTRAINT fk_env_emp 
        FOREIGN KEY (id_empleado) 
        REFERENCES empleados(id_empleado),

    CONSTRAINT fk_env_est 
        FOREIGN KEY (id_estado) 
        REFERENCES estado_envio(id_estado)
) ENGINE=InnoDB;

-- ============================================
-- TRIGGERS PARA INVENTARIO
-- ============================================

DELIMITER //

CREATE TRIGGER after_detalle_pedido_insert
AFTER INSERT ON detalle_pedidos
FOR EACH ROW
BEGIN
    UPDATE productos 
    SET stock = stock - NEW.cantidad 
    WHERE id_producto = NEW.id_producto;
END//

DELIMITER ;

-- ============================================
-- DATOS INICIALES (recomendado para pruebas)
-- ============================================

INSERT INTO estado_pedido (nombre) VALUES 
('Pendiente'), ('Pagado'), ('Enviado'), ('Cancelado');

INSERT INTO estado_envio (nombre) VALUES 
('En preparación'), ('En camino'), ('Entregado');

INSERT INTO metodo_pago (nombre) VALUES 
('Efectivo'), ('Tarjeta'), ('Transferencia');