   <?php $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli)); 
   $result = $mysqli->query(
   	"select * from flavorchart")or die(mysqli_error($mysqli));
   ?>

  <div class="form-group">

    <label for="formControlRange">Choose the flavor that best describes this coffee:</label>
    <input type="range" type="range" min="1" max="5" value="1" class="form-control-range" id="slider" name="flavorid">
    <h3 id="flavorid">

    </h3>
      <?php while ($row = $result->fetch_assoc()) : ?>
      	<div class="d-none" id="<?php echo $row['flavorid']?>">
      		<?php echo $row['flavorname']?>
      	<?php echo $row['flavoricon']?>

		  </div>
		  <?php endwhile; ?>
  </div>


<script>
var slider = document.getElementById("slider");
var output = document.getElementById("flavorid");
output.innerHTML = document.getElementById("1").innerHTML;

slider.oninput = function() {
  output.innerHTML = document.getElementById(this.value).innerHTML;
}
</script>