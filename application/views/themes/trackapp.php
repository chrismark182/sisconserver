<!DOCTYPE html>
<html lang="es">
    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" href="template/css/main.css">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <nav class="light-blue accent-4">
            <div class="nav-wrapper">
                <a href="#!" class="brand-logo">Track App</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="btn-large orange accent-3" href="#">Iniciar sesión</a></li></ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a class="btn-large" href="#">Iniciar sesión</a></li></ul>
                </ul>
            </div>
        </nav>
        <?php echo $output;?>
        <footer class="page-footer light-blue accent-4">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Track App</h5>
                        <p class="grey-text text-lighten-4">TrackApp Copy.</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Contáctanos</h5>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">Youtube</a></li>
                        </ul>
                    </div>
                </div>
        </div>
        <div class="footer-copyright">
                <div class="container">
                    Track App © 2016 Copyright Text
                    <a class="grey-text text-lighten-4 right" href="#!">No dar clic aqui</a>
                </div>
        </div>
        </footer>

        <!--Import jQuery before materialize.js-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        <script type="text/javascript" src="template/js/main.js"></script>
    
    </body>
</html>
