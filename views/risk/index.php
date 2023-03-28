<?php  
include_once("components/header.php");
?>

<table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Riesgo</th>
      <th scope="col">Propiedad</th>
      <th scope="col">Tipo</th>
    </tr>
  </thead>
  <tbody>
	  <?php  foreach($data as $risk): ?>
	  <tr>
		  <th scope="row"><?= $risk["id_master"] ?></th>
		  <td><?= $risk["risk"] ?></td>
		  <td><?= $risk["propertie"] ?></td>
		  <td><?= $risk["type"] ?></td>
	  </tr>
	  <?php  endforeach; ?>
  </tbody>
</table>