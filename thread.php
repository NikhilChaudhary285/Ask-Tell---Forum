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
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){

            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_user_id = $row['thread_user_id'];
            // Query the users table to find out the name of OP
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        }
    ?>

    <?php
    $showAlert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Insert into comment db
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been added! Community appreciate your concern
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } 
    }
    ?>


    <!-- Website Content  -->
    <!-- Category container starts here -->
    <div class="w-50 mx-auto p-4 my-4 rounded bg-transparent-gray">
        <div class="jumbotron text-break">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p>Posted By: <em><?php echo $posted_by; ?></em></p>
        </div>
    </div>

    <?php 
    if($loggedin){ 
    echo '<div class="container w-50 mx-auto">
            <h1>Post a Comment</h1>
            <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Type Your Concern</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
    else{
        echo '<div class="w-50 mx-auto p-4 my-4 rounded bg-transparent-gray">
                <div class="container">
                    <h1 class="display-4">Post a Comment</h1>
                    <p class="lead">You are not logged in. Please login to be able to post comments.</p>
                </div>
            </div>';
    }
    ?>


    <div class="w-50 mx-auto pb-2 mb-4" id="ques">
        <h1 class="py-2"><span class="badge bg-transparent-gray text-dark">Discussions</span></h1>
        <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $thread_user_id = $row['comment_by']; 
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="media d-flex my-3">
                <img src="partials/img/userdefault.png" alt="user logo icon" width="44px" height="44px" class="mr-1">
                <div class="media-body">
                    <p class="mb-1">
                        <span class="badge bg-secondary"> Posted By: '
                            . $row2['user_email'] .' at '. $comment_time . 
                        '</span>
                    </p>'
                            . $content .        
                '</div>
            </div>';
    }
    if($noResult){
        echo '<div class="container mx-auto p-4 my-4 rounded bg-transparent-gray">
                    <div class="container">
                        <h1 class="display-4">No Comments Yet</h1>
                        <p class="lead">Be the first person to ask a Suggestion</p>
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