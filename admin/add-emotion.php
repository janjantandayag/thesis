<?php 
    include('include/head.php');
    $foodAttributes = $db->getAllAttributes();                          
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add Emotion
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Emotion
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" id="add-form" action="add-emotion.php" method="POST">
                            <div class="form-group">
                                <label>Emotion Name</label>
                                <input class="form-control" placeholder="Enter emotion name" name="emotionName" required>
                            </div>
                            <div class="form-group">
                                <label>Food Attribute</label>
                                <select class="form-control" multiple name="foodAttribute[]" required>  
                                    <?php foreach($foodAttributes as $foodAttribute){ ?>
                                    <option value="<?= $foodAttribute['attribute_id'] ?>"><?=strtoupper($foodAttribute['attribute_name']);?></option>  
                                    <?php }   ?>                               
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Emotion</button>
                        </form>
                    </div>
                </div>
                <?php
                    if($_POST){ $db->addNewAttribute($_POST['foodAttribute'], $_POST['emotionName']); }                          
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

</body>

</html>
