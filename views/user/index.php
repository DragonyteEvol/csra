<?php  
include_once("components/header.php");
?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="input-group mb-3">
						<input id="search" type="text" class="form-control" placeholder="Buscar usuario" aria-label="Example text with button addon" aria-describedby="button-addon1">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
*
</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-borderless">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Usuario</th>
				<th scope="col">Email</th>
				<th scope="col">Rol</th>
				<th scope="col">Fecha de creacion</th>
			</tr>
		</thead>
		<tbody id="types">
			<?php  foreach($data["users"] as $user): ?>
			<tr>
				<th scope="row"><?= $user["id_master"] ?></th>
				<td>
					<a href="/user/show/<?= $user['id_master'] ?>">
						<?= $user["name"] ?>
					</a>
				</td>
				<td><?= $user["email"] ?></td>
				<td><?= $user["role"] ?></td>
				<td><?= $user["created_at"] ?></td>
			</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
</div>
