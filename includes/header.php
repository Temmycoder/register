<div class="top-navbar">
    <nav class="navbar navbar-expand-lg">
        <button type="button" id="sidebar-collapse" class="d-xl-block d-lg-block d-md-none d-none">
            <span class="fa fa-angle-left"></span>
        </button>
        
        <a href="dashboard.php" class="navbar-brand">Dashboard</a>

        <button class="d-inline-block d-lg-none ms-auto more-button" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle">
            <span class="fa fa-ellipsis-vertical"></span>
        </button>

        <div class="collapse navbar-collapse d-lg-block d-xl-block d-md-none d-sm-none d-none" id="navbar-collapse">
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown active bell-body me-4">
                    <a href="#dropdown-menu" data-bs-toggle="collapse" class="nav-link" role="button" aria-expanded="false">
                        <span class="fa material fa-bell"></span>
                        <span class="notification">4</span>
                    </a>

                    <ul class="collapse top-bell" id="dropdown-menu">
                        <li><a href="#">You have 4 New Messages</a></li>
                        <li><a href="#">You have 4 New Messages</a></li>
                        <li><a href="#">You have 4 New Messages</a></li>
                        <li><a href="#">You have 4 New Messages</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link me-3"><i class="fa material fa-table-cells"></i><span>apps</span></a>
                </li>

                <li class="nav-item">
                    <a href="edit_info.php" class="nav-link me-3"><i class="fa material fa-user"></i><span>Profile</span></a>
                </li>

                <li class="nav-item me-3">
                    <a href="#" class="nav-link"><i class="fa material fa-gear"></i><span>settings</span></a>
                </li>
            </ul>
        </div>
    </nav>
</div>