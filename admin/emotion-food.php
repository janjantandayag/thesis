<?php
    if(isset($_GET['emotionId']) && isset($_GET['emotionName']))
    {
        $emotionId = $_GET['emotionId'];
        $emotionName = $_GET['emotionName'];

        include('database/Function.php');
        $db = new DatabaseFunction;    
        $foods = $db->emotionFood($emotionId);         
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Emotion - <?= strtoupper($emotionName)  ?></title>
    <?php include('include/header.php') ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include('include/top-nav.php') ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li  class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-smile-o"></i> Manage Emotion <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="emotion-list.php">Emotion List</a>
                            </li>
                            <li>
                                <a href="add-emotion.php">Add Emotion</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?= strtoupper($emotionName) ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="emotion-list.php"><i class="fa fa-list"></i> Emotion List</a>
                            </li>
                            <li class="active">
                                <?= strtoupper($emotionName)  ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php foreach ($foods as $food) { ?>
                    <div class="col-md-3" style="margin-top:30px">
                        <img src="database/display-image.php?foodId=<?= $food['food_id']?>" width="100%" style="border-radius: 5px" />
                        <h2 class="food-header" style="font-size: 130%;text-transform: uppercase;padding:5px;color:#000;border-left: 5px solid #000"><?= $food['food_name'] ?>                            
                        </h2>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php }
    else{
        header("Location: emotion-list.php");
    }
?>

