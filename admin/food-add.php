<?php
    include('database/Function.php');
    $db = new DatabaseFunction;
    $attributes = $db->getAllAttributes();                          
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Food</title>
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
                            Add Food
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Food
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" id="add-form" action="food-add.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Food Name</label>
                                <input class="form-control" placeholder="Enter food name" style='text-transform: uppercase;' name="foodName" required>
                            </div>
                            <div class="form-group">
                                <label>Food Image</label>
                                <input class="form-control" name="foodImage" type="file" id="uploadButton" required>
                                <div id="img-preview" style="background: #fbfbfb;text-align: center;display: none">
                                    <img id="img-here" style="margin: 25px 0 25px 0;border-radius:10px" src="#" width="300"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Attributes</label>
                                <select class="form-control" multiple name="foodAttributes[]" required>  
                                    <?php foreach($attributes as $attribute){ ?>
                                    <option value="<?= $attribute['attribute_id'] ?>"><?=strtoupper($attribute['attribute_name']);?></option>  
                                    <?php }   ?>                               
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Food</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){
                        $db->addFood($_FILES["foodImage"]["tmp_name"], $_POST['foodAttributes'], strtolower($_POST['description']),strtolower($_POST['foodName']));   
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

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-here').attr('src', e.target.result);
                }
                $("#img-preview").fadeIn(1000);
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#uploadButton").change(function(){
            readURL(this);
        });

    </script>

</body>

</html>
