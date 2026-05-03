<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Clientes | ShopOnline Huila</title>

    <link
        rel="stylesheet"
        href="/ShopOnline_Huila/assets/css/styles.css">
</head>

<body>

    <div class="layout">

        <header class="page-header">

            <div>

                <h1>Clientes</h1>

                <p>
                    Gestión y administración de clientes.
                </p>

            </div>

            <a
                href="form.php"
                class="btn btn-primary">

                Nuevo Cliente

            </a>

        </header>

        <section class="card">

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Nombre</th>

                            <th>Email</th>

                            <th>Teléfono</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>#001</td>

                            <td>María González</td>

                            <td>maria@email.com</td>

                            <td>3001234567</td>

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

                            <td>Carlos Ramírez</td>

                            <td>carlos@email.com</td>

                            <td>3019876543</td>

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