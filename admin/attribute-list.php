<?php
    include('include/head.php');                    
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Attribute List
                        </h1>
                        <ol class="breadcrumb">
                            <li  class="active">
                                <i class="fa fa-list"></i> Attribute List
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
                                    <th>Attribute Name</th>
                                    <th>Food Related</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $attributes = $db->displayAttributes();
                                    foreach($attributes as $attribute){
                                ?>
                                <tr id="row-<?= $attribute['attribute_id']; ?>">
                                    <td><a href="#"><?= strtoupper($attribute['attribute_name']);?></a></td>
                                    <?php
                                        //SEND emotion_id to get attributes 
                                        $foods = $db->getFood($attribute['attribute_id']);
                                    ?>
                                    <td>
                                    <?php
                                        $i = 1;
                                        foreach($foods as $food){
                                            //COMMA GENERATOR
                                            $comma = $db->hasComma($i, $foods); 
                                            echo $food['food_name'].$comma;  
                                            $i++;
                                        } 
                                    ?>                                       
                                    </td>
                                    <td>
                                        <a href="#" onClick="return deleteAttribute(<?= $attribute['attribute_id'] ?>, '<?= strtoupper($attribute['attribute_name']) ?>' )"><span class="fa fa-trash"></span> Delete</a> |
                                        <a href="attribute-update.php?attributeId=<?= $attribute['attribute_id']; ?>&attributeName=<?=$attribute['attribute_name'] ?>"><span class="fa fa-pencil-square"></span> Update</a>
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
                        <!-- <div class="alert alert-danger" id="successful">
                          <strong>Oops!</strong> Already in the database.
                        </div> -->
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
        function deleteAttribute(id,attributeName){
            if(confirm('Are you sure you want to delete '+attributeName+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        $("#row-"+id).fadeOut('slow').delay(1000);
                        $("#successful").fadeIn(500);
                        $("#successful").fadeOut(5000);
                    }
                };
                xmlhttp.open("GET", "database/deleteSpecificAttribute.php?id=" + id, true);
                xmlhttp.send();
            }
            else{
                return false;
            }
        }
    </script>

</body>

</html>
