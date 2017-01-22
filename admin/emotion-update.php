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
                                            $selectedAttributes = $db->getAttributes($emotionId);
                                            foreach($selectedAttributes as $attribute){?>
                                        <tr id="attribute-<?= $attribute['attribute_id']; ?>">
                                            <td><?= $attribute['attribute_name'] ?></td>
                                            <td><a href="javascript:void(0)" onClick="return deleteEmotionAttribute(<?= $emotionId ?>,<?= $attribute['attribute_id'] ?>, '<?= strtoupper($attribute['attribute_name']); ?>')">Remove <span class="fa fa-remove"></span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="button" value="Select New" data-toggle="modal" onClick="showSelected(); " data-target="#myModal"/ class="btn btn-success btn-xs"   />
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Select Attributes</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="database/addNewAttributes.php">
                                                  <div class="form-group">
                                                    <select class="form-control" multiple id="oldSelect" name="newAddSelect[]">
                                                    <?php
                                                        $attributes = $db->getAllAttributes();
                                                        foreach ($attributes as $attribute) {
                                                    ?>
                                                        <option style="display:block" id="selectAttribute<?= $attribute['attribute_id'] ?>" value="<?= $attribute['attribute_id']; ?>"><?= $attribute['attribute_name']; ?></option>
                                                        ?>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                    <select class="form-control" multiple id="newSelect" name="newAddSelect[]" style='display: none'>
                                                    
                                                    </select>
                                                    <input type="hidden" name="emotionId" value="<?= $emotionId ?>">
                                                    <input type="hidden" id="toChange" name="emotionName" value="<?= $emotionName ?>">
                                                  </div>
                                                  <button type="submit"  class="btn btn-success">Add</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $foods = $db->emotionFood($emotionId); 
                            foreach($foods as $food){
                        ?>
                        <div class="col-md-6 foodAttribute-<?= $food['attribute_id'] ?>">
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
        function showSelected(){
            var ids= [<?php 
                $i = 1;
                foreach($selectedAttributes as $attribute){
                    //COMMA GENERATOR
                    $comma = $db->hasComma($i, $attributes); 
                    echo $attribute['attribute_id'].$comma;  
                    $i++;
                }
             ?>];

            for(i=0;i<ids.length;i++){
                document.getElementById('selectAttribute'+ids[i]).style.display = 'none';
            }
        }
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
                            target.fadeIn('slow');
                            prompt.text('Successfully updated!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn('slow');
                            prompt.fadeOut('slow');
                            document.getElementById('toChange').value = newValue;
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

        function deleteEmotionAttribute(emotionId,id, name){
            if(confirm('Are you sure you want to remove '+name+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){  
                            $('#attribute-'+id).hide('3000');
                            $('.foodAttribute-'+id).hide('3000');
                            document.getElementById('oldSelect').style.display = 'none';
                            document.getElementById('newSelect').style.display = 'block';
                            document.getElementById("newSelect").innerHTML = this.responseText;
                            }
                        };
                xmlhttp.open("GET", "database/deleteAttribute.php?id=" + id + '&emotionId='+emotionId, true);
                xmlhttp.send();
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

