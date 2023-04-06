<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Iniciar sesion - Csra</title>
		<link rel="stylesheet" href="assets/css/styles.css">
		<!-- cdn bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>
	<body>
		<div class="container text-center">
			<div class="row justify-content-center">
				<div class="col-sm-10 col-md-8 col-lg-4">
					<h1>Iniciar sesion</h1>
					<span>o <a href="/register">Registrarse</a></span>
					<!-- formulario de inicio de sesion -->
					<form action="/login/login" method="POST" class="needs-validation">
						<?php if($_SESSION["error"]){?>
						<div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
							credenciales incorrectas
						</div>
						<?php } ?>
						<div class="form-floating mb-3">
							<input type="text" id="validationDefault01" required oninvalid="this.setCustomValidity('Ingresa un correo')" name="email" class="form-control">
							<label for="floatingInput">Ingresa tu correo</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" id="validationDefault01" required oninvalid="this.setCustomValidity('Ingresa un contraseña valida')" name="password" class="form-control">
							<label for="floatingInput">Ingresa tu correo</label>
						</div>
						<input class="form-control my-2 btn btn-primary" type="submit" value="Enviar">
					</form>
				</div>
			</div>
		</div>
	</body>
	<!-- javascript de bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
