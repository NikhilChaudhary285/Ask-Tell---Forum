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
    <title>About - Ask & Tell</title>

</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>

    <!-- Website Content -->
    <div class="mh-90vh mt-4 pt-4">
        <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded about_intro">
            <img src="partials/img/forumicon.jpg" class="rounded-circle d-block mx-auto" height="46px" width="62px"
                alt="forum icon">
            <div class="d-flex justify-content-between pt-4 pb-2">
                <span class="border-top border-w"></span>
                <span class="fs-4 fw-semibold text-dark-emphasis">Ask & Tell</span>
                <span class="border-top border-w"></span>
            </div>
            <p><span class="fs-1 fw-semibold text-dark-emphasis">Ask&Tell</span> has been founded recently and is an
                online discussion board where people can ask questions, share their experiences, and discuss topics of
                mutual interest. iDiscuss is an excellent way to create social connections and a sense of community.</p>
            <p>Its motive to provide a platform where people can discuss about knowledgable topics and help each other
                to fix issues of any topic. It can also help you to cultivate an interest group about a particular
                subject.</p>
            <div class="d-flex justify-content-between">
                <span class="border-top border-w"></span>
                <a class="anchorcontact" href="contact.php"><span class="fs-4 fw-semibold text-dark-emphasis">Contact
                        Us</span></a>
                <span class="border-top border-w"></span>
            </div>
        </div>
    </div>
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