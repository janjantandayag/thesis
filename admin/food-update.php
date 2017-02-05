<?php
    if(isset($_GET['foodId']) && isset($_GET['foodName']))
        {
        include('include/head.php'); 
        $foodName = strtoupper($_GET['foodName']);
        $foodId = $_GET['foodId'];                
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Food Update
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="food-list.php"><i class="fa fa-list"></i> Food List</a>
                            </li>
                            <li class="active" id="li-value">
                                Update: <?= strtoupper($foodName)  ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" value="<?= strtoupper($foodName) ?>" class="form-control" style="text-transform: uppercase;margin-bottom: 10px;" id="newValue" />
                        <input type="button" value="Update Name"/ class="btn btn-warning btn-xs" onClick="updateFoodName(<?= $foodId ?>);" style="margin-top:20px;margin-bottom: 10px">
                        <p id="alert"></p>
                        <?php 
                            $description = $db->getSpecificFood($foodId);
                            foreach($description as $desc){
                        ?>
                        <textarea class="form-control" style="text-transform:uppercase" id="newDescription"><?=$desc['food_description'];?></textarea>
                        <?php } ?>
                        <input type="button" value="Update Description"/ class="btn btn-danger btn-xs" onClick="updateFoodDescription(<?= $foodId ?>);" style="margin-top:20px;margin-bottom: 10px">
                        <p id="alert-description"></p>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Attributes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $selectedAttributes = $db->getFoodAttributes($foodId);
                                    foreach($selectedAttributes as $attribute){?>
                                <tr id="attribute-<?= $attribute['attribute_id']; ?>">
                                    <td><?= $attribute['attribute_name'] ?></td>
                                    <td><a href="javascript:void(0)" onClick="return deleteFoodAttribute(<?= $foodId ?>,<?= $attribute['attribute_id'] ?>, '<?= strtoupper($attribute['attribute_name']); ?>')">Remove <span class="fa fa-remove"></span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>  
                        <p id="alert-deleted"></p>
                        <input type="button" value="Select New"  data-dismiss="modal"  data-toggle="modal" onClick="showSelected(); " data-target="#myModal"/ class="btn btn-success btn-xs"   />
                    </div>
                    <div class="col-md-4">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Locations</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $selectedLocations = $db->getLocationDetails($foodId);
                                    foreach($selectedLocations as $location) : ;?>
                                <tr id="location-<?= $location['location_id']; ?>">
                                    <td><?= ucfirst($location['location_name']) ?></td>
                                    <td><a href="javascript:void(0)" onClick="return deleteFoodLocation(<?= $foodId ?>,<?= $location['location_id'] ?>, '<?= strtoupper($location['location_name']); ?>')">Remove <span class="fa fa-remove"></span></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>  
                        <p id="alert-deleted-location"></p>
                        <input type="button" value="Select New"  data-dismiss="modal"  data-toggle="modal" onClick="showSelectedLocation(); " data-target="#modalLocation"/ class="btn btn-success btn-xs"   />
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

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
                    <form method="POST" action="database/addNewFoodAttribute.php">
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
                        <input type="hidden" name="foodId" value="<?= $foodId ?>">
                        <input type="hidden" id="toChange" name="foodName" value="<?= $foodName ?>">
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
    <!-- MODAL LOCATION-->
    <div id="modalLocation" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Attributes</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="database/addNewFoodLocation.php">
                      <div class="form-group">
                        <select class="form-control" multiple id="oldSelectLocation" name="newAddSelect[]">
                        <?php
                            $locations = $db->getAllLocations();
                            foreach ($locations as $location) : ;
                        ?>
                            <option style="display:block" id="selectLocation<?= $location['location_id'] ?>" value="<?= $location['location_id']; ?>"><?= $location['location_name']; ?></option>
                            ?>
                        <?php endforeach; ?>
                        </select>
                        <select class="form-control" multiple id="newSelectLocation" name="newAddSelect[]" style='display: none'>
                        </select>
                        <input type="hidden" name="foodId" value="<?= $foodId ?>">
                        <input type="hidden" id="toChange" name="foodName" value="<?= $foodName ?>">
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
        function updateFoodName(id){
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
                            prompt.fadeIn(500);
                            prompt.fadeOut(1500);
                            document.getElementById('toChange').value = newValue;
                            window.history.pushState({}, 'Food Update', '../admin/food-update.php?foodId=<?=$foodId?>&foodName='+newValue.toLowerCase());
                                }
                            };
                    xmlhttp.open("GET", "database/updateFoodName.php?id=" + id+"&name="+ newValue, true);
                    xmlhttp.send();
                }
            }
            else{
                return false;
            }
        }
        function updateFoodDescription(id){
            if(confirm('Are you sure you want to update the description?')){
                var newValue = document.getElementById('newDescription').value;
                var prompt = $("#alert-description");
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
                            prompt.text('Successfully updated!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn(500);
                            prompt.fadeOut(1500);
                                }
                            };
                    xmlhttp.open("GET", "database/updateFoodDescription.php?id=" + id+"&description="+ newValue, true);
                    xmlhttp.send();
                }
            }
            else{
                return false;
            }            
        }
        function deleteFoodAttribute(foodId,attributeId, name){
            var prompt = $("#alert-deleted");
            if(confirm('Are you sure you want to remove '+name+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){  
                            $('#attribute-'+attributeId).hide('3000');
                            prompt.text('Successfully deleted!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn(500);
                            prompt.fadeOut(1500);
                            document.getElementById('oldSelect').style.display = 'none';
                            document.getElementById('newSelect').style.display = 'block';
                            document.getElementById("newSelect").innerHTML = this.responseText;
                            }
                        };
                xmlhttp.open("GET", "database/deleteAttributeFood.php?foodId=" + foodId + '&attributeId='+attributeId, true);
                xmlhttp.send();
            }
            else{
                return false;
            }
        }
        function showSelectedLocation(){ 
            var ids= [<?php 
                $i = 1;
                foreach($selectedLocations as $location){
                    //COMMA GENERATOR
                    $comma = $db->hasComma($i, $locations); 
                    echo $location['location_id'].$comma;  
                    $i++;
                }
             ?>];

            for(i=0;i<ids.length;i++){
                document.getElementById('selectLocation'+ids[i]).style.display = 'none';
            }
        }
        function deleteFoodLocation(foodId,locationId, name){
            var prompt = $("#alert-deleted-location");
            if(confirm('Are you sure you want to remove '+name+'?')){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){  
                            $('#location-'+locationId).hide('3000');
                            prompt.text('Successfully deleted!');
                            prompt.css({
                                "color":"green",
                                "font-weight":"bold"
                            });
                            prompt.fadeIn(500);
                            prompt.fadeOut(1500);
                            document.getElementById('oldSelectLocation').style.display = 'none';
                            document.getElementById('newSelectLocation').style.display = 'block';
                            document.getElementById("newSelectLocation").innerHTML = this.responseText;
                            }
                        };
                xmlhttp.open("GET", "database/deleteFoodLocation.php?foodId=" + foodId + '&locationId='+locationId, true);
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

