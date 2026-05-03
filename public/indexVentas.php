<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../controllers/ProductoControllers.php';
require_once __DIR__.'/../controllers/VentasController.php';


    $database = new Database(); //Creo instancia de tipo Database 
    $pdo=$database->connect();  // Llamo a funcion connect
    $productoModel= new Producto($pdo); //Creo una instancia de tipo Producto
    $controller= new ProductoController($productoModel); //Creo una instancia de tipo ProductosController y le envio el modelo
    $ventaModel= new Ventas($pdo); //Creo una instancia de tipo Ventas
    $controllerVenta = new VentasController($ventaModel, $productoModel); //Creo una instancia de tipo VentasController y le envio el modelo


    $action= $_GET['action'] ?? 'index';

    switch ($action)
    {
        case 'guardarVenta':
            $controllerVenta->guardar();
            break;
        case 'editarVenta':
            $controllerVenta-> editar();
            break;
        case 'actualizarVenta':
            $controllerVenta->actualizar();
            break;
        case 'eliminarVenta':
            $controllerVenta->eliminar();
            break;
        case 'index':
            $controllerVenta-> index();
            break;

    }









?>