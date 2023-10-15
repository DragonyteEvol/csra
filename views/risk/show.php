<?php  
include_once("components/header.php");
?>
<div class="container">
	
	<!-- ----------------------------------- -->
	<div class="card">
		<form action="/risk/update" method="POST" class="needs-validation">
			<?php foreach($data["risks"] as $risk): ?>
			<div class="row">
				<div class="col-xl-4 col-lg-6 mb-4">
					<div class="bg-white rounded-lg p-5 shadow">
						<h2 class="h6 font-weight-bold text-center mb-4">Valoración del Riesgo</h2>
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
				<div class="col-xl-8 col-lg-8 mb-8">
					<div class="bg-white rounded-lg p-5 shadow">
						<h2 class="h6 font-weight-bold text-center mb-4">Mapa relacional</h2>
						<div class="row align-items-center my-2">
							<div class="col-4">
								<button class="btn btn-outline-dark btn-sm form-control">
									<?= $risk["risk"] ?>
								</button>
							</div>
							<div class="col-4">
								<?php  foreach($data["kris"] as $kri): ?>
								<button class="btn btn-outline-dark btn-sm form-control my-2" data-bs-toggle="popover" data-bs-title="Descripcion del evento" data-bs-content="">
									<?= $kri["kri"]?>
								</button>
								<?php  endforeach; ?>
							</div>
							<div class="col-4">
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
			<!-- PRIMERA FILA -->
			<div class="card-header">
				<h5><b><?=$risk['master_id']?> | </b><?=$risk['risk']?></h5>
			</div>
			<div class="card-body">
				<!-- KRI -->
				<div class="form-floating mb-3">
					<input type="text" value="<?= $risk['risk'] ?>" required class="form-control" name="risk" id="floatingInput" placeholder="Insegra un nombre">
					<label for="floatingInput">Nombre del riesgo</label>
				</div>
				<div class="row">
					<div class="col-6">
						<!-- PROPIEDAD -->
						<div class="form-floating mb-3">
							<select name="propertie_id" class="form-select" id="datalistOptions" aria-label="">
								<option value="<?= $risk['propertie_id'] ?>" selected><?= $risk['propertie']?></option>
							</select>
							<label for="floatingSelect">Propiedad</label>
						</div>
					</div>
					<div class="col-6">
						<!-- TIPO -->
						<div class="form-floating mb-3">
							<select name="propertie_id" class="form-select" id="datalistOptions" aria-label="">
								<option value="<?= $risk['type_id'] ?>" selected><?= $risk['type']?></option>
							</select>
							<label for="floatingSelect">Tipo</label>
						</div>
					</div>
				</div>
				<div class="accordion accordion-flush" id="accordionFlushExample">
					<!-- KRI -->
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#event-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
								KRIs	
							</button>
						</h2>
						<div id="event-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div class="my-2">
								<button name="events" type="button" class="form-control btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addKri">
									Añadir KRI
								</button>
								<div class="form-check" id="kris"> 
									<?php  foreach($data["kris"] as $kri): ?>
									<div>
										<input type="checkbox" name="kris[]" value="<?= $kri['id'] ?>" class="btn-check" id="<?= $kri['kri'] ?>" autocomplete="off" checked>
										<label class="btn btn-sm btn-outline-danger my-2 form-control" for="<?= $kri['kri'] ?>"><?= $kri['kri'] ?> <span class="badge bg-secondary"><?= $kri['percentage'] ?>%</span></label>
									</div>
									<?php  endforeach; ?>
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
		</form>
				</div>
			</div>
			<!-- FORMULARIO DE ADICION DE KRIS -->
			<div class="modal fade" id="addKri" tabindex="-1" aria-labelledby="addKriLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="addKriLabel">Buscar Evento</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-floating mb-3">
								<input type="text" required class="form-control" id="searchKRI" placeholder="Insegra un nombre">
								<label for="floatingInput">Buscar evento</label>
							</div>
							<div class="justify-content-center" id="datalistOptionsKRI">
							</div>
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
		kris = document.getElementById("kris")
		html = kris.innerHTML
		html += "<div><input name='kri[]' value='"+e.id+"' type='checkbox' class='btn-check' id='"+e.kri+"' autocomplete='off' checked><label class='btn btn-sm btn-outline-danger my-2 form-control' for='"+e.kri+"'>"+e.kri+" <span class='badge bg-secondary'>"+e.percentage+"%</span></label></div>"
		kris.innerHTML = html
		modal = document.getElementById("addKri")
		modal.hide()
	}
	//EVENTOS
	searchEvent({
		componentEvent: "searchKRI",
		listOptions: "datalistOptionsKRI",
		search: "kri",
		components: new Map([
			["id","master_id"],
			["kri","kri"],
			["percentage","percentage"]
		]),
		value: "kri",
		table: "kris",
		tag: "button",
		customFunction: "customFunction",
		class: "btn btn-outline-primary form-control m-2' data-bs-dismiss='modal",
	})
</script>
