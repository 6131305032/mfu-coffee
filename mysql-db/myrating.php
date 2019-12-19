  
  <?php session_start();
    print_r($_SESSION);    
  ?>
  <!--Include Header -->
  <?php include_once 'header.php'; ?>
    
    <!-- connect database to web -->
    <?php
    $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
    $userid = $_SESSION['userid'];
    $result = $mysqli->query(
        "SELECT * FROM user, flavorchart, rating
        WHERE
	        userid = user_userid
        AND
            user_userid =  $userid
        and 
        flavorid = flavorchart_flavorid"

    ) or die(mysqli_error($mysqli));
    ?>


  <div class="container-fluid">
        
        <div class="row justify-center">
            <div class="col-4"> </div>

            <div class="col-8-pt-4">
                <h1>Rating History for <?php echo $_SESSION['useravatar']; echo $_SESSION['username'];?></h1>
                <table class="table table-hover">
                <thead>
                        <tr>
                            <th></th>
                            <th>Rating</th>
                            <th>Comments</th>
                            <th>Flavor</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td></td>
                            
                        <td><?php 
                            $score =  $row['ratingscore']; 
                            $stars = $score/2;
                            for ($x = 0; $x <$stars; $x++){
                            echo '⭐';
                            }
                    ?></td>
                    <td><?php echo $row['ratingnotes']; ?></td>
                    <td><?php echo $row['flavoricon']; echo $row['flavorname']; ?></td>
                    <td><?php echo $row['ratingdate']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                
                </table>
                </div>
                <div class="col-4"> </div>
        </div>
  </div>