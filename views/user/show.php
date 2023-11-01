<?php  
include_once("components/header.php");
?>
<div class="container">
	<!-- FORMULARIO -->
	<div class="row">
		<form action="/user/update/<?= $user['master_id'] ?>" method="PUT" class="needs-validation">
			<?php  foreach($data["users"] as $user): ?>
			<div class="bg-white rounded-lg shadow card my-5 border border-light">
				<div class="card-body">

					<div class="card-title">
						<h5><b><?=$user['master_id']?> | </b><?=$user['name']?></h5>
					</div>
					<!-- USURIO-->
					<div class="form-floating mb-3">
						<input type="text" value="<?= $user['name'] ?>" required class="form-control" name="user" id="floatingInput" placeholder="Insegra un nombre">
						<label for="floatingInput">Nombre del usuario</label>
					</div>
					<!-- EMAIL -->
					<div class="form-floating mb-3">
						<input type="mail" value="<?= $user['email'] ?>" required class="form-control" name="user" id="floatingInput" placeholder="Ingresa un email">
						<label for="floatingInput">Email</label>
					</div>
					<!-- CONTRASEÑA -->
					<div class="form-floating mb-3">
						<input type="password" value="sobelomenor" required class="form-control" name="user" id="floatingInput" placeholder="Ingresa una contraseña">
						<label for="floatingInput">Contraseña</label>
					</div>
					<!-- END FIELD -->
					<div class="row">
						<div class="col-6">
							<button type="reset" class="btn btn-outline-secondary form-control">Limpiar</button>
						</div>
						<div class="col-6">
							<button type="submit" class="btn btn-primary form-control">Actualizar</button>
						</div>
					</div>
				</div>
			</div>
			<?php  endforeach; ?>
		</form>
	</div>
	<div class="row">

	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="/assets/js/search.js"></script>
