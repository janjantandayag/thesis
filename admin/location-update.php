<?php
    if(isset($_GET['locationId']) && isset($_GET['locationName']))
        {
        include('include/head.php');
        $locationName = strtoupper($_GET['locationName']);
        $locationId = $_GET['locationId'];         
        $locationDetail = $db->getSpecificLocation($locationId);       
?>
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
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="location-list.php"><i class="fa fa-list"></i> Location List</a>
                            </li>
                            <li class="active">
                                Update: <span  id="li-value"><?= strtoupper($locationName)  ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Name</label>
                        <input type="text" value="<?= strtoupper($locationName) ?>" class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="name" />
                        <label>Address</label>
                        <textarea class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="address" ><?= strtoupper($locationDetail['address']) ?></textarea>
                        <div class="form-group">
                            <label><a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Generator</a></label>
                        </div>
                        <label>Latitude</label>
                        <input type="text" value="<?= strtoupper($locationDetail['lat']) ?>" class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="lat" />
                        <label>Longhitude</label>
                        <input type="text" value="<?= strtoupper($locationDetail['lang']) ?>" class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="lang" />
                        <input type="button" value="Update"/ class="btn btn-warning btn-xs" onClick="update(<?= $locationId ?>);" style="margin-top:20px;margin-bottom: 10px">
                        <p id="alert"></p>
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
        function update(id){
            if(confirm('Are you sure you want to update?')){
                var name = document.getElementById('name').value.toUpperCase();
                var address = document.getElementById('address').value.toUpperCase();
                var lat = document.getElementById('lat').value.toUpperCase();
                var lang = document.getElementById('lang').value.toUpperCase();
                var prompt = $("#alert");
                var target = $("#li-value");
                if(name == '' || address == '' || lat == '' || lang== ''){
                    prompt.text('Please specify value');
                    prompt.css({
                        "color":"red",
                        "font-weight":"bold"
                    });
                    prompt.fadeIn(5000);
                    prompt.fadeOut(5000);                    
                }
                else{
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200){                        
                            target.fadeOut('fast');
                            target.text(name); 
                            target.fadeIn('slow');
                            prompt.text('Successfully updated!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn(500);
                            prompt.fadeOut(1500);
                            window.history.pushState({}, 'Emotions Update', '../admin/location-update.php?locationId=<?=$locationId?>&locationName='+name.toLowerCase());
                                }
                            };
                    xmlhttp.open("GET", "database/updateLocationDetail.php?id=" + id+"&name="+ name+"&address="+address+
                                        "&lat="+lat+"&lang="+lang, true);
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

