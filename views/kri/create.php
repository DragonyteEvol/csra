<?php  
include_once("components/header.php");
?>
<!-- FORMULARIO DE CREACION DE KRIS -->
<div class="container">
	<form action="/kri/insert" method="POST" class="needs-validation">
		<div class="bg-white rounded-lg p-5 shadow my-3">
			<div class="card-body">
				<div class="card-tittle">
					<h5>Creacion de KRI</h5>
				</div>
				<!-- KRI -->
				<div class="form-floating mb-3">
					<input type="text"Crear KRI required class="form-control" name="kri" id="floatingInput" placeholder="Insegra un nombre">
					<label for="floatingInput">Nombre del KRI</label>
				</div>
				<!-- OBJECTIVO -->
				<div class="form-floating">
					<textarea class="form-control mb-3" name="objective" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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
						<!-- SYNTAX-->
						<div class="form-floating mb-3">
							<input name="syntax" type="text" class="form-control disabled">
							<label for="floatingInput">Sintaxis / Operacion de kri</label>
						</div>
					</div>
				</div>
				<!-- EVENTOS -->
				<button name="events" type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Añadir evento
				</button>
				<select name="event[]" id="events" class="form-select mb-3" multiple>
				</select>
				<!-- UMBRALES -->
				<?php  foreach($data["qualifiers"] as $qualifiers): ?>
				<div class="input-group mb-3">
					<div class="form-floating">
						<input type="text" disabled value="<?= $qualifiers['qualifier'] ?>" class="form-control" name="thresholds[]" id="floatingInputGroup1">
						<label for="floatingInputGroup1">Nombre del umbral</label>
					</div>
					<div class="form-floating">
						<input type="text" class="form-control" name="thresholds_values[]" id="floatingInputGroup1">
						<label for="floatingInputGroup1">Valor</label>
					</div>
				</div>
				<?php  endforeach; ?>

				<div class="card-footer">
					<!-- END FIELD -->
					<button type="submit" class="btn btn-primary">Enviar</button>
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

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="/assets/js/search.js"></script>
<script>
	function customFunction(e){
		console.log(e)
		events = document.getElementById("events")
		html = events.innerHTML
		html += "<option selected value=" + e.id + ">["+e.id+"]."+e.event+"</option>"
		events.innerHTML = html
		modal = document.getElementById("exampleModal")
		modal.hide()
	}
	//PROPIEDADES
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
	//EVENTOS
	searchEvent({
		componentEvent: "searchEvent",
		listOptions: "datalistOptionsEvent",
		search: "event",
		components: new Map([
			["id","master_id"],
			["event","event"]
		]),
		value: "event",
		table: "events",
		tag: "button",
		customFunction: "customFunction",
		class: "btn btn-outline-primary form-control m-2' data-bs-dismiss='modal",
	})
</script>
