<?php
    include('database/Function.php');
    $db = new DatabaseFunction;
    $foods = $db->getAllFoods();                          
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Attribute</title>
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
                    <li  class="active">
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
                            Add Attribute
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Attribute
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" id="add-form" action="attribute-add.php" method="POST">
                            <div class="form-group">
                                <label>Attribute Name</label>
                                <input class="form-control" placeholder="Enter attribute name" name="attributeName" required>
                            </div>
                            <div class="form-group">
                                <label>Related Food</label>
                                <select class="form-control" multiple name="foodRelated[]" required>  
                                    <?php foreach($foods as $food){ ?>
                                    <option value="<?= $food['food_id'] ?>"><?=strtoupper($food['food_name']);?></option>  
                                    <?php }   ?>                               
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Attribute</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){
                        $db->addNewFood($_POST['foodRelated'], strtolower($_POST['attributeName']));   
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
