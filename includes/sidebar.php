<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3 class="logo">
            <img src="img/My logo.jfif" class="img-fluid">
            <span>Admin Dashboard</span>
        </h3>
    </div>

    <ul class="list-unstyled components">
        <li class="active">     
            <a href="dashboard.php" class="dashboard"><i class="fa material fa-dashboard"></i><span>dashboard</span></a>
        </li>

        <div class="small-screen navbar-display">
            <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                <a href="#homeSubmenu0" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa material fa-bell"></i><span>4 Notifications</span>
                </a>
                <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                    <li><a href="#">You have 5 New Messages</a></li>
                    <li><a href="#">You have 5 New Messages</a></li>
                    <li><a href="#">You have 5 New Messages</a></li>
                    <li><a href="#">You have 5 New Messages</a></li>
                </ul>
            </li>

            <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                <a href="#"><i class="fa material fa-table-cells"></i><span>apps</span></a>
            </li>

            <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                <a href="#"><i class="fa material fa-user"></i><span>user</span></a>
            </li>

            <li class="d-lg-none d-md-block d-xl-none d-sm-block">
                <a href="#"><i class="fa material fa-gear"></i><span>settings</span></a>
            </li>
            
        </div>

        <li class="dropdown">
            <a href="#pageSubmenu1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
            <i class="fa material fa-users"></i><span>Admins</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu1">
                <li><a href="new_admin.php"><span>Add New Admin</span></a></li>
                <li><a href="admins.php"><span>View Admins</span></a></li>
            </ul>
        </li>
        
        <li class="dropdown">
            <a href="#pageSubmenu2" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
            <i class="fa material fa-user"></i><span>Models</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu2">
                <li><a href="new_model.php">Add New Model</a></li>
                <li><a href="all_models.php">View Models</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#pageSubmenu3" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
            <i class="fa material fa-gear"></i><span>Settings</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu3">
                <li><a href="edit_info.php">Edit Profile</a></li>
                <li><a href="code_change.php">Password settings</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#pageSubmenu4" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
            <i class="fa material fa-envelope"></i><span>Reports</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu4">
                <li><a href="edit_info.php">Vote Log</a></li>
            </ul>
        </li>

        <li>
            <a href="logout.php"><i class="fa material fa-arrow-left"></i><span>Logout</span></a> 
        </li>
    </ul>
</nav>