<?php
    include('database/Function.php');
    $db = new DatabaseFunction;                        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Food' List</title>
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
                    <li>
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
                    <li  class="active">
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
                            Food List
                        </h1>
                        <ol class="breadcrumb">
                            <li  class="active">
                                <i class="fa fa-list"></i> Food List
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
                                    <th>Food Name</th>
                                    <th>Description</th>
                                    <th>Attributes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $foods = $db->getAllFoods();
                                    foreach($foods as $food){
                                ?>
                                <tr id="row-<?= $food['food_id']; ?>">
                                    <td>
                                        <a href="#" style="display:block;font-size: 100%;color:#6b6363;font-weight: bold;margin-bottom:20px"><?= strtoupper($food['food_name']);?></a>
                                        <img src="database/display-image.php?foodId=<?= $food['food_id']?>"/ style="border-radius: 10px" width="200">
                                    </td>
                                    <td>
                                        <p><?= $food['food_description'] ?></p>                                        
                                    </td>
                                    <td>
                                    <?php
                                        //SEND emotion_id to get attributes 
                                        $attributes = $db->getFoodAttributes($food['food_id']);
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
                                        <a href="javascript:void(0)" onClick="return deleteFood(<?= $food['food_id'] ?>, '<?= strtoupper($food['food_name']) ?>')"><span class="fa fa-trash"></span> Delete</a> |
                                        <a href="food-update.php?foodId=<?= $food['food_id']; ?>&foodName=<?=$food['food_name'] ?>"><span class="fa fa-pencil-square"></span> Update</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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
        function deleteFood(id,foodName){
            if(confirm('Are you sure you want to delete '+foodName+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        $("#row-"+id).fadeOut(2000);
                    }
                };
                xmlhttp.open("GET", "database/deleteSpecificFood.php?id=" + id, true);
                xmlhttp.send();
            }
            else{
                return false;
            }
        }
    </script>

</body>

</html>
