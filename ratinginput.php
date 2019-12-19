<?php require 'ratinginputprocess.php'; ?>

<div class="container justify-center" id="user-input">
                        <form action="" method="post">
                            <div class="col-12 border pt-3 mx-auto">

                                <div class="form-group">
                                    <label>Coffee Name</label>
                                     <select class="form-control" id="coffeeid" name="coffeeid">
                                        <option>Select One...</option>
                                        <?php $result = $mysqli->query("SELECT coffeeid, coffeename FROM coffee");
                                        while ($row = $result->fetch_assoc()) : ?>
                                            <option value="<?php
                                                                echo $row['coffeeid']; ?>" <?php if ($update == true && $row['coffeeid'] == $coffeeid) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $row['coffeename']; ?></option>
                                        <?php endwhile ?>
                                        </select> 
                                </div>
                                <div class="form-group">
                                    <label>Score</label>
                                    <input type="text" name="ratingscore" class="form-control" placeholder="Enter your Score">
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <input type="text" name="ratingnote" class="form-control" placeholder="Your thought?">
                                </div>
                                <?php include_once('slider.php');?>
                                <div class="form-group">                          
                                        <button type="submit" name="save" class="btn btn-primary">Add New</button>
                                </div>
                        </form>
                    </div>

            </body>
        </html>