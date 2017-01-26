<?php
    include('database/Function.php');
    $db = new DatabaseFunction;                        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Emotions' List</title>
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
                    <li class="active">
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
                        <a href="javascript:;" data-toggle="collapse" data-target="#attribute"><i class="fa fa-fw fa-list-alt"></i> Manage Attribute <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="attribute" class="collapse">
                            <li>
                                <a href="attribute-list.php">Attribute List</a>
                            </li>
                            <li>
                                <a href="attribute-add.php">Add Attribute</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#food"><i class="fa fa-fw fa-cutlery"></i> Manage Food <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="food" class="collapse">
                            <li>
                                <a href="food-list.php">Food List</a>
                            </li>
                            <li>
                                <a href="food-add.php">Add Food</a>
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
                            Emotion List
                        </h1>
                        <ol class="breadcrumb">
                            <li  class="active">
                                <i class="fa fa-list"></i> Emotion List
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Emotion Name</th>
                                    <th>Food Attribute</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $emotions = $db->displayEmotions();
                                    foreach($emotions as $emotion){
                                ?>
                                <tr id="row-<?= $emotion['emotion_id']; ?>">
                                    <td><a href="emotion-food.php?emotionId=<?= $emotion['emotion_id'] ?>&emotionName=<?=$emotion['emotion_name'] ?>"><?= strtoupper($emotion['emotion_name']);?></a></td>
                                    <?php
                                        //SEND emotion_id to get attributes 
                                        $attributes = $db->getAttributes($emotion['emotion_id']);
                                    ?>
                                    <td>
                                    <?php
                                        $i = 1;
                                        foreach($attributes as $attribute){
                                            //COMMA GENERATOR
                                            $comma = $db->hasComma($i, $attributes); 
                                            echo $attribute['attribute_name'].$comma;  
                                            $i++;
                                        } 
                                    ?>                                       
                                    </td>
                                    <td>
                                        <a href="#" onClick="return deleteEmotion(<?= $emotion['emotion_id'] ?>, '<?= strtoupper($emotion['emotion_name']) ?>' )"><span class="fa fa-trash"></span> Delete</a> |
                                        <a href="emotion-update.php?emotionId=<?= $emotion['emotion_id']; ?>&emotionName=<?=$emotion['emotion_name'] ?>"><span class="fa fa-pencil-square"></span> Update</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="alert alert-success" id="successful" style='display:none'>
                          <strong>Success!</strong> Successfully deleted.
                        </div>
                    </div>
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
    <script>
        function deleteEmotion(id,emotionName){
            if(confirm('Are you sure you want to delete '+emotionName+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        $("#row-"+id).fadeOut('slow').delay(1000);
                        $("#successful").fadeIn(500);
                        $("#successful").fadeOut(5000);
                    }
                };
                xmlhttp.open("GET", "database/deleteEmotion.php?id=" + id, true);
                xmlhttp.send();
            }
            else{
                return false;
            }
        }
    </script>

</body>

</html>
