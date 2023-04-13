<?php  
include_once("components/header.php");
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
	X
</button>
<table class="table table-borderless">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">KRI</th>
			<th scope="col">Objetivo</th>
			<th scope="col">Propiedad</th>
			<th scope="col">Porcentage</th>
			<th scope="col">Calculo</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($data["kris"] as $kri): ?>
		<tr>
			<th scope="row"><?= $kri["id_master"] ?></th>
			<td>
				<a href="/kri/show/<?= $kri['id_master'] ?>">
					<?= $kri["kri"] ?>
				</a>
			</td>
			<td><?= $kri["objective"] ?></td>
			<td><?= $kri["propertie"] ?></td>
			<td><?= $kri["percentage"] ?>%</td>
			<td><?= $kri["syntax"] ?></td>
		</tr>
		<?php  endforeach; ?>
	</tbody>
</table>

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
				<form action="/event/create" method="POST" class="needs-validation">

					<!-- KRI -->
					<div class="form-floating mb-3">
						<input type="text" required class="form-control" name="kri" id="floatingInput" placeholder="Insegra un nombre">
						<label for="floatingInput">Nombre del KRI</label>
					</div>
					<!-- OBJECTIVO -->
					<div class="form-floating">
						<textarea class="form-control mb-3" name="objective" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
						<label for="floatingTextarea2">Objetivo</label>
					</div>
					<!-- ID DE LA FUENTE -->
					<div class="form-floating mb-3">
						<input type="number" required class="form-control" name="kri" id="floatingInput" placeholder="Insegra un nombre">
						<label for="floatingInput">Porcentaje</label>
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
					<!-- asldkfjaslkdfj -->
					<select class="form-select" multiple data-mdb-filter="true">
						<option onclick="pepe()" value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
						<option value="4">Four</option>
						<option value="5">Five</option>
						<option value="6">Six</option>
						<option value="7">Seven</option>
						<option value="8">Eight</option>
						<option value="9">Nine</option>
						<option value="10">Ten</option>
					</select>
					<!-- /// -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function pepe(){
		console.log("OK")
	}
</script>
