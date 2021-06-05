<?php
print('
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Juegos</title>
    <meta name="description" content="Bienvenidos.">
    <link rel="shortcut icon" type="image/png" href="./public/img/favicon.png">
    <link rel="stylesheet" href="./public/css/responsimple.min.css">
    <link rel="stylesheet" href="./public/css/.css">
</head>

<body>
    <header class="">
        <div class="">
            <h1 class="">Inventario juegos</h1>
        </div>
        ');

if ($_SESSION['ok']) {
    print('
                <nav class="">
                    <ul class="container">
                        <li class=""><a href="./">Inicio</a></li>
                        <li class=""><a href="productos">Productos</a></li>
                        <li class=""><a href="usuarios">Usuarios</a></li>
                        <li class=""><a href="categorias">Categorias</a></li>
                        <li class=""><a href="consolas">Consolas</a></li>
                        <li class=""><a href="formatos">Formato</a></li>
                        <li class=""><a href="ubicaciones">Ubicación</a></li>
                        <li class=""><a href="salir">Salir</a></li>
                    </ul>
                </nav>
                ');
}

print('
        </header>
    <main class="">
        ');