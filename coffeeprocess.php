<?php
session_start();

$mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));
$coffeename='';
$coffeeorigin='';
$coffeevariety='';
$roasterid = 0;
$update = false;
$id = 0;

if (isset($_POST ['save'])){

    unset($_SESSION['message']);

    $coffeename = $_POST['coffeename'];
    $coffeeorigin = $_POST['coffeeorigin'];
    $coffeevariety = $_POST['coffeevariety'];
    $roasterid = $_POST['roasterid'];

    $mysqli->query("INSERT INTO coffee (coffeename, coffeeorigin, coffeevariety, roaster_roasterid) VALUES ('$coffeename','$coffeeorigin','$coffeevariety','$roasterid' );") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: coffees.php");
}
if(isset($_GET['delete'])){

    unset($_SESSION['message']);

    $coffeeid = $_GET['delete'];
    $mysqli->query("DELETE FROM coffee WHERE coffeeid=$coffeeid") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: coffees.php");
}
if(isset($_GET['edit'])){

    unset($_SESSION['message']);

    $coffeeid = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM coffee WHERE coffeeid=$coffeeid") or die(mysqli_error($mysqli));
    if(count($result)==1){
        $row = $result->fetch_array();
        $selected = $row['coffeeid'];
        $selectedcoffeename = $row['coffeename'];
        $coffeeorigin = $row['coffeeorigin'];
        $coffeevariety = $row['coffeevariety'];
        $roasterid = $row['roaster_roasterid'];
    }

}
if(isset($_POST['update'])){

    unset($_SESSION['message']);

    $coffeename = $_POST['coffeename'];
    $coffeeorigin = $_POST['coffeeorigin'];
    $coffeevariety = $_POST['coffeevariety'];
    $roasterid = $_POST['roasterid'];

    $mysqli->query("UPDATE coffee SET coffeename='$coffeename', coffeeorigin='$coffeeorigin', coffeevariety='$coffeevariety', roaster_roasterid=$roasterid WHERE coffeeid=$selected") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";
    $update = false;
    $name = '';
    $location = '';
    header("location: coffees.php");
}
if(isset($_POST['back'])){
    unset($_SESSION['message']);
    header("location: coffees.php");
}
if(isset($_POST['closeBtn'])){
    unset($_SESSION['message']);
}
?>