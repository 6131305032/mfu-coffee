    <!-- Start Session -->
    <?php require 'roasterprocess.php'; ?>

    <!--Include header -->
    <?php include 'header.php'; ?>

    <!-- Connect to mysql to display existing data -->
    <?php
    $mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM roaster") or die(mysqli_error($mysql));
    ?>

    <!-- Body Container -->
    <div class="container-fluid">
        <div class="row justify-center">

            <!-- Left Spacer -->
            <div class="col-sm-2">
            </div>

            <!--Main display area -->
            <div class="col-sm-8 pt-4">
                <h1>Roasters <button id="addRoaster" class="btn btn-success btn-lg" data-toggle="modal" data-target="#input-modal">+ Add New</button></h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Details</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>

                    <!-- While there is more data, echo it into the appropriate columns -->
                    <?php
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <?php $roasterid = $row['roasterid']; ?>
                        <tr>
                            <td><?php echo $row['roastername']; ?></td>
                            <td><?php echo $row['roasterlocation']; ?></td>
                            <td><?php echo $row['roasterdetails']; ?></td>

                            <!-- Display the Edit and Delete buttons & link them using unique id-->
                            <td>
                                <a href="roasters.php?edit=<?php echo $roasterid; ?>" class="btn btn-info btn-block">Edit</a>
                                <a href="roasterprocess.php?delete=<?php echo $roasterid; ?>" class="btn btn-danger btn-block">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>


                <!-- Modal -->
                <div class="modal fade" id="input-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Enter Roaster Details</h5>
                                <button onclick="location.href='roasters.php'" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <!--User Input Form -->
                                <div class="container justify-center pt-3 mt-3" id="user-input">
                                    <form action="" method="post">
                                        <div class="col-12 border pt-3 mx-auto">
                                            <!-- hidden input so we can use unique $id to modify data in db-->
                                            <input type="hidden" name="roasterid" value="<?php echo $roasterid ?>">

                                            <!-- if variables have been set (Edit button has been pressed) display that info -->
                                            <div class="form-group">

                                            </div>
                                            <div class="form-group">
                                                <label>Roaster Name</label>
                                                <input type="text" name="roastername" class="form-control" value="<?php echo $roastername; ?>" placeholder="Enter roaster name">
                                            </div>
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" name="roasterlocation" class="form-control" value="<?php echo $roasterlocation; ?>" placeholder="Enter roaster location">
                                            </div>
                                            <div class="form-group">
                                                <label>Details</label>
                                                <textarea type="text" name="roasterdetails" class="form-control" value="" placeholder="Enter roaster details"><?php echo $roasterdetails; ?></textarea>
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
                                        </div>
                                    </form>
                                </div><!--End User Input Form -->
                            </div>
                            
                        </div>
                    </div>
                </div><!-- End Modal -->

            </div><!--End Row -->

            <!--Right sidebar -->
            <div class="col-sm-2">
            </div>

        </div><!-- End Body Container -->
        </body>

            <!-- Show modal and hide if $update variable is set -->
    <?php if ($update == true) {
        echo '<script>$(\'#input-modal\').modal(\'show\')</script>';
    } ?>

        </html>