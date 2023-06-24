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

						<input id="search" type="text" class="form-control" placeholder="Buscar tipos" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
				<th scope="col">Tipo</th>
				<th scope="col">Fecha de creacion</th>
			</tr>
		</thead>
		<tbody id="types">
			<?php  foreach($data["types"] as $kri): ?>
			<tr>
				<th scope="row"><?= $kri["id_master"] ?></th>
				<td>
					<a href="/type/show/<?= $kri['id_master'] ?>">
						<?= $kri["type"] ?>
					</a>
				</td>
				<td><?= $kri["created_at"] ?></td>
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
<div id="modalCreate" class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
...
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="assets/js/search.js"></script>
<script>
searchTable({
componentEvent: "search",
	listOptions: "types",
	search: "type",
	components: [
		"created_at"
	],
	value: "type",
	table: "types",
})
</script>
</script>
