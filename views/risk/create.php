<?php  
include_once("components/header.php");
?>
<div class="container">
	
	<!-- ----------------------------------- -->
	<div class="card">
		<form action="/risk/insert" method="POST" class="needs-validation">
			<!-- PRIMERA FILA -->
			<div class="card-header">
				<h5>Crear Riesgo</h5>
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
							<select name="propertie_id" class="form-select" id="datalistOptionsType" aria-label="">
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<!-- END FIELD -->
					<div class="row">
						<div class="col-6">
							<button type="reset" class="btn btn-outline-secondary form-control">Limpiar</button>
						</div>
						<div class="col-6">
							<button type="submit" class="btn btn-primary form-control">Enviar</button>
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
