<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["types"] as $type): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/type/update/<?= $type['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$type['master_id']?> | </b><?=$type['type']?></h5>
			</div>
			<div class="card-body">
				<!-- CALIFICADOR-->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $type['type'] ?>" required class="form-control" name="type" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del tipo</label>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-6">
							<a class="btn btn-outline-danger form-control" href="/type/delete/<?= $type['master_id'] ?>">Eliminar</a>
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

