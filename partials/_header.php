<?php

// Check user login or not
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin= true;
}
else{
    $loggedin = false;
}

echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="/forum/home.php">Ask <img src="partials/img/forum_logo.png" class = "rounded-circle" height = "23px" width = "23px" alt="library image"> Tell</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum/home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Top Categories
                        </a>
                        <ul class="dropdown-menu">';
                        $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
                        $result = mysqli_query($conn, $sql); 
                        while($row = mysqli_fetch_assoc($result)){
                        echo '<a class="dropdown-item" href="threadlist.php?catid='. $row['category_id']. '">' 
                                . $row['category_name']. 
                            '</a>'; 
                        }   
                   echo '</ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <div class="d-flex mx-2">
                    <form class="d-flex" role="search" method="get" action="search.php">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>';
                    if(!$loggedin){
                    echo '<button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
                    }
                    if($loggedin){
                    echo '<a class="nav-link" href="">
                        <button class="btn btn-success mx-2"><img src="partials/img/editor_profile.jpg" class="rounded-circle" height="19px" width="19px" alt="profile image"> '. $_SESSION['useremail'] .'</button>
                    </a>
                    <a class="nav-link" href="partials/_logout.php">
                        <button class="btn btn-outline-success">Logout</button>
                    </a>
                        ';
                    }
            echo '</div>
            </div>
        </div>
    </nav>
';

include '_loginmodal.php';
include '_signupmodal.php';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <strong>Success!</strong> You can now login
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
   echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <strong>Error!</strong> ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else if(isset($_GET['login_error'])){
   echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <strong>Error!</strong> ' . $_GET['login_error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
