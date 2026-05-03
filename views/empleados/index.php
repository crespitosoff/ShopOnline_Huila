<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Empleados | ShopOnline Huila</title>

    <link
        rel="stylesheet"
        href="/ShopOnline_Huila/assets/css/styles.css">

</head>

<body>

    <div class="layout">

        <header class="page-header">

            <div>

                <h1>Empleados</h1>

                <p>
                    Gestión de empleados del sistema.
                </p>

            </div>

            <a
                href="form.php"
                class="btn btn-primary">

                Nuevo Empleado

            </a>

        </header>

        <section class="card">

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Nombre</th>

                            <th>Cargo</th>

                            <th>Salario</th>

                            <th>Fecha Ingreso</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>#001</td>

                            <td>Laura Martínez</td>

                            <td>
                                <span class="badge">
                                    Administrador
                                </span>
                            </td>

                            <td>$3.500.000</td>

                            <td>2025-05-01</td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="form.php?id=1"
                                        class="btn btn-warning">

                                        Editar

                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-danger">

                                        Eliminar

                                    </button>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>#002</td>

                            <td>Carlos Pérez</td>

                            <td>
                                <span class="badge">
                                    Vendedor
                                </span>
                            </td>

                            <td>$2.100.000</td>

                            <td>2025-04-18</td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="form.php?id=2"
                                        class="btn btn-warning">

                                        Editar

                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-danger">

                                        Eliminar

                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </div>

    <script src="/ShopOnline_Huila/assets/js/validations.js"></script>

</body>

</html>