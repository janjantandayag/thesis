<?php 
    include('include/head.php');
    $userDetails = $db->getAdminDetails();
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Setting
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li class="active"><i class="fa fa-gear"></i> Settings</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="settings.php" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" placeholder="Enter username" name="username" value="<?= $userDetails['username'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required >
                            </div>
                            <div class="form-group">
                                <label>Retype Password</label>
                                <input type="password" id="retype" class="form-control" placeholder="Retype password" onchange="isTheSame();" required>
                                <p id="alert"></p>
                            </div>
                            <button id="buttonChange" name="submit" type="submit" class="btn btn-warning">Update Details</button>
                            <p id="alert"></p>
                        </form>
                        <?php if(isset($_POST['submit'])) { $db->updatePassUser($_POST['username'], $_POST['password']); } ?>
                    </div>
                </div>
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
        function isTheSame(){
            var password = document.getElementById("password").value;
            var retype = document.getElementById("retype").value;
            var message = $("#alert");
            if (password!=retype) {
                message.text('Seems like you retyped your new password incorrectly');
                message.css({
                    "color":"red",
                    "font-weight":"bold",
                    "padding":"10px",
                    "font-style":"italic"
                });
                message.fadeIn(1000);
                $("#buttonChange").attr('disabled','disabled');
            }
            else{
                message.fadeOut(1000);
                $("#buttonChange").removeAttr('disabled');
            }

        }
    </script>
</body>

</html>
