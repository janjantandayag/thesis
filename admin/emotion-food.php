<?php
    include('include/head.php');
    if(isset($_GET['emotionId']) && isset($_GET['emotionName']))
    {
        $emotionId = $_GET['emotionId'];
        $emotionName = $_GET['emotionName'];
        $foods = $db->emotionFood($emotionId);         
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?= strtoupper($emotionName) ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="emotion-list.php"><i class="fa fa-list"></i> Emotion List</a>
                            </li>
                            <li class="active">
                                <?= strtoupper($emotionName)  ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php foreach ($foods as $food) { ?>
                    <div class="col-md-3" style="margin-top:30px">
                        <img src="database/display-image.php?foodId=<?= $food['food_id']?>" width="100%" style="border-radius: 5px" />
                        <h2 class="food-header" style="font-size: 130%;text-transform: uppercase;padding:5px;color:#000;border-left: 5px solid #000"><?= $food['food_name'] ?>                            
                        </h2>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include('include/footer.php');
}
    else{
        header("Location: emotion-list.php");
    }
?>

