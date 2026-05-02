<?php

require_once __DIR__ . '/../models/Ventas.php';

class VentasController
{
    private Ventas $model;

    public function __construct(Ventas $model)
    {
        $this->model = $model;
    }

    public function index(): void
    {
        $ventas = $this->model->getAll();  // CONSULTA LOS DATOS
        $venta = null;
        require __DIR__ . '/../views/ventas.php'; // MUESTRA LA VISTA
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $data = [
            'nombreCliente' => trim($_POST['nombre'] ?? ''),
            'idProducto' => trim($_POST['idProducto'] ?? ''),
            'cantidad' => trim($_POST['cantidad'] ?? '0'),
            'total' => $_POST['total'] ?? '0',
        ];

        if ($this->model->create($data)) {
            header('Location: index.php?success=1');
            exit;
        }

        header('Location: index.php?error=1');
        exit;
    }


    public function actualizar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: index.php?update_error=1');
            exit;
        }

        $data = [
            'nombreCliente' => trim($_POST['nombreCliente'] ?? ''),
            'idProducto' => trim($_POST['idProducto'] ?? ''),
            'cantidad' => trim($_POST['cantidad'] ?? '0'),
            'total' => $_POST['total'] ?? '0',
        ];

        if ($this->model->update($id, $data)) {
            header('Location: index.php?updated=1');
            exit;
        }

        header('Location: index.php?update_error=1');
        exit;
    }

    public function eliminar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: index.php?delete_error=1');
            exit;
        }

        if ($this->model->delete($id)) {
            header('Location: index.php?deleted=1');
            exit;
        }

        header('Location: index.php?delete_error=1');
        exit;
    }
}
