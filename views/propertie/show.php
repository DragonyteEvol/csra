<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["properties"] as $propertie): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/propertie/update/<?= $propertie['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$propertie['master_id']?> | </b><?=$propertie['propertie']?></h5>
			</div>
			<div class="card-body">
				<!-- PROPIEDAD -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $propertie['propertie'] ?>" required class="form-control" name="propertie" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del la propiedad</label>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-6">
							<a class="btn btn-outline-danger form-control" href="/propertie/delete/<?= $propertie['master_id'] ?>">Eliminar</a>
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

