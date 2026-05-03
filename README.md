Este proyecto es una aplicación web desarrollada en PHP que permite gestionar productos y ventas para una empresa de artículos de fiesta. Implementa el patrón MVC (Modelo - Vista - Controlador) para organizar la lógica del sistema.

El sistema permite:

Gestionar productos (crear, listar, editar, eliminar)
Registrar ventas
Consultar información de ventas y productos
Validar datos en el frontend con JavaScript

ACTIVIDAD-INTEGRADORA-2/
│
├── config/
│   └── database.php        # Configuración de conexión a la base de datos
│
├── controllers/
│   ├── ProductoControllers.php
│   └── VentasController.php
│
├── models/
│   ├── Producto.php
│   └── Ventas.php
│
├── public/
│   ├── index.php           # Punto de entrada productos
│   ├── indexVentas.php     # Punto de entrada ventas
│   ├── productos.php       # Vista productos
│   └── ventas.php          # Vista ventas
│
├── js/
│   └── validaciones.js     # Validaciones en frontend
│
├── database/
│   └── party.sql           # Script de base de datos
│
└── README.md

Base de datos
party.sql

Ejecucion del proyecto con xampp
http://localhost/ACTIVIDAD-INTEGRADORA-2/public/index.php

Requisitos
PHP 8 o superior
MySQL
Navegador web
Servidor local (XAMPP, WAMP o similar)

Pasos para instalacion
1. git clone https://github.com/tu-usuario/ACTIVIDAD-INTEGRADORA-2.git
2. copiar la carpeta en C:\xampp\htdocs\
3. iniciar xampp con apache mySql
4. crear la base datos con el script que se encuentra en la carpeta database
5. modificar las credencial del mySql en el archivo database.php de la carpeta config
6. abrir navegador y copiar http://localhost/ACTIVIDAD-INTEGRADORA-2/public/index.php



