<!DOCTYPE html>
<html lang="es">
<head>
    <title>Home | Esandex</title>

    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true" />

    <link rel="icon" type="image/png" href="<?= base_url() ?>template/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Baloo+Tammudu|Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>node_modules/materialize-css/dist/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>template/css/style.css?<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>template/css/esandex.css?<?= time() ?>">
    <style>
        .fb_dialog
        {
            bottom: 200px;
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59493102-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-59493102-1');
    </script>
</head>
<body>
    <header>
        <nav class="brown">
            <div class="nav-wrapper">
                <a href="<?= base_url() ?>" class="brand-logo">Esandex</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <?php if (!$this->session->userdata('logged_in')) : ?>
                        <li>
                            <a href="login">Iniciar Sesión</a>
                        </li>
                    <?php else: ?>
                    <?php foreach($accesos as $acceso): ?>
                            <li>
                                <a href="<?= base_url() . $acceso->MENU_RUTA ?>"><?= $acceso->MENU_DESCRIPCION ?></a>
                            </li>
                        <?php endforeach; ?>
                        <!--<li>
                            <a href="dashboard">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>productos">Productos</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>clientes">Clientes</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>ventas">Ventas</a>
                        </li>-->
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="usuario">
                                <?= $session->USUARI_NAME ?>
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <ul id="usuario" class="dropdown-content" >
            <li>
                <a href="<?= base_url() ?>ajustes">
                    Ajustes
                </a>
            </li>
            <li>
                <a href="<?=  base_url() ?>/logout">Salir </a>
            </li>
        </ul>
    </header>


    <?php if ($this->session->flashdata('message')): ?>
        <div class="section container">
            <div class="card-panel teal lighten-2 white-text">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="section container">
            <div class="card-panel red lighten-2 white-text">
                <?= $this->session->flashdata('error'); ?>
            </div>
         </div>
    <?php endif ?>

    <?php echo $output;?>
        
    <div class="fb-customerchat" page_id="214527945413787"></div>  

    <?php if (!$this->session->userdata('logged_in')) : ?>
        <footer class="page-footer brown">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Esandex</h5>
                        <p class="grey-text text-lighten-4">Tenemos la solución para llevar tu negocio a un nuevo nivel. </p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Enlaces</h5>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="https://facebook.com/esandex">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container"> © 2018 Copyright Text </div>
            </div>
        </footer>
    <?php endif ?>

    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_ES/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-59493102-1', 'auto');
      ga('send', 'pageview');

    </script>
    <script src="<?= base_url() ?>node_modules/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="<?= base_url() ?>node_modules/materialize-css/dist/js/materialize.min.js" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" charset="utf-8">
        $('.carousel.carousel-slider').carousel({
            fullWidth: true
        });
        $(".dropdown-trigger").dropdown();
    </script>
</body>
</html>