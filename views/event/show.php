<?php  
include_once("components/header.php");
?>
<!-- FORMULARIO DE CREACION DE eventS -->
<div class="container">
	<form action="//update" method="POST" class="needs-validation">
		<div class="card my-5">
			<?php  foreach($data["events"] as $event): ?>
			<div class="card-header">
				<h5><b><?=$event['master_id']?> | </b><?=$event['event']?></h5>
			</div>
			<div class="card-body">
				<!-- EVENTO -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $event['event'] ?>" required class="form-control" name="event" id="floatingInput" placeholder="Insegra un nombre">
					<label for="floatingInput">Nombre del evento</label>
				</div>
				<div class="row">
					<div class="col-4">
						<!-- TIPO -->
						<div class="form-floating mb-3">
							<select name="propertie_id" class="form-select" id="datalistOptions" aria-label="">
								<option value="<?= $event['type_id'] ?>" selected><?= $event['type']?></option>
								<option value="1">automatic</option>
								<option value="2">manual</option>
							</select>
							<label for="floatingSelect">Tipo de evento</label>
						</div>
					</div>
					<div class="col-4">
						<!-- FUENTE ID OSIEM -->
						<div class="form-floating mb-3">
							<input name="percentage" type="number" value="<?= $event['source_id'] ?>" class="form-control">
							<label for="floatingInput">Fuente OSIEM</label>
						</div>
					</div>
					<div class="col-4">
						<!-- EVENT ID-->
						<div class="form-floating mb-3">
							<input name="percentage" type="number" value="<?= $event['event_id'] ?>" class="form-control">
							<label for="floatingInput">Evento OSIEM</label>
						</div>
					</div>
				</div>
				<?php  endforeach; ?>
			</div>
			<div class="card-footer">
				<!-- END FIELD -->
				<div class="row">
					<div class="col-4">
						<button type="reset" class="btn btn-outline-secondary form-control">Limpiar</button>
					</div>
					<div class="col-4">
						<button type="submit" class="btn btn-primary form-control">Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
