<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFU Coffee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
</head>

<?php if (!isset($_SESSION['active'])){ $links = 'disabled'; } else {$links='';} ?>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm sticky-top bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php">☕ MFU Coffee - CRUD Project</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo $links ?>" href="coffees.php">Coffees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $links ?>" href="roasters.php">Roasters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $links ?>" href="ratings.php">Ratings</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if ($_SESSION['active']==TRUE) :?>
            <li class="nav-item"><a class="nav-link text-white">Signed in as: <?php echo $_SESSION['username'] ?> <?php echo $_SESSION['useravatar'];?></a></li>
            <li class="nav-item"><a class="nav-link" href="myrating.php">My Ratings</a>
            <li class="nav-item"><a class="nav-link" href="index.php">Logout ↷</a>
            </li>
            <?php endif ?>
            
        </ul>
    </nav>
    
    <!-- Check if message has already been dismissed -->
    <?php if(isset($_POST['closeBtn'])){ unset($_SESSION['message']);} ?>
    
    <!-- Check/Display Status Message -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?> alert-dismissible fade show">
            <?php echo $_SESSION['message'];?>
            <form action="" method="post">
            <button type="submit" class="close" name="closeBtn" aria-label="close">
            <span aria-hidden="true">&times;</span>
            </button>
            </form>
        </div>
    <?php endif ?>


    
