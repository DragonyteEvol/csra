<head class="mb-2">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<nav class="bg-white rounded-lg shadow navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-fluid">
		<span>
			<?php session_start();?>
			<?= $_SESSION["user"]  ?>
		</span>
		<a class="navbar-brand" href="#"></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/risk">Inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/risk">Riesgos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/kri">KRI's</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/event">Eventos</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mas</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="/user">Usuarios</a></li>
						<li><a class="dropdown-item" href="/role">Roles</a></li>
						<li><a class="dropdown-item" href="/source">Fuentes</a></li>
						<li><a class="dropdown-item" href="/propertie">Propiedades</a></li>
						<li><a class="dropdown-item" href="/type">Tipos</a></li>
						<li><a class="dropdown-item" href="/module">Modulos</a></li>
						<li><a class="dropdown-item" href="/qualifier">Calificadores</a></li>
						<li><a class="dropdown-item" href="/login/logout">Cerrar Sesion</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.1/mustache.min.js" integrity="sha512-3GRj7sme01zpWwRNPNy48Rda1bD9cq34lqYG5vb8ZXGc+wRqsoBJ3+AC25IYW5w5SrWlzHqIpNIxZt5QF9sXLg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
