<?php
    if(isset($_GET['emotionId']) && isset($_GET['emotionName']))
        {
        include('database/Function.php');
        $db = new DatabaseFunction;        
        $emotionName = strtoupper($_GET['emotionName']);
        $emotionId = $_GET['emotionId'];                
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Emotions' Update</title>
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
                            Emotion Update
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="emotion-list.php"><i class="fa fa-list"></i> Emotion List</a>
                            </li>
                            <li class="active" id="li-value">
                                Update: <?= strtoupper($emotionName)  ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="<?= strtoupper($emotionName) ?>" class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="newValue" />
                                <input type="button" value="Update Name"/ class="btn btn-warning btn-xs" onClick="updateEmotionName(<?= $emotionId ?>);" style="margin-top:20px;margin-bottom: 10px">
                                <p id="alert"></p>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Attributes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $attributes = $db->getAttributes($emotionId);
                                            foreach($attributes as $attribute){?>
                                        <tr>
                                            <td><?= $attribute['attribute_name'] ?></td>
                                            <td><a href="#" onClick="return deleteEmotionAttribute()">Remove <span class="fa fa-remove"></span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="button" value="Select New"/ class="btn btn-success btn-xs"   />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $foods = $db->emotionFood($emotionId); 
                            foreach($foods as $food){
                        ?>
                        <div class="col-md-6">
                            <img src="database/display-image.php?foodId=<?= $food['food_id']?>" class="img-responsive" style="border-radius: 10px" />
                            <h5><?= strtoupper($food['food_name']) ?></h5>
                        </div>
                        <?php } ?>
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
        function updateEmotionName(id){
            if(confirm('Are you sure you want to update the name?')){
                var newValue = document.getElementById('newValue').value.toUpperCase();
                var prompt = $("#alert");
                var target = $("#li-value");
                if(newValue == ''){
                    prompt.text('Please specify name');
                    prompt.css({
                        "color":"red",
                        "font-weight":"bold"
                    });
                    prompt.fadeIn('slow');
                    prompt.fadeOut('slow');                    
                }
                else{
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200){                        
                            target.fadeOut('fast');
                            target.text(newValue); 
                            target.hide().fadeIn('slow');
                            prompt.text('Successfully updated!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn('slow');
                            prompt.fadeOut('slow');
                                }
                            };
                    xmlhttp.open("GET", "database/updateName.php?id=" + id+"&name="+ newValue, true);
                    xmlhttp.send();
                }
            }
            else{
                return false;
            }
        }
    </script>
</body>

</html>
<?php }
    else{
        header("Location: emotion-list.php");
    }
?>

