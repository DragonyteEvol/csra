<?php  
include_once("components/header.php");
?>
<a href="/kri/create" class="btn pmd-btn-fab pmd-ripple-effect btn-secondary"><box-icon name='plus-medical' color='#ffffff'></box-icon></a>
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
<script>
	function pepe(){
		console.log("OK")
	}
</script>
