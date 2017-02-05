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
                            Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li class="active"><i class="fa fa-user"></i> Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" id="firstName" placeholder="Enter first name" name="firstname" value="<?= $userDetails['first_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input class="form-control" id="middleName" placeholder="Enter middle name" name="middlename" value="<?= $userDetails['middle_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="lastName" placeholder="Enter last name" name="lastname" value="<?= $userDetails['last_name'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-warning" onclick="updateUserDetails();">Update Details</button>
                        <p id="alert" style="padding-top: 20px"></p>
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
        function updateUserDetails(){
            if(confirm('Are you sure you want to update the name?')){
                var firstName = document.getElementById('firstName').value;
                var middleName = document.getElementById('middleName').value;
                var lastName = document.getElementById('lastName').value;
                var prompt = $("#alert");
                var topName = $("#topUserName");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){                        
                        topName.fadeOut('fast');
                        topName.text(firstName +' '+ lastName + ' '); 
                        topName.fadeIn('slow');
                        prompt.text("Successfully updated!");
                        prompt.css({
                            "color":"green",
                            "font-weight":"bold"
                        });
                        prompt.fadeIn(500);
                        prompt.fadeOut(1500);
                        }
                };

                xmlhttp.open("GET", "database/updateUserDetails.php?firstName=" + firstName+"&lastName="+ lastName+"&middleName="+middleName, true);
                xmlhttp.send();
            }
            else
            {
                return false;
            }
        }
    </script>
</body>

</html>
