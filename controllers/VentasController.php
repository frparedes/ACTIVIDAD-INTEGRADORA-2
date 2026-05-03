<?php

require_once __DIR__ . '/../models/Ventas.php';
require_once __DIR__ . '/../models/Producto.php';

class VentasController
{
    private Ventas $model;
    private Producto $modelProducto;

    public function __construct(Ventas $model, Producto $modelProducto)
    {
        $this->model = $model;
        $this->modelProducto = $modelProducto;
    }

    public function index(): void
    {
        $ventas = $this->model->getAll();  // CONSULTA LOS DATOS
        $venta = null;
        $productos = $this->modelProducto->getAll();  // CONSULTA LOS DATOS
        $producto = null;
        require __DIR__ . '/../public/ventas.php'; // MUESTRA LA VISTA
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: indexVentas.php');
            exit;
        }

        $data = [
            'nombreCliente' => trim($_POST['nombreCliente'] ?? ''),
            'idProducto' => trim($_POST['idProducto'] ?? ''),
            'cantidad' => trim($_POST['cantidad'] ?? '0'),
            'total' => $_POST['total'] ?? '0',
        ];

        if ($this->model->create($data)) {
            header('Location: indexVentas.php?success=1');
            exit;
        }

        header('Location: indexVentas.php?error=1');
        exit;
    }

    public function editar(): void
    {
        $productos = $this->modelProducto->getAll();  // CONSULTA LOS DATOS
        $producto = null;
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: indexVentas.php');
            exit;
        }

        $venta = $this->model->findById($id);
        if (!$venta) {
            header('Location: indexVentas.php');
            exit;
        }

        $ventas = $this->model->getAll();
        require __DIR__ . '/../public/ventas.php';
    }


    public function actualizar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: indexVentas.php');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: indexVentas.php?update_error=1');
            exit;
        }

        $data = [
            'nombreCliente' => trim($_POST['nombreCliente'] ?? ''),
            'idProducto' => trim($_POST['idProducto'] ?? ''),
            'cantidad' => trim($_POST['cantidad'] ?? '0'),
            'total' => $_POST['total'] ?? '0',
        ];

        if ($this->model->update($id, $data)) {
            header('Location: indexVentas.php?updated=1');
            exit;
        }

        header('Location: indexVentas.php?update_error=1');
        exit;
    }

    public function eliminar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: indexVentas.php');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: indexVentas.php?delete_error=1');
            exit;
        }

        if ($this->model->delete($id)) {
            header('Location: indexVentas.php?deleted=1');
            exit;
        }

        header('Location: indexVentas.php?delete_error=1');
        exit;
    }
}
