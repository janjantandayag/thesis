<?php
    include('include/head.php');
    $attributes = $db->getAllAttributes();     
    $locations = $db->getAllLocations();                     
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add Food
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Food
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" id="add-form" action="food-add.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
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
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Attributes</label>
                                        <select class="form-control" multiple name="foodAttributes[]" required>  
                                            <?php foreach($attributes as $attribute): ?>
                                            <option value="<?= $attribute['attribute_id'] ?>"><?=strtoupper($attribute['attribute_name']);?></option>  
                                            <?php endforeach;   ?>                               
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Locations Available</label>
                                        <select class="form-control" multiple name="locations[]" required>  
                                            <?php foreach($locations as $location): ?>
                                            <option value="<?= $location['location_id'] ?>"><?=strtoupper($location['location_name']);?></option>  
                                            <?php endforeach;   ?>                               
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Add Food</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){
                        $db->addFood($_FILES["foodImage"]["tmp_name"], $_POST['foodAttributes'],$_POST['locations'], strtolower($_POST['description']),strtolower($_POST['foodName']));   
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
