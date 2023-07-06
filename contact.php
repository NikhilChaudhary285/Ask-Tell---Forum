<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="partials/img/forum_logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forum.css">
    <title>Contact - Ask & Tell</title>

</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <!-- Website Content -->
    <div class="container w-50 mx-auto my-4 px-4">
        <img src="partials/img/forumicon.jpg" class="rounded-circle mb-2 d-block mx-auto" height="46px" width="62px"
            alt="forum icon">
            <div class="text-center">
            <h1 class="mb-0"><span class="fs-4 fw-semibold text-dark-emphasis">Ask & Tell</span></h1>
        </div>
        <div class="d-flex justify-content-between mt-4 pt-2">
            <span class="border-top border-w"></span>
            <span class="fs-4 fw-semibold text-dark-emphasis">Inquiry Members</span>
            <span class="border-top border-w"></span>
        </div>
    </div>
    <div class="container m-4 row">
            <?php
                // Sql query to be executed for fetching data of librarians and it will be used or displaying further
                $sql = "SELECT * FROM `contacts`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){                       
                echo'
                    <div class="col-lg-4 my-2">
                        <div class="card shadow-lg" style="width: 19rem;">
                            <img src="' . $row['contact_image'] . '" class="card-img-top" alt="librarian image">
                            
                            <ul class="list-group bg-gray list-group-flush">
                                <li class="list-group-item"><img src="partials/img/name.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="name image"> ' . $row['contact_name'] . '</li>
                                <li class="list-group-item"><img src="partials/img/phone.png"
                            class="rounded-circle" height="19px" width="19px" alt="phone image"> ' . $row['contact_phone'] . '</li>
                                <li class="list-group-item"><img src="partials/img/email.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="email image"> ' . $row['contact_email'] . '</li>
                                <li class="list-group-item"><img src="partials/img/clock.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="clock image"> ' . $row['contact_workinghours'] . '</li>
                            </ul>
                        </div>
                    </div>';                          
                }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/_footer.php';?>
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