<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empresa Productos de Fiesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h4>Mantenimiento de Ventas</h4>
        </div>

        <div class="card-body">

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Venta guardada correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['updated'])): ?>
                <div class="alert alert-success">Venta actualizada correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Error al guardar la venta.</div>
            <?php endif; ?>

            <?php if (isset($_GET['update_error'])): ?>
                <div class="alert alert-danger">Error al actualizar la venta.</div>
            <?php endif; ?>

            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">Venta eliminada correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['delete_error'])): ?>
                <div class="alert alert-danger">Error al eliminar la venta.</div>
            <?php endif; ?>

            <form method="POST" action="indexVentas.php?action=<?= isset($venta) && $venta ? 'actualizarVenta' : 'guardarVenta' ?>">
                <?php if (!empty($venta)): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($venta['id']) ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre Cliente</label>
                        <input type="text" name="nombreCliente" class="form-control" required value="<?= htmlspecialchars($venta['nombreCliente'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Producto</label>
                        <select name="idProducto" class="form-select">
                                <option value="">Seleccione...</option>
                                    <?php foreach ($productos as $fila): 
                                        $selected = ($fila['id'] == $venta['idProducto']) ? 'selected' : '';
                                        echo '<option value="' . $fila['id'] . '"' . $selected . '>' . $fila['nombre'] . '</option>';
                                        endforeach; 
                                ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required value="<?= htmlspecialchars($venta['cantidad'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Total</label>
                        <input type="number" name="total" step="any" class="form-control" readonly value="<?= $venta['total'] ?? '0.00' ?>">
                    </div>
                    
                </div>

                <button type="submit" class="btn btn-success"><?= !empty($venta) ? 'actualizar' : 'guardar' ?></button>
                <?php if (!empty($venta)): ?>
                    <a href="indexVentas.php" class="btn btn-secondary ms-2">Cancelar</a>
                <?php endif; ?>
            </form>

            <hr>

            <h5>Listado de Ventas</h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['nombreCliente']) ?></td>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['cantidad']) ?></td>
                            <td><?= htmlspecialchars($u['total']) ?></td>
                            <td>
                                <a href="indexVentas.php?action=editarVenta&id=<?= htmlspecialchars($u['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="indexVentas.php?action=eliminarVenta" style="display:inline; margin-left: 5px;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($u['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar venta?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
