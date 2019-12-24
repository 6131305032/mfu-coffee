    <!-- Start Session-->
    <?php require_once 'coffeeprocess.php'; ?>

    <!--Include Header -->
    <?php include_once 'header.php'; ?>

    <!-- Connect to mysql to display existing data -->
    <?php
    $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
    $result = $mysqli->query(
        "SELECT *
        FROM coffee, roaster
        WHERE roasterid = roaster_roasterid"
    ) or die(mysqli_error($mysql));
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
                <h1>Coffees <button id="addBtn" class="btn btn-success btn-lg" data-toggle="modal" data-target="#input-modal">+ Add New</button></h1>
                <table class="table table-hover" id="mainTable">
                    <thead>
                        <tr>
                            <th>Coffee Name</th>
                            <th>Roaster</th>
                            <th>Origin</th>
                            <th>Variety</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                        <!-- While there is more data, echo it into the appropriate columns -->
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <!-- Set variables to send to next page -->
                        <?php $coffeeid = $row['coffeeid']; ?>
                        <?php $coffeename = $row['coffeename']; ?>                           
                            <td><?php echo $row['coffeename']; ?> <p></p>
                                <!-- View Ratings Button -->
                                <a href="ratings.php?viewcoffee=<?php echo $coffeeid ?>&coffeename=<?php echo $coffeename ?>" class="btn btn-outline-secondary">View Ratings</a></td>
                            <td><?php echo $row['roastername']; ?></td>
                            <td><?php echo $row['coffeeorigin']; ?></td>
                            <td><?php echo $row['coffeevariety']; ?></td>
                            <td><?php //Create new query to find and display AVG rating                   
                                    $rating = $mysqli->query(
                                        "SELECT ROUND(AVG(ratingscore),2) as rating from rating, coffee
                                    WHERE coffee_coffeeid = $coffeeid"
                                    );
                                    if ($row = $rating->fetch_assoc()) {
                                        echo $row['rating'];
                                    } else {
                                        echo '?';
                                    } ?>/10</td>

                            <!-- Display the Edit and Delete buttons & link them using unique id-->
                            <td>
                                <a href="coffees.php?edit=<?php echo $coffeeid; ?>" id="editBtn" class="btn btn-info btn-block">Edit</a>
                                <a href="coffeeprocess.php?delete=<?php echo $coffeeid; ?>" class="btn btn-danger btn-block">Delete</a>
                            </td>
                        </tr>                       
                    <?php endwhile; ?>
                    </tbody>
                </table>

            </div> 
            <!-- End Main display container -->
        </div>
        <!--End Row -->

        <!--Right Spacer -->
        <div class="col-sm-2">
        </div>

    </div>
    <!--End Body Container -->

    <!-- Modal -->
    <div class="modal fade" id="input-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Coffee Details</h5>
                    <button onclick="location.href='coffees.php'" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--User Input Form -->
                    <div class="container justify-center" id="user-input">
                        <form action="" method="post">
                            <div class="col-12 border pt-3 mx-auto">
                                <!-- hidden input so we can use unique $id to modify data in db-->
                                <input type="hidden" name="coffeeid" value="<?php echo $selected ?>">
                                <input type="hidden" name="roasterid" value="<?php echo $roasterid ?>">

                                <!-- if variables have been set (Edit button has been pressed) display that info -->
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <label>Coffee Name</label>
                                    <input type="text" name="coffeename" class="form-control" value="<?php echo $selectedcoffeename; ?>" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label>Origin</label>
                                    <input type="text" name="coffeeorigin" class="form-control" value="<?php echo $coffeeorigin; ?>" placeholder="Enter your location">
                                </div>
                                <div class="form-group">
                                    <label>Variety</label>
                                    <input type="text" name="coffeevariety" class="form-control" value="<?php echo $coffeevariety; ?>" placeholder="Enter your location">
                                </div>
                                <div class="form-group">
                                    <label for="roasterid">Roaster</label>
                                    <select class="form-control" id="roasterid" name="roasterid">
                                        <option>Select One...</option>

                                        <!--Get Roaster details from DB, then display options -->
                                        <?php $result = $mysqli->query("SELECT roasterid, roastername FROM roaster");
                                        while ($row = $result->fetch_assoc()) : ?>
                                            <option value="<?php echo $row['roasterid']; ?>" 
                                            <?php if ($update == true && $row['roasterid'] == $roasterid) {echo 'selected';} ?>>
                                            <?php echo $row['roastername']; ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>

                                <!-- if $update variable is set, display 'update' button.  Else, display 'submit' button -->
                                <div class="form-group">
                                    <?php if ($update == true) :    ?>
                                        <button type="submit" class="btn btn-info" name="update">Update</button>
                                        <button type="submit" name="back" class="btn btn-secondary">Go Back</button>
                                    <?php else : ?>
                                        <button type="submit" name="save" class="btn btn-primary">Add New</button>
                                    <?php endif; ?>

                                </div>
                        </form>
                    </div>
                </div>
                <!--End User Input Form -->
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    
    </body>

    <!-- Show modal $update variable is set -->
    <?php if ($update == true) {
        echo '<script>$(\'#input-modal\').modal(\'show\')</script>';
    } ?>
    


    </html>