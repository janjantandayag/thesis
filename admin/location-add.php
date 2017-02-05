<?php
    include('include/head.php');
    $attributes = $db->getAllAttributes();                          
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add Location
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
                        <form role="form" id="add-form" action="location-add.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Location Name</label>
                                <input class="form-control" placeholder="Enter location name" style='text-transform: uppercase;' name="locationName" required>
                            </div>
                            <div class="form-group">
                                <label>Food Image</label>
                                <input class="form-control" name="locationImage" type="file" id="uploadButton" required>
                                <div id="img-preview" style="background: #fbfbfb;text-align: center;display: none">
                                    <img id="img-here" style="margin: 25px 0 25px 0;border-radius:10px" src="#" width="300"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="5" name="address"></textarea>
                            </div>

                            <div class="form-group">
                                <label><a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Generator</a></label>
                            </div>
                            <div class="form-group">
                                <label>Latitude</label>
                                <input class="form-control" placeholder="Enter location latitude" style='text-transform: uppercase;' name="lat" required>
                            </div>
                            <div class="form-group">
                                <label>Longhitude</label>
                                <input class="form-control" placeholder="Enter location longhitude" style='text-transform: uppercase;' name="lang" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add Location</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){
                        $db->addLocation($_FILES["locationImage"]["tmp_name"], $_POST['lat'],$_POST['locationName'],  strtolower($_POST['lang']),strtolower($_POST['address']));   
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
