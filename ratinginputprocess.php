<?php
session_start();

$mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
$coffeeid=0;
$ratingnote='';
$ratingscore= 0;
$flavorid = 0;
//$update = false;
//$id = 0;
//$dauser = $mysqli->query("SELECT userid FROM user WHERE username LIKE '$daname'")or die(mysqli_error($mysqli));
//$rr=$dauser->fetch_assoc();
$daid = $_SESSION['userid'];
$daname = $_SESSION['username'];
$dayy=date("Y-m-d");


if (isset($_POST ['save'])){

    unset($_SESSION['message']);

    $coffeeid = $_POST['coffeeid'];
    $ratingnote = $_POST['ratingnote'];
    $ratingscore = $_POST['ratingscore'];
    $flavorid = $_POST['flavorid'];

    $mysqli->query("INSERT INTO rating (coffee_coffeeid, ratingnotes, ratingscore, flavorchart_flavorid,user_userid,ratingdate) VALUES ('$coffeeid','$ratingnote','$ratingscore','$flavorid','$daid','$dayy');") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    //Javascript to send back to rating page
    echo "<script type='text/javascript'>window.top.location='ratings.php';</script>";}
    ?>