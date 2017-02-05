<?php
    include('include/head.php');                   
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Food List
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
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
