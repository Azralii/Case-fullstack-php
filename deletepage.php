<?php
    require_once("database-connection.php");
    if (!isset($_SESSION["username"])) {
        header("Location:login.php");
        exit;
    }

 // Check if the 'id' parameter is set in the URL and is numeric
if (isset($_GET['id']) && $_GET['id'] != "" && is_numeric($_GET['id'])) {
    // Get the page_id from the URL parameter
    $page_id = $_GET['id'];

    // Delete entries from the 'image' table where 'page_id' is given
    $deleteImageSQL = "DELETE FROM `image` WHERE `page_id` = '$page_id'";
    if ($mysqli->query($deleteImageSQL) === TRUE) {
        // Delete the page from the 'page' table where 'id' is given
        $deletePageSQL = "DELETE FROM `page` WHERE `id` = '$page_id'";
        if ($mysqli->query($deletePageSQL) === TRUE) {
            // Redirect to the dashboard or a success page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error deleting page: " . $mysqli->error;
        }
    } else {
        echo "Error deleting images: " . $mysqli->error;
    }
} else {
    // Redirect to the dashboard if 'id' parameter is not set or is not numeric
    header("Location: dashboard.php");
    exit();
}
