<?php  var_dump($data)?>
<?php  
include_once("components/header.php");
?>
<!-- FORMULARIO DE CREACION DE KRIS -->
<div class="container">
	<form action="/kri/insert" method="POST" class="needs-validation">
		<div class="card">
			<?php  foreach($data["kris"] as $kri): ?>
			<div class="card-body">
				<!-- KRI -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $kri['kri'] ?>" required class="form-control" name="kri" id="floatingInput" placeholder="Insegra un nombre">
					<label for="floatingInput">Nombre del KRI</label>
				</div>
				<!-- OBJECTIVO -->
				<div class="form-floating">
					<textarea class="form-control mb-3" value="pedro" name="objective" id="floatingTextarea2"></textarea>
					<label for="floatingTextarea2">Objetivo</label>
				</div>
				<div class="row">
					<div class="col-6">
						<!-- PROPIEDAD -->
						<div class="form-floating mb-3">
							<select name="propertie_id" class="form-select" id="datalistOptions" aria-label="">
							</select>
							<label for="floatingSelect">Propiedad</label>
						</div>
					</div>
					<div class="col-6">
						<!-- PORCENTAJE -->
						<div class="form-floating mb-3">
							<input name="percentage" type="number" value="<?= $kri['percentage'] ?>" class="form-control">
							<label for="floatingInput">Porcentaje</label>
						</div>
					</div>
				</div>
				<!-- EVENTOS -->
				<button name="events" type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Añadir evento
				</button>
				<select name="event[]" id="events" class="form-select mb-3" multiple>
				</select>
				<!-- SYNTAX-->
				<div class="form-floating mb-3">
					<input name="syntax" type="text" value="<?= $kri['syntax'] ?>" class="form-control disabled">
					<label for="floatingInput">Sintaxis / Operacion de kri</label>
				</div>
				<!-- QUALIFIERS -->
				<div class="card">
					<div class="card-header">
						<h5 class="mt-2">Calificadores</h5>
					</div>
					<div class="card-body" id="qualifiers">
						<div class="input-group mb-3">
							<div class="form-floating">
								<input type="text" class="form-control" name="qualifiers[]" id="floatingInputGroup1">
								<label for="floatingInputGroup1">Nombre Calificador</label>
							</div>
							<div class="form-floating">
								<input type="text" class="form-control" name="qualifiers_values[]" id="floatingInputGroup1">
								<label for="floatingInputGroup1">Valor</label>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" onclick="addQualifier()" class="form-control btn btn-primary">
							Agregar
						</button>
					</div>
				</div>
			</div>
			<?php  endforeach; ?>
			<div class="card-footer">
				<!-- END FIELD -->
				<button type="submit" class="btn btn-primary">Enviar</button>
			</div>
		</div>
	</form>
</div>
<!-- FORMULARIO DE ADICION DE EVENTOS -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Buscar Evento</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-floating mb-3">
					<input type="text" required class="form-control" id="searchEvent" placeholder="Insegra un nombre">
					<label for="floatingInput">Buscar evento</label>
				</div>
				<div class="justify-content-center" id="datalistOptionsEvent">

				</div>
			</div>
		</div>
	</div>
</div>
