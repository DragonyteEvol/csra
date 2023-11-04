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
						<input id="search" type="text" class="form-control" placeholder="Buscar Kri" aria-label="Example text with button addon" aria-describedby="button-addon1">
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-6">
						<input class="form-control" id="from" name="from" type="date">
					</div>
					<div class="col-6">
						<input class="form-control d-flex" id="to" name="to" type="date">
					</div>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-borderless">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">KRI</th>
				<th scope="col">Objetivo</th>
				<th scope="col">Propiedad</th>
				<th scope="col">Fecha Creacion</th>
				<th scope="col">Monitoreo</th>
			</tr>
		</thead>
		<tbody id="kris">
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
				<td><?= $kri["created_at"] ?></td>
				<td><button class="btn btn-primary">º</button></td>
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
	listOptions: "kris",
	search: "kri",
	components: [
		"objective",
		"propertie",
		"percentage"
	],
	value: "kri",
	table: "kris",
})
</script>
</script>
