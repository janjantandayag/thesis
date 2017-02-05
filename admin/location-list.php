<?php
    include('include/head.php');                   
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Location List
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li  class="active">
                                <i class="fa fa-list"></i> Location Lists
                            </lsi>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Location Name</th>
                                    <th>Address</th>
                                    <th>Latitute</th>
                                    <th>Longhitude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $locations = $db->getAllLocations();
                                    foreach($locations as $location){
                                ?>
                                <tr id="row-<?= $location['location_id']; ?>">
                                    <td>
                                        <a href="#" style="display:block;font-size: 100%;color:#6b6363;font-weight: bold;margin-bottom:20px"><?= strtoupper($location['location_name']);?></a>
                                        <img src="database/displayLocation.php?locationId=<?= $location['location_id']?>"/ style="border-radius: 10px" width="200">
                                    </td>
                                    <td>
                                        <p><?= $location['address'] ?></p>                                     
                                    </td>
                                    <td>
                                        <p><?= $location['lat'] ?></p>                                     
                                    </td>
                                    <td>
                                    <?= $location['lang'] ?>                                 
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onClick="return deleteLocation(<?= $location['location_id'] ?>)"><span class="fa fa-trash"></span> Delete</a> |
                                        <a href="location-update.php?locationId=<?= $location['location_id']; ?>&locationName=<?=$location['location_name'] ?>"><span class="fa fa-pencil-square"></span> Update</a>
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
        function deleteLocation(id){
            if(confirm('Are you sure you want to delete?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        $("#row-"+id).fadeOut(2000);
                    }
                };
                xmlhttp.open("GET", "database/deleteSpecificLocation.php?id=" + id, true);
                xmlhttp.send();
            }
            else{
                return false;
            }
        }
    </script>

</body>

</html>
