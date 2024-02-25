<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["modules"] as $module): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/module/update/<?= $module['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$module['master_id']?> | </b><?=$module['module']?></h5>
			</div>
			<div class="card-body">
				<!-- MODULO-->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $module['module'] ?>" required class="form-control" name="module" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del calificador</label>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-6">
							<a class="btn btn-outline-danger form-control" href="/module/delete/<?= $module['master_id'] ?>">Eliminar</a>
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

