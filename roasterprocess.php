<?php
session_start();

$mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
$roastername='';
$roasterlocation='';
$roasterdetails='';
$roasterid = 0;
$update = false;
$id = 0;


if (isset($_POST ['save'])){
    unset($_SESSION['message']);
    $roastername = $_POST['roastername'];
    $roasterlocation = $_POST['roasterlocation'];
    $roasterdetails = $_POST['roasterdetails'];
    
    $mysqli->query("INSERT INTO roaster (roastername, roasterlocation, roasterdetails) VALUES ('$roastername','$roasterlocation','$roasterdetails' );") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: roasters.php");
}
if(isset($_GET['delete'])){
    $roasterid = $_GET['delete'];

    $mysqli->query("DELETE FROM roaster WHERE roasterid=$roasterid") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: roasters.php");
}
if(isset($_GET['edit'])){
    unset($_SESSION['message']);
    $selected = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM roaster WHERE roasterid=$selected") or die(mysqli_error($mysqli));
    if(count($result)==1){
        $row = $result->fetch_array();
        $selected = $row['roasterid'];
        $roastername = $row['roastername'];
        $roasterlocation = $row['roasterlocation'];
        $roasterdetails = $row['roasterdetails'];
        //$roasterid = $row['roasterid'];
    }
}
if(isset($_POST['update'])){
    $roastername = $_POST['roastername'];
    $roasterlocation = $_POST['roasterlocation'];
    $roasterdetails = $_POST['roasterdetails'];
    $roasterid = $_POST['roasterid'];

    $mysqli->query("UPDATE roaster SET roastername='$roastername', roasterlocation='$roasterlocation', roasterdetails='$roasterdetails' WHERE roasterid=$selected") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";
    $update = false;
    $name = '';
    $location = '';
    header("location: roasters.php");
}
if(isset($_POST['back'])){
    unset($_SESSION['message']);
    header("location: roasters.php");
}
if(isset($_POST['closeBtn'])){
    unset($_SESSION['message']);
}
?>