<?php  $currentPage = substr(strtok($_SERVER['REQUEST_URI'],'?'), 14); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include('top-nav.php') ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php echo ($currentPage == 'dashboard.php') ? 'class="active"' : ''; ?> >
                <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li  <?php echo ($currentPage == 'emotion-list.php') || ($currentPage == 'emotion-food.php') || ($currentPage == 'emotion-update.php') || ($currentPage == 'add-emotion.php') ? 'class="active"' : ''; ?> >
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-smile-o"></i> Manage Emotion <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="emotion-list.php">Emotion List</a>
                    </li>
                    <li>
                        <a href="add-emotion.php">Add Emotion</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($currentPage == 'attribute-list.php') || ($currentPage == 'attribute-add.php') || ($currentPage == 'attribute-update.php') ? 'class="active"' : ''; ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#attribute"><i class="fa fa-fw fa-list-alt"></i> Manage Attribute <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="attribute" class="collapse">
                    <li>
                        <a href="attribute-list.php">Attribute List</a>
                    </li>
                    <li>
                        <a href="attribute-add.php">Add Attribute</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($currentPage == 'food-add.php') || ($currentPage == 'food-list.php') || ($currentPage == 'food-update.php') ? 'class="active"' : ''; ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#food"><i class="fa fa-fw fa-cutlery"></i> Manage Food <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="food" class="collapse">
                    <li>
                        <a href="food-list.php">Attribute List</a>
                    </li>
                    <li>
                        <a href="food-add.php">Add Attribute</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($currentPage == 'profile.php') ? 'class="active"' : ''; ?>>
                <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li <?php echo ($currentPage == 'settings.php') ? 'class="active"' : ''; ?>>
                <a href="settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
            </li>
            <li>
                <a href="database/logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>