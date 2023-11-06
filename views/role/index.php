<?php  
include_once("components/header.php");
?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="input-group mb-3">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
							+
						</button>

						<input id="search" type="text" class="form-control" placeholder="Buscar tipos" aria-label="Example text with button addon" aria-describedby="button-addon1">
					</div>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-borderless">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Rol</th>
				<th scope="col">Fecha de creacion</th>
			</tr>
		</thead>
		<tbody id="roles">
			<?php  foreach($data["roles"] as $role): ?>
			<tr>
				<th scope="row"><?= $role["id_master"] ?></th>
				<td>
					<a href="/role/show/<?= $role['id_master'] ?>">
						<?= $role["role"] ?>
					</a>
				</td>
				<td><?= $role["value"] ?></td>
				<td><?= $role["created_at"] ?></td>
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
<!-- FORMULARIO PARA CREACION DE PROPIEDADES -->
<div id="modalCreate" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Crear calificador</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="/role/insert" method="POST" class="needs-validation">
					<!-- NOMBRE -->
					<div class="form-floating mb-3">
						<input type="text" required class="form-control" name="role" id="floatingInput" placeholder="Ingresa un nombre">
						<label for="floatingInput">Ingresa un nombre de rol</label>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary form-control">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="assets/js/search.js"></script>
<script>
	searchTable({
		componentEvent: "search",
		listOptions: "roles",
		search: "role",
		components: [
			"created_at"
		],
		value: "role",
		table: "roles",
	})
</script>
