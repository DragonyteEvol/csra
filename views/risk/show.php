<?php  
include_once("components/header.php");
?>
<div class="container">
	<!-- ----------------------------------- -->
	<?php foreach($data["risks"] as $risk): ?>
	<!-- FECHAS -->
	<div class="row my-2">
		<div class="col-12">
			<div class="row">
				<div class="col-5">
					<input class="form-control" id="from" name="from" type="date">
				</div>
				<div class="col-5">
					<input class="form-control d-flex" id="to" name="to" type="date">
				</div>
				<div class="col-2">
					<button onclick="redirect('risk',<?= $risk['master_id'] ?>,'from','to')" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787a5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0a4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501a6.921 6.921 0 0 0-1.315-.408a7.079 7.079 0 0 0-2.819 0a6.94 6.94 0 0 0-1.316.409a7.04 7.04 0 0 0-3.08 2.534a6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4l4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138a4.943 4.943 0 0 1-1.787.752a5.073 5.073 0 0 1-2.017 0a4.956 4.956 0 0 1-1.787-.752a5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0a7.031 7.031 0 0 0 4.395-2.945a6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4l-4 4z"/></svg></button>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<form action="/risk/update/<?= $risk['master_id'] ?>" method="POST" class="needs-validation">
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
							<select name="propertie_id" class="form-select" id="datalistOptionsProperty" aria-label="">
							</select>
							<label for="floatingSelect">Propiedad</label>
						</div>
					</div>
					<div class="col-6">
						<!-- TIPO -->
						<div class="form-floating mb-3">
							<select name="type_id" class="form-select" id="datalistOptionsType" aria-label="">
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
										<input type="checkbox" name="kri[]" value="<?= $kri['id'] ?>" class="btn-check" id="<?= $kri['kri'] ?>" autocomplete="off" checked>
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
	//PROPERTIES
	searchEvent({
		listOptions: "datalistOptionsProperty",
		search: "propertie",
		components: new Map([
			["value","id"]
		]),
		value: "propertie",
		table: "properties",
		tag: "option"
	})
	//TYPES
	searchEvent({
		listOptions: "datalistOptionsType",
		search: "type",
		components: new Map([
			["value","id"]
		]),
		value: "type",
		table: "types",
		tag: "option"
	})
</script>
