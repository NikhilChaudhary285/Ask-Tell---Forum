<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="partials/img/forum_logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forum.css">
    <title>Ask & Tell - Coding Forum</title>

</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php'; ?>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $loggedin= true;
    }
    else{
        $loggedin = false;
    }
    ?>
    <?php 
         $id = $_GET['catid'];
         $sql = "SELECT * FROM `categories` WHERE category_id=$id"; 
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){

          $catname = $row['category_name'];
          $catdesc = $row['category_description'];
         }
    ?>

    <?php
    $showAlert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Insert into thread db
        $th_title = $_POST['title'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 
        
        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } 
}
    ?>

    <!-- Website Content  -->
    <!-- Category container starts here -->
    <div class="w-50 mx-auto p-4 my-4 rounded bg-transparent-gray">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> forums</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
        </div>
    </div>

    <?php 
    if($loggedin){ 
    echo '<div class="container w-50 mx-auto">
            <h1 class="py-2">Start a Discussion</h1> 
            <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] . '">
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
    else{
        echo '<div class="w-50 mx-auto p-4 my-4 rounded bg-transparent-gray">
                <div class="container">
                    <h1 class="display-4">Start a Discussion</h1>
                    <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
                </div>
            </div>';
    }
    ?>

    <div class="w-50 mx-auto pb-2 mb-4" id="ques">
        <h1 class="py-2"><span class="badge bg-transparent-gray text-dark">Browse Questions</span></h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_time = $row['timestamp']; 
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2); 
            
            echo '<div class="media d-flex my-3">
                    <img src="partials/img/userdefault.png" alt="user logo icon" width="44px" height="44px" class="mr-1">
                    <div class="media-body text-break w-70">
                        <h5 class="mt-0"> <a class="text-dark anchorthread" href="thread.php?threadid=' . $id . '">' . $title . ' </a></h5>' . $desc . '          
                    </div>
                    <div class="w-30">                       
                            <span class="badge bg-secondary"> Asked By: '
                                . $row2['user_email'] . ' at ' . $thread_time .
                            '</span>                       
                    </div>
                </div>';
        }
        if($noResult){
            echo '<div class="container mx-auto p-4 my-4 rounded bg-transparent-gray">
                        <div class="container">
                            <h1 class="display-4">No Threads Found</h1>
                            <p class="lead">Be the first person to ask a question</p>
                        </div>
                    </div>';
        }
        ?>

    </div>

    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>