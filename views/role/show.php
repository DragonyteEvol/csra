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
									<input name='<?=$module["module"]?>[]' value="<?= $module['id'] ?>" type="checkbox" class="btn-check input-group-text" id="<?= $module['module'] ?>" autocomplete='off' checked>
									<label class='btn btn btn-outline-primary form-control' for="<?= $module['module'] ?>"><?= $module['module'] ?></label>
								</div>
							</th>
							<!-- C -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
								</div>
							</td>
							<!-- R -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
								</div>
							</td>
							<!-- U -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
								</div>
							</td>
							<!-- D -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
								</div>
							</td>
						</tr>
						<?php  endforeach; ?>
					</tbody>
				</table>
				<button name="events" type="button" class="form-control btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModule">
					Añadir Modulo	
				</button>
				<div class="card-footer">
					<div class="row">
						<div class="col-6">
							<button type="reset" class="btn btn-outline-secondary form-control">Limpiar</button>
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
	<!-- FORMULARIO DE ADICION DE MODULOS -->
	<div class="modal fade" id="addModule" tabindex="-1" aria-labelledby="addModuleLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="addModuleLabel">Buscar Modulo</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-floating mb-3">
						<input type="text" required class="form-control" id="searchModule" placeholder="Insegra un nombre">
						<label for="floatingInput">Buscar...</label>
					</div>
					<div class="justify-content-center" id="datalistOptionsModule">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="/assets/js/search.js"></script>
<script>
	function customFunction(e){
		console.log(e)
		Modules = document.getElementById("modules")
		html = Modules.innerHTML
		html+=
`
<tr>
							<th scope="row">
								<div class="input-group">
									<input name='${e.module}[]' value="${e.id}" type="checkbox" class="btn-check input-group-text" id="${e.module}" autocomplete='off' checked>
									<label class='btn btn btn-outline-primary form-control' for="${e.module}}">${e.module}</label>
								</div>
							</th>
							<!-- C -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
								</div>
							</td>
							<!-- R -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
								</div>
							</td>
							<!-- U -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
								</div>
							</td>
							<!-- D -->
							<td>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
								</div>
							</td>
						</tr>
`
		Modules.innerHTML = html
		modal = document.getElementById("addModule")
		modal.hide()
	}
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

