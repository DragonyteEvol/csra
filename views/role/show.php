<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["roles"] as $role): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/role/update/<?= $role['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$role['master_id']?> | </b><?=$role['role']?></h5>
			</div>
			<div class="card-body">
				<!-- ROL -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $role['role'] ?>" required class="form-control" name="role" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del rol</label>
				</div>
				<div class="card-footer">
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
		</form>
	</div>
	<?php  endforeach; ?>
</div>

