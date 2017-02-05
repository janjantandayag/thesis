<?php
    include('include/head.php');
    $foods = $db->getAllFoods();                          
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add Attribute
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-plus"></i> Add Attribute
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form role="form" id="add-form" action="attribute-add.php" method="POST">
                    <div class="form-group">
                        <label>Attribute Name</label>
                        <input class="form-control" placeholder="Enter attribute name" name="attributeName" required>
                    </div>
                    <div class="form-group">
                        <label>Related Food</label>
                        <select class="form-control" multiple name="foodRelated[]" required>  
                            <?php foreach($foods as $food){ ?>
                            <option value="<?= $food['food_id'] ?>"><?=strtoupper($food['food_name']);?></option>  
                            <?php }   ?>                               
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Attribute</button>
                </form>
            </div>
        </div>
        <?php
            if($_POST){
                $db->addNewFood($_POST['foodRelated'], strtolower($_POST['attributeName']));   
            }                          
        ?>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include('include/footer.php'); ?>