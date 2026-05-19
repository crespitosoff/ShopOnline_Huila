# ShopOnline Huila - Sistema de Gestión Comercial 🛒

**ShopOnline Huila** es un sistema integral de gestión y administración para el comercio en línea (e-commerce), diseñado para conectar artesanos y productores locales del departamento del Huila con un mercado más amplio, optimizando su cadena de suministro, control de inventarios, despachos y reportes.

Este proyecto ha sido desarrollado utilizando un patrón arquitectónico **MVC (Modelo-Vista-Controlador)** con **PHP puro** y **MySQL**, garantizando modularidad, escalabilidad y buenas prácticas de desarrollo. La interfaz de usuario utiliza **Tailwind CSS** y **Google Material Symbols** para un diseño moderno basado en el Material Design 3.

---

## 🚀 Características Principales

El sistema está dividido en módulos estratégicos para administrar la operación del negocio de extremo a extremo:

*   **👥 Gestión de Empleados y Clientes:**
    *   Directorio de personal con asignación de cargos, salarios y fechas de ingreso.
    *   Directorio de clientes para CRM básico.
    *   IDs autogenerados en BD mediante columnas virtuales (ej. `EMP-0001`, `CLI-0002`).

*   **📦 Inventario de Productos:**
    *   Administración de catálogo de productos (Café Premium, Cacao, Artesanías, etc.).
    *   Control de existencias (Stock Alto, Bajo, Agotado).
    *   Filtros dinámicos por categorías extraídas directamente de la base de datos.

*   **🛍️ Gestión de Pedidos:**
    *   Recepción y estados del pedido (`Pendiente`, `Procesando/Pagado`, `Enviado/Entregado`).
    *   Visualización de los detalles del pedido y montos (Total y cantidad de productos).

*   **🚚 Centro de Despachos (Logística):**
    *   Asignación de envíos y guías de rastreo a empleados (repartidores).
    *   Transición de estados (`En preparación` -> `En camino` -> `Entregado`).
    *   Resumen operativo con KPI's mostrando las "Entregas Activas".

*   **📊 Reportes y Analítica:**
    *   Panel de métricas ejecutivas (Ingresos Totales, Unidades Vendidas, Producto Estrella).
    *   Filtro dinámico de histórico de reportes (Hoy, Este Mes, Histórico Completo).

*   **🛠️ Herramientas de Productividad:**
    *   **Buscadores en tiempo real:** Búsqueda asíncrona mediante JavaScript en todos los módulos.
    *   **Exportación a CSV:** Generación de reportes tabulares para Excel mediante `ExportarController.php`.

---

## 🏗️ Arquitectura del Sistema (MVC)

El proyecto estructura el código de la siguiente manera:

*   **`models/` (Modelos):** Clases PHP (`Empleado.php`, `Producto.php`, `Reporte.php`, etc.) encargadas de la lógica de negocio y las consultas PDO a la base de datos MySQL.
*   **`views/` (Vistas):** Interfaz de usuario. Mezcla de HTML, PHP y Tailwind CSS. Utiliza un sistema de *layouts* (`header.php`, `topbar.php`, `footer.php`, `sidebar.php`) para no repetir código.
*   **`controllers/` (Controladores):** Scripts intermediarios (`LoginController.php`, `CrearProductoController.php`, etc.) que reciben peticiones POST/GET de las vistas, procesan datos con los modelos y redirigen al usuario con mensajes de éxito o error.
*   **`config/` (Configuración):** Configuración general y conexión por PDO a la base de datos (`conexion.php`).
*   **`assets/` (Recursos):** Archivos estáticos como JavaScript (`table-search.js`), CSS global e imágenes.
*   **`docs/` (Documentación):** Scripts SQL de la base de datos (`Script.sql`, `datos_prueba.sql`).

---

## 🗄️ Diseño de la Base de Datos

La base de datos relacional MySQL fue diseñada para garantizar la integridad referencial y atomicidad de los datos.

### Conceptos Clave Implementados:
1.  **Columnas Generadas (Virtuales):** Los campos identificadores como `SKU_empleado`, `SKU_cliente`, `SKU_producto`, etc., son generados automáticamente en el motor de la base de datos.
    *   *Ejemplo:* `GENERATED ALWAYS AS (CONCAT('EMP-', LPAD(id_empleado, 4, '0'))) VIRTUAL`
2.  **Atomicidad de Nombres:** Los nombres de las personas (empleados y clientes) se separan atómicamente (`primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`) para facilitar la clasificación. Se reconstruyen al vuelo en el software o en vistas SQL mediante `CONCAT_WS`.
3.  **Borrado Lógico:** Las entidades principales tienen una columna `activo` (TINYINT 1/0) en lugar de usar comandos `DELETE`, conservando el historial transaccional.
4.  **Zona Horaria:** Todas las tablas de tiempo y el motor configuran `America/Bogota` (`-05:00`).

---

## 💻 Stack Tecnológico

*   **Backend:** PHP 8.x (Paradigma Orientado a Objetos + MVC)
*   **Base de Datos:** MySQL / MariaDB (Driver PDO)
*   **Frontend UI:** HTML5 + Tailwind CSS (Vía CDN) + Google Fonts (Inter)
*   **Iconografía:** Google Material Symbols (Outlined)
*   **Interacciones UI:** Vanilla JavaScript (ES6)

---

## ⚙️ Instalación y Configuración (Entorno de Desarrollo)

Para desplegar este sistema localmente, sigue los siguientes pasos:

1.  **Clonar el repositorio:** Ubica la carpeta del proyecto dentro del directorio de tu servidor local (ej. `C:\xampp\htdocs\ShopOnline_Huila`).
2.  **Servidor Web y BD:** Enciende los servicios de **Apache** y **MySQL** en XAMPP.
3.  **Crear la Base de Datos:**
    *   Ve a *phpMyAdmin* (`http://localhost/phpmyadmin`).
    *   Crea una base de datos en blanco (se recomienda `shoponline`).
    *   Ve a la pestaña "Importar" y carga el script principal ubicado en `docs/Script.sql`.
    *   (Opcional) Para tener información ficticia con qué interactuar, importa luego el script `docs/datos_prueba.sql`.
4.  **Configurar Conexión:**
    *   Si tu base de datos tiene un nombre o contraseña distintos, modifícalo en `config/conexion.php`.
5.  **Iniciar Sesión:**
    *   Accede al sistema desde tu navegador en `http://localhost/ShopOnline_Huila`.
    *   Utiliza las credenciales de un empleado Administrador insertado en `datos_prueba.sql` (ej. `carlos.h@shop.com`, contraseña `12345678`).

---

*Desarrollado con pasión para fortalecer el comercio electrónico y la visibilidad de los artesanos del Huila.* 🇨🇴
