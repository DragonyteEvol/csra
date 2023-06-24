<?php  
include_once("components/header.php");
?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="input-group mb-3">
						<a href="/kri/create" class="btn btn-primary" type="button" id="button-addon1">+</a>
						<input id="search" type="text" class="form-control" placeholder="Buscar propiedades" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
				<th scope="col">Propiedad</th>
				<th scope="col">Fecha de creacion</th>
			</tr>
		</thead>
		<tbody id="properties">
			<?php  foreach($data["properties"] as $kri): ?>
			<tr>
				<th scope="row"><?= $kri["id_master"] ?></th>
				<td>
					<a href="/propertie/show/<?= $kri['id_master'] ?>">
						<?= $kri["propertie"] ?>
					</a>
				</td>
				<td><?= $kri["created_at"] ?></td>
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="assets/js/search.js"></script>
<script>
searchTable({
	componentEvent: "search",
	listOptions: "properties",
	search: "propertie",
	components: [
		"created_at"
	],
	value: "propertie",
	table: "properties",
})
</script>
</script>
