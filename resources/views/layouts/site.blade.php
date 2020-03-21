<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esandex</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<nav class="brown lighten-1">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">
            <img src="images/logo_blanco.png" alt="" >
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
        @if (!empty(session('user')))
            <li><a href="clientes">Cliente</a></li>
            <li><a href="menus">Menu</a></li>
            <li><a href="categorias">Categoria</a></li>
            <li><a href="usuarios">Usuarios</a></li>
            <li><a href="logout">Cerrar Sesión</a></li>
            

        @endif
        </ul>
    </div>
</nav>
@yield('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>   
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('Inicio completo')
            M.updateTextFields();
        });
    </script>

</body>
</html>