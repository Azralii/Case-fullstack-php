<?php

require_once("database-connection.php");

if (!isset($_SESSION["username"])) {

    header("Location:login.php");

    exit;

}



$userID = $_SESSION["user_id"];



$pages = array();

$pagesResult = $mysqli->query("select * from page where user_id = '$userID' order by id asc");

if ($pagesResult->num_rows > 0) {

    while ($record = $pagesResult->fetch_assoc()) {

        $pages[$record['id']] = $record;

    }

}



$pagesResult->free();





?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | <?php echo $_SESSION["username"] ?></title>

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

                    <a target="_blank" href="index.php" class="btn btn-outline-secondary">View App <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                </div>

            </div>

        </div>

    </header>



    <div class="container">

        <div class="add-btn d-flex justify-content-between my-4">

            <h3>Pages List</h3>

            <a href="addpage.php" class="btn btn-primary text-white text-start"><i class="fa-solid fa-circle-plus"></i> Add New Page</a>

        </div>







        <div class="tab-content" id="v-pills-tabContent">

            <table class="table text-center table-dark table-striped">

                <thead>

                    <tr>

                        <th scope="col">#</th>

                        <th scope="col">Page Title</th>

                        <th scope="col">URL</th>

                        <th scope="col">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (is_array($pages) && sizeof($pages) > 0) {

                        $page_counter = 1;

                        foreach ($pages as $pageID => $pg) {

                    ?>

                            <tr>

                                <th><?php echo $page_counter ?></th>

                                <td><?php echo $pg['title'] ?></td>

                                <td style="width: 50%;"><?php echo $base_url . 'page.php?id=' . $pageID ?>

                                    <a target="_blank" class="btn btn-secondary ms-3" href="<?php echo $base_url . 'page.php?id=' . $pageID ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                                </td>

                                <td>

                                    <a class="btn btn-success" href="updatepage.php?id=<?php echo $pageID ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                                    <?php if($pageID  != "1"){ ?>

                                    <a class="btn btn-danger" onclick="confirmDeletePage(<?php echo $pageID ?>)"><i class="fa-solid fa-trash"></i> Delete</a>

                                    <?php }  ?>

                                </td>

                            </tr>

                    <?php

                    $page_counter++;

                        }

                    }

                    ?>



                </tbody>

            </table>

        </div>

    </div>













    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">



        <!-- Copyright -->

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">

            © 2024 Copyright Abdalla

        </div>

        <!-- Copyright -->

    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        function confirmDeletePage(pageId) {

            // Show a confirmation dialog

            var confirmation = confirm("Do you want to delete this page?");



            // If the user clicks "OK" in the confirmation dialog

            if (confirmation) {

                // Redirect to deletepage.php with the pageId parameter

                window.location.href = "deletepage.php?id=" + pageId;

            }

        }

    </script>



</body>



</html>