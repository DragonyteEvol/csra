<?php  
include_once("components/header.php");
?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="input-group mb-3">
						<a href="/risk/create" class="btn btn-primary" type="button" id="button-addon1">+</a>
						<input id="search" type="text" class="form-control" placeholder="Buscar riesgo" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
      <th scope="col">Riesgo</th>
      <th scope="col">Propiedad</th>
      <th scope="col">Tipo</th>
    </tr>
  </thead>
  <tbody id="risks">
	  <?php  foreach($data["risks"] as $risk): ?>
	  <tr>
		  <th scope="row"><?= $risk["id_master"] ?></th>
		  <td>
			  <a href="/risk/show/<?= $risk['id_master'] ?>">
			  <?= $risk["risk"] ?>
			  </a>
		  </td>
		  <td><?= $risk["propertie"] ?></td>
		  <td><?= $risk["type"] ?></td>
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
	listOptions: "risks",
	search: "risk",
	components: [
		"propertie",
		"type"
	],
	value: "risk",
	table: "risks",
})
</script>
</script>
