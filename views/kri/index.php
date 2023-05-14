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
						<input type="text" class="form-control" placeholder="Buscar Kri" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
				<th scope="col">KRI</th>
				<th scope="col">Objetivo</th>
				<th scope="col">Propiedad</th>
				<th scope="col">Porcentage</th>
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
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
