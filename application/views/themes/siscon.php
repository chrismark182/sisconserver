<!DOCTYPE>
<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/siscon.css?<?= time() ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SISCON</title>
</head>
<body>
	<nav class="blue-grey darken-1" style="padding: 0 1em;">
    	<div class="nav-wrapper">
		<?php if($this->session->userdata('logged_in')): ?>
			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<?php endif; ?>
			<a href="<?= base_url() ?>" class="brand-logo">SISCON</a>
			<!-- Dropdown Structure -->
			<ul id="dropUsuario" class="dropdown-content">
				<li><a href="<?= base_url() ?>logout">Cerrar Sesión</a></li>
			</ul>


			<?php if(!empty($accesos['padres'])):  ?>
				<?php foreach ($accesos['padres'] as $menu_padre): ?>
					<ul id="<?= $menu_padre->MENU_ID; ?>" class="dropdown-content">
						<?php foreach($accesos['hijos'] as $hijo):?>
							<?php if($hijo->MENU_PADRE_ID == $menu_padre->MENU_ID): ?>
								<li>
									<a href="<?= base_url() ?><?= $hijo->MENU_RUTA; ?>">
										<?= $hijo->MENU_DESCRIPCION; ?>
									</a>
								</li> 
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
			<?php endif; ?>


			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<?php if($this->session->userdata('logged_in')): ?>
					<?php if(!empty($accesos['padres'])): ?>
						<?php foreach($accesos['padres'] as $acceso): ?>
							<?php if($acceso->MENU_RUTA == '#'): ?>
								<li><a class="dropdown-trigger" href="#!" data-target="<?= $acceso->MENU_ID ?>"><?= $acceso->MENU_DESCRIPCION ?><i class="material-icons right">arrow_drop_down</i></a></li>
							<?php else: ?>
								<li>
									<a href="<?= base_url() . $acceso->MENU_RUTA ?>"><?= $acceso->MENU_DESCRIPCION ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<li><a href="#" class="dropdown-trigger" data-target="dropUsuario"><?= $session->USUARI_C_USERNAME ?>
						<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php else: ?>
				
				<?php endif;?>
				
			</ul>
    	</div>
  	</nav>
	<ul id="slide-out" class="sidenav">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="<?= base_url() ?>assets/images/office.jpg">
				</div>
				<a href="#user"><img class="circle" src="<?= base_url() ?>assets/images/yuna.jpg"></a>
				<a href="#name"><span class="white-text name"><?= $session->USUARI_USERNAME ?></span></a>
				<a href="#email"><span class="white-text email"><?= $session->USUARI_USERNAME ?>@gmail.com</span></a>
			</div>
		</li>
		
		<?php if($this->session->userdata('logged_in')): ?>
			<?php if(!empty($accesos['hijos'])): ?>
				<?php foreach($accesos['hijos'] as $acceso): ?>
					<li>
						<a href="<?= base_url() . $acceso->MENU_RUTA ?>"><?= $acceso->MENU_DESCRIPCION ?></a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php else: ?>
		<?php endif;?>
		<li><div class="divider"></div></li>
		<li><a href="#!" class="subheader">Seguridad</a></li>
		<li><a class="waves-effect" href="<?= base_url() ?>logout">Cerrar Sesión</a></li>
	</ul>
	<div class="container">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="card-panel teal lighten-2 white-text"><?= $this->session->flashdata('message'); ?></div>
		<?php endif ?>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="card-panel red lighten-2 white-text"><?= $this->session->flashdata('error'); ?></div>
		<?php endif ?>
	</div>
	<?php echo $output;?>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/materialize.js"></script>
	<script>
		$('select').formSelect();
		$('.sidenav').sidenav();
		$('.modal').modal();
		$('.dropdown-trigger').dropdown();
		$('.tooltipped').tooltip();
	</script>
</body>
</html>