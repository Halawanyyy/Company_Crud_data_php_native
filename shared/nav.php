<?php
function auth(){
    if(! $_SESSION['admin']){
        path('auth/login.php');
    }
}
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('location:/odc4/auth/login.php');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/odc4/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Employees
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc4/employees/list.php">List All</a>
                        <a class="dropdown-item" href="/odc4/employees/create.php">Create New</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Department
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc4/departments/list.php">List All</a>
                        <a class="dropdown-item" href="/odc4/departments/create.php">Create New</a>
                    </div>
                </li>
                <?php if(isset($_SESSION['admin'])){?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu">
                    <?php 
                    if($_SESSION['admin']['role']==1){?>
                        <a class="dropdown-item" href="/odc4/admins/list.php">List All</a>
                        <a class="dropdown-item" href="/odc4/admins/createAdmin.php">Create New</a>
                        <?php }?>
                        <a class="dropdown-item" href="/odc4/admins/edit.php">Edit Profile</a>
                    </div>
                </li>
                <?php }?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc4/empInDep/empInDep.php">Employees in deps</a>
                    </div>
                </li>
                <?php if(isset( $_SESSION['admin'])){?>
                <form action="">
                <button name="logout" class="btn btn-danger"> Logout </button>
                </form>
                <?php } else{?>
                <li>
                <a href="/odc4/auth/login.php" class="btn btn-success">Login</a>
                </li>
            <?php }?>
            </ul>
            
        </div>
    </nav>