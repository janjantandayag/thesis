<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
                                <a href="add-emotion.php">Add Emotion</a>
                            </li>
                            <li>
                                <a href="#">Edit Emotion</a>
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
                            Add Emotion
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Emotion
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" id="add-form" action="add-emotion.php" method="POST">
                            <div class="form-group">
                                <label>Emotion Name</label>
                                <input class="form-control" placeholder="Enter emotion name" name="emotionName" required>
                            </div>
                            <div class="form-group">
                                <label>Food Attribute</label>
                                <select class="form-control" multiple name="foodAttribute[]" required>
                                    <?php                                                   
                                        include('database/connection.php');
                                        $queryAttribute = mysqli_query($conn, "SELECT * FROM attribute");                             
                                        while($attribute = mysqli_fetch_assoc($queryAttribute)){
                                    ?>                
                                    <option value="<?php echo $attribute['attribute_id'] ?>" ><?php echo strtoupper($attribute['attribute_name']) ?></option>
                                    
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Emotion</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){
                        $attrList = $_POST['foodAttribute'];
                        $emotionName = $_POST['emotionName'];
                        //CHECK IF EXISTING 
                        $queryEmotions = mysqli_query($conn, "SELECT * FROM emotion WHERE emotion.emotion_name LIKE '%$emotionName%'");
                        $exist = mysqli_num_rows($queryEmotions);
                        if($exist){                            
                            
                        }
                        else{
                            //INSERT TO EMOTION
                            $insertQuery = mysqli_query($conn, "INSERT INTO emotion(emotion_name) VALUE('$emotionName')");
                            //QUERY LAST ROW
                            $queryLast = mysqli_query($conn, "SELECT emotion_id FROM emotion ORDER BY emotion_id DESC LIMIT 1");
                            while($result = mysqli_fetch_assoc($queryLast)){
                                $lastId = $result['emotion_id'];
                            }
                            //INSERT TO EMOOTION_FOODATTRIBUTE
                            foreach($attrList as $attrId){
                                $insertQuery = mysqli_query($conn, "INSERT INTO attribute_emotion(emotion_id,attribute_id) VALUE($lastId, $attrId)");
                            }
                        }                         
                    }                    
                ?>
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
