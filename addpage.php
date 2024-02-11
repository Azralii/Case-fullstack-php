<?php
require_once("database-connection.php");
if (!isset($_SESSION["username"])) {
    header("Location:login.php");
    exit;
}

$msg = '';
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]) && $_POST["submit"] == "addpage") {
    // Retrieve user input
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $img1 = isset($_POST["img1"]) ? $_POST["img1"] : "";

    $user_id = $_SESSION["user_id"];

    // Insert page data into the 'page' table
    $insertPageSQL = "INSERT INTO `page` (`title`, `content`, `user_id`) VALUES ('$title', '$content', '$user_id')";
    if ($mysqli->query($insertPageSQL) === TRUE) {
        // Retrieve the last inserted page_id
        $page_id =$mysqli->insert_id;

        // Insert image URLs into the 'image' table with the current created page_id
        $insertImageSQL1 = "INSERT INTO `image` (`url`, `page_id`) VALUES ('$img1', '$page_id')";
       $mysqli->query($insertImageSQL1);

      

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $msg =  '<div class="alert alert-danger" role="alert">Error adding page: '.$mysqli->error.' </div>';
       
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

</head>

<body>


    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">


                <h2><i class="fa-solid fa-user"></i> Welcome <?php echo $_SESSION["name"] ?> (<?php echo $_SESSION["username"] ?>)</h2>

                <div class="text-end">
                    <a href="logout.php" class="btn btn-danger">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
                    <a href="dashboard.php" class="btn btn-secondary">Go Back</i></a>
                </div>
            </div>
        </div>
    </header>


    <div class="container my-4">
        <h4>Add New Page</h4>
        
        <?php echo (isset($msg) && $msg != "") ? $msg : ''; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="pagetitle" class="form-label">Page title</label>
                <input type="text" name="title" class="form-control" required id="pagetitle">
            </div>
            <div class="mb-3">
                <label for="pagecontent" class="form-label">Page Content</label>
                <textarea class="form-control" required name="content" id="pagecontent" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="imageurl1" class="form-label">Page image URL</label>
                <input type="text" name="img1" class="form-control" required id="imageurl1">
            </div>
          

            <button type="submit" name="submit" value="addpage" class="btn btn-success">Save</button>
        </form>
    </div>






    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright Abdalla
        </div>
        <!-- Copyright -->
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>