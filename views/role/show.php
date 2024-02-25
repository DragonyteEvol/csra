<?php  
include_once("components/header.php");
?>
<div class="container">
	<?php  foreach($data["roles"] as $role): ?>
	<div class="card bg-white rounded-lg shadow card my-5 border border-light">
		<form action="/role/update/<?= $role['master_id'] ?>" method="POST" class="needs-validation">
			<div class="card-title">
				<h5><b><?=$role['master_id']?> | </b><?=$role['role']?></h5>
			</div>
			<div class="card-body">
				<!-- ROL -->
				
				<div class="form-floating mb-3">
					<input type="text" value="<?= $role['role'] ?>" required class="form-control" name="role" id="floatingInput" placeholder="Ingresa un nombre">
					<label for="floatingInput">Nombre del rol</label>
				</div>
				<!-- TABLA DE MODULOSP --> 
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Modulo</th>
							<th scope="col">Insertar</th>
							<th scope="col">Leer</th>
							<th scope="col">Modificar</th>
							<th scope="col">Borrar</th>
						</tr>
					</thead>
					<tbody id="modules">
						<?php  foreach($data["modules"] as $module): ?>
						<tr>
							<!-- MODULO -->
							<th scope="row"><?= $module["id_master"] ?>
								<div class="input-group">
									<input value="<?= $module['id'] ?>" type="checkbox" class="btn-check input-group-text" id="<?= $module['module'] ?>" autocomplete='off' checked>
									<label class='btn btn btn-outline-primary form-control' for="<?= $module['module'] ?>"><?= $module['module'] ?></label>
								</div>
							</th>
							<!-- C -->
							<td>
								<div class="form-check form-switch">
									<input name="<?= $module['module'] ?>W" class="form-check-input" type="checkbox" role="switch" <?= $module["w"] ? "checked" : "" ?>>
								</div>
							</td>
							<!-- R -->
							<td>
								<div class="form-check form-switch">
									<input name="<?= $module['module'] ?>R" class="form-check-input" type="checkbox" role="switch" <?= $module["r"] ? "checked" : "" ?>>
								</div>
							</td>
							<!-- U -->
							<td>
								<div class="form-check form-switch">
									<input name="<?= $module['module'] ?>U" class="form-check-input" type="checkbox" role="switch" <?= $module["u"] ? "checked" : "" ?>>
								</div>
							</td>
							<!-- D -->
							<td>
								<div class="form-check form-switch">
									<input name="<?= $module['module'] ?>D" class="form-check-input" type="checkbox" role="switch" <?= $module["d"] ? "checked" : "" ?>>
								</div>
							</td>
						</tr>
						<?php  endforeach; ?>
					</tbody>
				</table>
				<div class="card-footer">
					<div class="row">
						<div class="col-6">
							<a class="btn btn-outline-danger form-control" href="/role/delete/<?= $role['master_id'] ?>">Eliminar</a>
						</div>
						<div class="col-6">
							<button type="submit" class="btn btn-primary form-control">Actualizar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php  endforeach; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="/assets/js/search.js"></script>
<script>
	//EVENTOS
	searchEvent({
		componentEvent: "searchModule",
		listOptions: "datalistOptionsModule",
		search: "module",
		components: new Map([
			["id","master_id"],
			["module","module"],
		]),
		value: "module",
		table: "modules",
		tag: "button",
		customFunction: "customFunction",
		class: "btn btn-outline-primary form-control m-2' data-bs-dismiss='modal",
	})
</script>

