<!-- Start Session-->
<?php session_start() ?>
    
<!--Include Header -->
<?php include 'header.php'; ?>

<!-- Connect to mysql to display existing data -->
<?php 

$coffeeid=$_GET['viewcoffee'];
$coffeename=$_GET['coffeename'];

if ($coffeeid != NULL){

    $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
    $result = $mysqli->query(
        "SELECT *
        FROM rating, user, flavorchart
        WHERE coffee_coffeeid = $coffeeid
        AND user_userid = userid
        AND flavorchart_flavorid = flavorid"
    ) or die(mysqli_error($mysql));}
    else {    
        $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
        $result = $mysqli->query(
            "SELECT *
            FROM rating, user, flavorchart
            WHERE user_userid = userid
            AND flavorchart_flavorid = flavorid"
        ) or die(mysqli_error($mysql));
    } 
?>

    <!-- Body Container -->
    <div class="container-fluid">
        
        <!-- Body Row -->
        <div class="row justify-center">

            <!--Left Spacer -->
            <div class="col-sm-2">
            </div>

            <!--Main display area -->
            <div class="col-sm-8 pt-4">
                <h1>Ratings for <?php if (!$coffeename){echo 'All';} else {echo $coffeename;} ?> 
                    <button id="addRoaster" class="btn btn-success btn-lg" data-toggle="modal" data-target="#input-modal">+ Add New</button>
                </h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comments</th>
                            <th>Flavor</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <!-- While there is more data, echo it into the appropriate columns -->
                    <?php while ($row = $result->fetch_assoc()) : ?>

                        <tr>
                            <td><h2><?php echo $row['useravatar']; ?></h2></td>
                            <td><?php echo $row['username']; ?></td>
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
                <a class="btn btn-secondary" href="coffees.php" role="button">Go Back</a>

            <!-- TODO: Add/Edit/Delete Ratings functions -->
            
        </div> <!--End Row -->

        <!--Right Spacer -->
        <div class="col-sm-2">          
        </div> 

    </div> <!--End Body Container -->


    <!-- Modal -->
    <div class="modal fade" id="input-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Roaster Details</h5>
                    <button onclick="location.href='ratings.php'" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <!--Rating input Form -->
                <?php include_once('ratinginput.php'); ?>
                                    
                </div>
            </div>
        </div>
     </div><!-- End Modal -->
</body>
</html>
