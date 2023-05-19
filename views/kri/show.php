<?php  
include_once("components/header.php");
?>
<!-- FORMULARIO DE CREACION DE KRIS -->
<div class="container">
	<form action="/kri/update" method="POST" class="needs-validation">
		<div class="card my-5">
			<?php  foreach($data["kris"] as $kri): ?>
			<div class="card-header">
				<h5><b><?=$kri['master_id']?>.</b>Visualizacion de KRI <?=$kri['kri']?></h5>
			</div>
			<div class="card-body">
				<!-- KRI -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $kri['kri'] ?>" required class="form-control" name="kri" id="floatingInput" placeholder="Insegra un nombre">
					<label for="floatingInput">Nombre del KRI</label>
				</div>
				<!-- OBJECTIVO -->
				<div class="form-floating">
					<textarea class="form-control mb-3" name="objective" id="floatingTextarea2"><?= $kri["objective"] ?></textarea>
					<label for="floatingTextarea2">Objetivo</label>
				</div>
				<div class="row">
					<div class="col-6">
						<!-- PROPIEDAD -->
						<div class="form-floating mb-3">
							<select name="propertie_id" class="form-select" id="datalistOptions" aria-label="">
								<option value="<?= $kri['propertie_id'] ?>" selected><?= $kri['propertie']?></option>
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
				<!-- SYNTAX-->
				<div class="form-floating mb-3">
					<input name="syntax" type="text" value="<?= $kri['syntax'] ?>" class="form-control disabled">
					<label for="floatingInput">Sintaxis / Operacion de kri</label>
				</div>
				<div class="accordion accordion-flush" id="accordionFlushExample">
					<!-- EVENTOS -->
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#event-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
								Eventos	
							</button>
						</h2>
						<div id="event-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div class="my-2">
								<button name="events" type="button" class="form-control btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Añadir evento
								</button>
								<?php  foreach($data["events"] as $event): ?>
								<div class="form-check">
									<input type="checkbox" checked id="<?= $event['event'] ?>" value="<?= $event['id'] ?>" name="event[]" class="form-check-input">
									<label class="form-check-label" for="<?= $event['event'] ?>"><?= $event['event'] ?></label>
								</div>
								<?php  endforeach; ?>
							</div>
						</div>
					</div>
					<!-- QUALIFIERS -->
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qualifier-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
								Calificadores
							</button>
						</h2>
						<div id="qualifier-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								<?php  foreach($data["qualifiers"] as $qualifier): ?>
								<div class="input-group mb-3">
									<div class="form-floating">
										<input type="text" value="<?= $qualifier['type'] ?>" class="form-control" name="qualifiers[]" id="floatingInputGroup1">
										<label for="floatingInputGroup1">Nombre Calificador</label>
									</div>
									<div class="form-floating">
										<input type="text" class="form-control" value="<?= $qualifier['value'] ?>" name="qualifiers_values[]" id="floatingInputGroup1">
										<label for="floatingInputGroup1">Valor</label>
									</div>
								</div>
								<?php  endforeach; ?>
								<button type="button" onclick="addQualifier()" class="form-control btn btn-outline-primary btn-sm">
									Agregar
								</button>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#map-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
								Mapa relacional
							</button>
						</h2>
						<div id="map-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div class="row align-items-center my-2">
								<div class="col-6">
									<button class="btn btn-outline-dark btn-sm form-control">
										<?= $kri["kri"] ?>
									</button>
								</div>
								<div class="col-6">
									<?php  foreach($data["events"] as $event): ?>
									<button class="btn btn-outline-dark btn-sm form-control my-2" data-bs-toggle="popover" data-bs-title="Descripcion del evento" data-bs-content="">
										<?= $event["event"]?>
									</button>
									<?php  endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php  endforeach; ?>
			</div>
			<div class="card-footer">
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
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="/assets/js/search.js"></script>
<script>
	searchEvent({
		listOptions: "datalistOptions",
		search: "propertie",
		components: new Map([
			["value","id"]
		]),
		value: "propertie",
		table: "properties",
		tag: "option"
	})
</script>
