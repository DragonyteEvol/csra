<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["qualifiers"] as $qualifier): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/qualifier/update/<?= $qualifier['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$qualifier['master_id']?> | </b><?=$qualifier['qualifier']?></h5>
			</div>
			<div class="card-body">
				<!-- CALIFICADOR-->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $qualifier['qualifier'] ?>" required class="form-control" name="qualifier" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del calificador</label>
				</div>
				<!-- VALOR -->	
				<div class="form-floating mb-3">
					<input type="number" value="<?= $qualifier['value'] ?>" required class="form-control" name="value" id="floatingInput" placeholder="Ingresa un valor">
					<label for="floatingInput">Valor</label>
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

