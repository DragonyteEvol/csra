<?php  ;
include_once("components/header.php");
?>

<!-- FORMULARIO DE CREACION DE KRIS -->
<div class="container">
	<!-- FORMULARIO Y DATOS DE KRI -->
	<?php  foreach($data["kris"] as $kri): ?>
<!-- FECHAS INPUTS -->
	<div class="row my-2">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<input class="form-control bg-white rounded-lg shadow" id="from" name="from" type="date">
				</div>
				<div class="col-6">
					<div class="input-group">
						<input class="form-control d-flex bg-white rounded-lg shadow" id="to" name="to" type="date">
				<button onclick="redirect('kri',<?= $kri["master_id"] ?>,'from','to')" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787a5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0a4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501a6.921 6.921 0 0 0-1.315-.408a7.079 7.079 0 0 0-2.819 0a6.94 6.94 0 0 0-1.316.409a7.04 7.04 0 0 0-3.08 2.534a6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4l4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138a4.943 4.943 0 0 1-1.787.752a5.073 5.073 0 0 1-2.017 0a4.956 4.956 0 0 1-1.787-.752a5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0a7.031 7.031 0 0 0 4.395-2.945a6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4l-4 4z"/></svg></button>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- PRIMERA FILA -->
	<div class="row">
		<div class="col-xl-4 col-lg-6 mb-4">
			<div class="bg-white rounded-lg p-5 shadow">
				<h2 class="h6 font-weight-bold text-center mb-4">Valoración del Indicador</h2>
				<!-- Progress bar 1 -->
				<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar" style="width: 25%">Bajo</div>
				</div>
				<!-- END -->

				<!-- Demo info -->
				<div class="row text-center mt-4">
					<div class="col-6 border-right">
						<div class="h4 font-weight-bold mb-0"><?= $data['score'] ?> P.</div><span class="small text-gray">Puntaje calculado</span>
					</div>
					<div class="col-6">
						<div class="h4 font-weight-bold mb-0"><?= $data["score_qualified"]["value"] ?></div><span class="small text-gray"><?= $data["score_qualified"]["type"] ?></span>
					</div>
				</div>
				<!-- END -->
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 mb-4">
			<div class="bg-white rounded-lg p-5 shadow">
				<h2 class="h6 font-weight-bold text-center mb-4">Mapa relacional</h2>
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
		<div class="col-xl-4 col-lg-4 mb-4">
			<div class="bg-white rounded-lg p-5 shadow">
				<h2 class="h6 font-weight-bold text-center mb-4">Conteo de eventos</h2>
				<?php foreach($data['event_score'] as $event): ?>
				<div class="row m-2">
					<div class="col-6 text-right">
						<span>
							<?= $event['event'] ?>
						</span>
					</div>
					<div class="col-6 badge bg-primary">
						<span class="">
							<?= $event['score'] ?>
						</span>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<!-- FORUMULARIO DE EDICION DE KRIS -->
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/kri/update/<?= $kri['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-body">
				<div class="card-title">
					<h5><b><?=$kri['master_id']?> | </b><?=$kri['kri']?></h5>
				</div>
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
								<div id="events">
									<?php  foreach($data["events"] as $event): ?>
									<div>
										<input type="checkbox" name="event[]" value="<?= $event['id'] ?>" class="btn-check" id="<?= $event['event'] ?>" autocomplete="off" checked>
										<label class="btn btn-sm btn-outline-danger my-2 form-control" for="<?= $event['event'] ?>"><span class="badge bg-secondary">[<?= $event['id'] ?>]</span><?= $event['event'] ?> </label>
										<!-- </div> -->
										<!-- <div class="form-check"> -->
										<!-- 	<input type="checkbox" checked id="<?= $event['event'] ?>" value="<?= $event['id'] ?>" name="event[]" class="form-check-input"> -->
										<!-- 	<label class="form-check-label" for="<?= $event['event'] ?>"><?= $event['id']." | ".$event['event'] ?></label> -->
										</div>
										<?php  endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					<!-- QUALIFIERS -->
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#threshold-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
								Umbrales	
							</button>
						</h2>
						<div id="threshold-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div id="thresholds">
								<?php  foreach($data["thresholds"] as $threshold): ?>
								<div class="input-group mb-3">
									<div class="form-floating">
										<input type="text" value="<?= $threshold['type'] ?>" class="form-control" name="threshold[]" id="floatingInputGroup1">
										<label for="floatingInputGroup1">Nombre del umbral</label>
									</div>
									<div class="form-floating">
										<input type="text" class="form-control" value="<?= $threshold['value'] ?>" name="threshold_value[]" id="floatingInputGroup1">
										<label for="floatingInputGroup1">Valor</label>
									</div>
								</div>
								<?php  endforeach; ?>
							</div>
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
				<div>
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
	function customFunction(e){
		console.log(e)
		kris = document.getElementById("events")
		html = kris.innerHTML
		html += "<div><input name='event[]' value='"+e.id+"' type='checkbox' class='btn-check' id='"+e.event+"' autocomplete='off' checked><label class='btn btn-sm btn-outline-danger my-2 form-control' for='"+e.event+"'><span class='badge bg-danger'>["+e.id+"]</span>"+e.event+"</label></div>"
		kris.innerHTML = html
		modal = document.getElementById("addKri")
		modal.hide()
	}
	function addQualifier(){
		thresholds_list = document.getElementById("thresholds")
		html = ' <div class="input-group mb-3"> <div class="form-floating"> <input type="text" class="form-control" name="threshold[]" id="floatingInputGroup1"> <label for="floatingInputGroup1">Nombre Calificador</label> </div> <div class="form-floating"> <input type="text" class="form-control" name="thresholds_values[]" id="floatingInputGroup1"> <label for="floatingInputGroup1">Valor</label> </div> </div> '
		thresholds_list.insertAdjacentHTML("beforeend",html)
	}
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
	searchEvent({
		componentEvent: "searchEvent",
		listOptions: "datalistOptionsEvent",
		search: "event",
		components: new Map([
			["id","master_id"],
			["event","event"],
		]),
		value: "event",
		table: "events",
		tag: "button",
		customFunction: "customFunction",
		class: "btn btn-outline-primary form-control m-2' data-bs-dismiss='modal",
	})
</script>

