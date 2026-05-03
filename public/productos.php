<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empresa Productos de Fiesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-start">
            <a class="btn btn-outline-success me-2" href="index.php?action=index">Productos</a>
            <a class="btn btn-outline-success me-2" href="indexVentas.php?action=index">Ventas</a>
        </form>
    </nav>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Mantenimiento de Productos de Fiesta</h4>
        </div>

        <div class="card-body">

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Producto guardado correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['updated'])): ?>
                <div class="alert alert-success">Producto actualizado correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Error al guardar el producto.</div>
            <?php endif; ?>

            <?php if (isset($_GET['update_error'])): ?>
                <div class="alert alert-danger">Error al actualizar el producto.</div>
            <?php endif; ?>

            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">Producto eliminado correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['delete_error'])): ?>
                <div class="alert alert-danger">Error al eliminar el producto.</div>
            <?php endif; ?>

            <form name="formProducto" method="POST" action="index.php?action=<?= isset($producto) && $producto ? 'actualizarProducto' : 'guardarProducto' ?>">
                <?php if (!empty($producto)): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Precio</label>
                        <input type="number" name="precio" id="precio" step="any" class="form-control" required value="<?= $producto['precio'] ?? '0.00' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Cantidad Stock</label>
                        <input type="number" name="cantidadStock" id="cantidadStock" class="form-control" required value="<?= htmlspecialchars($producto['cantidadStock'] ?? '') ?>">
                    </div>
                </div>

                <button id="btnGuardar" type="submit" class="btn btn-success"><?= !empty($producto) ? 'actualizar' : 'guardar' ?></button>
                <?php if (!empty($producto)): ?>
                    <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
                <?php endif; ?>
            </form>

            <div id="mensaje" class="mt-2"></div>


            <hr>

            <h5>Listado de Productos</h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad en Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['precio']) ?></td>
                            <td><?= htmlspecialchars($u['cantidadStock']) ?></td>
                            <td>
                                <a href="index.php?action=editarProducto&id=<?= htmlspecialchars($u['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="index.php?action=eliminarProducto" style="display:inline; margin-left: 5px;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($u['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<script src="../js/validaciones.js" ></script>
</body>
</html>
