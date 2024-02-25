<?php  
include_once("components/header.php");
?>
<div class="container">
	<!-- FORMULARIO -->
	<div class="row">
		<?php  foreach($data["users"] as $user): ?>
		<form action="/user/update/<?= $user['master_id'] ?>" method="POST" class="needs-validation">
			<div class="bg-white rounded-lg shadow card my-5 border border-light">
				<div class="card-body">

					<div class="card-title">
						<h5><b><?=$user['master_id']?> | </b><?=$user['name']?></h5>
					</div>
					<!-- USURIO-->
					<div class="form-floating mb-3">
						<input type="text" value="<?= $user['name'] ?>" required class="form-control" name="name" id="floatingInput" placeholder="Insegra un nombre">
						<label for="floatingInput">Nombre del usuario</label>
					</div>
					<!-- EMAIL -->
					<div class="form-floating mb-3">
						<input type="mail" value="<?= $user['email'] ?>" required class="form-control" name="email" id="floatingInput" placeholder="Ingresa un email">
						<label for="floatingInput">Email</label>
					</div>
					<!-- CONTRASEÑA -->
					<div class="form-floating mb-3">
						<input type="password" value="sobelomenor" required class="form-control" name="user" id="floatingInput" placeholder="Ingresa una contraseña">
						<label for="floatingInput">Contraseña</label>
					</div>
					<!-- ROL -->
					<div class="form-floating mb-3">
						<select name="role_id" class="form-select" id="datalistOptions" aria-label="">
							<option value="<?= $user['role_id'] ?>" selected><?= $user['role']?></option>
						</select>
						<label for="floatingSelect">Rol</label>
					</div>

					<!-- END FIELD -->
					<div class="row">
						<div class="col-6">
							<a class="btn btn-outline-danger form-control" href="/user/delete/<?= $user['master_id'] ?>">Eliminar</a>
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
<script>
	searchEvent({
		listOptions: "datalistOptions",
		search: "role",
		components: new Map([
			["value","id"]
		]),
		value: "role",
		table: "roles",
		tag: "option"
	})
</script>
