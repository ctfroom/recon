<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <span class="text-dark"><?php echo $uinfo['fullname'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?php echo ICE_URL .'profile' ?>"><i class="align-middle me-1"
                                data-feather="user"></i> My Profile</a>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo ICE_ACTIONS_URL .'logout' ?>">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>