<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private Producto $model;

    public function __construct(Producto $model)
    {
        $this->model = $model;
    }

    public function index(): void
    {
        $productos = $this->model->getAll();  // CONSULTA LOS DATOS
        $producto = null;
        require __DIR__ . '/../views/productos.php'; // MUESTRA LA VISTA
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'precio' => trim($_POST['precio'] ?? ''),
            'cantidadStock' => trim($_POST['cantidadStock'] ?? ''),
            'estado' => $_POST['estado'] ?? 'Activo',
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
            'nombre' => trim($_POST['nombre'] ?? ''),
            'precio' => trim($_POST['precio'] ?? ''),
            'cantidadStock' => trim($_POST['cantidadStock'] ?? ''),
            'estado' => $_POST['estado'] ?? 'Activo',
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
