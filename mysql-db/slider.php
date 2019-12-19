   <?php $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli)); 
   $result = $mysqli->query(
   	"select * from flavorchart")or die(mysqli_error($mysqli));
   ?>
    <?php include_once 'header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-3">
		</div>
		<div class="col-6">
			<form>
  <div class="form-group">

    <label for="formControlRange">Example Range input</label>
    <input type="range" type="range" min="1" max="5" value="1" class="form-control-range" id="slider">
    <h3 id="flavorid">

    </h3>
      <?php while ($row = $result->fetch_assoc()) : ?>
      	<div id="<?php echo $row['flavorid']?>">
      		<?php echo $row['flavorname']?>
      	<?php echo $row['flavoricon']?>

      	</div><?php endwhile; ?>
  </div>
</form>
		</div>
		<div class="col-3">
		</div>
	</div>
</div>

<script>
var slider = document.getElementById("slider");
var output = document.getElementById("flavorid");
output.innerHTML = document.getElementById("1").innerHTML;

slider.oninput = function() {
  output.innerHTML = document.getElementById(this.value).innerHTML;
}
</script>