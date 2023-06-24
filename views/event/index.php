<?php  
include_once("components/header.php");
?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="input-group mb-3">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
	+
</button>
						<input id="searchEvent" type="text" class="form-control" placeholder="Buscar evento" aria-label="Example text with button addon" aria-describedby="button-addon1">
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-6">
						<input class="form-control" name="from" type="datetime-local">
					</div>
					<div class="col-6">
						<input class="form-control d-flex" name="to" type="datetime-local">
					</div>
				</div>
			</div>
		</div>
	</div>

	<table class="table table-borderless">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Evento</th>
				<th scope="col">Tipo</th>
			</tr>
		</thead>
		<tbody id="events">
			<?php  foreach($data["events"] as $risk): ?>
			<tr>
				<th scope="row"><?= $risk["id_master"] ?></th>
				<td>
					<a class="link-dark" href="/event/show/<?= $risk['id_master'] ?>">
						<?= $risk["event"] ?>
					</a>
				</td>
				<td><?= $risk["propertie"] ?></td>
				<td><?= $risk["type"] ?></td>
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
<!-- ///////////////// -->
<!-- Formulario modal para creacion de eventos --> 
<div id="modalCreate" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Crear evento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- formulario de inicio de sesion -->
				<form action="/event/insert" method="POST" class="needs-validation">
					<!-- TEMPLATE -->
					<div class="form-floating mb-3">
						<input type="text" class="form-control" list="datalistOptions" id="template" placeholder="Type to search...">
						<datalist id="datalistOptions">
						</datalist>
						<label for="floatingInput">Selecciona y busca una platilla</label>
					</div>

					<!-- NOMBRE -->
					<div class="form-floating mb-3">
						<input type="text" required class="form-control" name="event" id="floatingInput" placeholder="Insegra un nombre">
						<label for="floatingInput">Ingresa un nombre</label>
					</div>
					<!-- TIPO DE EVENTO -->
					<div class="form-floating mb-3">
						<select name="type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
							<option selected value="automatic">Automatico</option>
							<option value="manual">Manual</option>
						</select>
						<label for="floatingSelect">Tipo de evento</label>
					</div>
					<!-- ID DE LA FUENTE -->
					<div class="form-floating mb-3">
						<input type="text" name="source_id" class="form-control disabled" id="source_id">
						<label for="floatingInput">ID de la fuente</label>
					</div>
					<!-- IDE DEL EVENTO -->
					<div class="form-floating mb-3">
						<input name="event_id" type="text" class="form-control disabled" id="event_id">
						<label for="floatingInput">ID del evento</label>
					</div>
					<!-- FUENTE -->
					<div class="form-floating mb-3">
						<input type="text" disabled class="form-control" id="source">
						<label for="floatingInput">Fuente</label>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="assets/js/search.js"></script>
<script>
	/* searchEvent({ */
	/* componentEvent: "template", */
	/* 	listOptions: "datalistOptions", */
	/* 	search: "template", */
	/* 	components: new Map([ */
	/* 		["source_id","plugin_id"], */
	/* 		["source","vendor"], */
	/* 		["event_id","sid"] */
	/* 	]), */
	/* 	value: "name" */
	/* }) */
	searchEvent({
		componentEvent: "template",
		listOptions: "datalistOptions",
		search: "template",
		components: new Map([
			["source_id","plugin_id"],
			["source","vendor"],
			["event_id","sid"]
		]),
		value: "name",
		table: "plugin_sid",
		tag: "option"
	})
	searchTable({
		componentEvent: "searchEvent",
		listOptions: "events",
		search: "event",
		components: [
			"type",
		],
		value: "event",
		table: "events",
	})
</script>
</script>
