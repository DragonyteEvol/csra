<?php  
include_once("components/header.php");
?>
<!-- FORMULARIO DE CREACION DE eventS -->
<div class="container">
	<?php  foreach($data["events"] as $event): ?>
	<!-- FECHAS INPUTS -->
	<div class="row my-2">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<input class="form-control bg-white rounded-lg shadow" id="from" name="from" type="date">
				</div>
				<div class="col-6">
					<div class="input-group">
						<input class="form-control d-flex bg-white rounded-lg shadow" id="to" name="to" type="date">
						<button onclick="redirect('kri',<?= $kri["master_id"] ?>,'from','to')" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787a5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0a4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501a6.921 6.921 0 0 0-1.315-.408a7.079 7.079 0 0 0-2.819 0a6.94 6.94 0 0 0-1.316.409a7.04 7.04 0 0 0-3.08 2.534a6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4l4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138a4.943 4.943 0 0 1-1.787.752a5.073 5.073 0 0 1-2.017 0a4.956 4.956 0 0 1-1.787-.752a5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0a7.031 7.031 0 0 0 4.395-2.945a6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4l-4 4z"/></svg></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FORMULARIO -->
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<form action="/event/update/<?= $event['master_id'] ?>" method="POST" class="needs-validation">
				<div class="bg-white rounded-lg shadow card my-5 border border-light">
					<div class="card-body">

						<div class="card-title">
							<h5><b><?=$event['master_id']?> | </b><?=$event['event']?></h5>
						</div>
						<!-- EVENTO -->
						<div class="form-floating mb-3">
							<input type="text" value="<?= $event['event'] ?>" required class="form-control" name="event" id="floatingInput" placeholder="Insegra un nombre">
							<label for="floatingInput">Nombre del evento</label>
						</div>
						<div class="row">
							<div class="col-4">
								<!-- TIPO -->
								<div class="form-floating mb-3">
									<select name="type" class="form-select" id="datalistOptions" aria-label="">
										<option value="automatic">automatic</option>
										<option value="manual">manual</option>
									</select>
									<label for="floatingSelect">Tipo de evento</label>
								</div>
							</div>
							<div class="col-4">
								<!-- FUENTE ID OSIEM -->
								<div class="form-floating mb-3">
									<input name="source_id" type="number" value="<?= $event['source_id'] ?>" class="form-control">
									<label for="floatingInput">Fuente OSIEM</label>
								</div>
							</div>
							<div class="col-4">
								<!-- EVENT ID-->
								<div class="form-floating mb-3">
									<input name="event_id" type="number" value="<?= $event['event_id'] ?>" class="form-control">
									<label for="floatingInput">Evento OSIEM</label>
								</div>
							</div>
						</div>
						<!-- END FIELD -->
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
		<div class="col-lg-3 col-sm-12 mb-4 my-5">
			<div class="bg-white rounded-lg p-5 shadow">
				<h2 class="h6 font-weight-bold text-center mb-4">Puntuación del evento</h2>
				<!-- Progress bar 1 -->
				<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar" style="width: 55%"><?= $event['score'] ?></div>
				</div>
				<!-- END -->
				<!-- Demo info -->
				<div class="row text-center mt-4">
					<div class="col-12">
						<span class="small text-gray">Conteo de apariciones</span>
					</div>
				</div>
				<!-- END -->
			</div>
		</div>
	</div>
	<?php  endforeach; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
