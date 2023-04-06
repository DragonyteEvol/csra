<?php  
include_once("components/header.php");
var_dump($data);
?>
<form>
<?php foreach($data["kris"] as $risk): ?>
<input type="text" name="" class="form-control" value="<?= $risk['risk'] ?>"
<?php endforeach; ?>
</form>
