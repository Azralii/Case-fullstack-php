<?php
require_once("database-connection.php");

if (isset($_SESSION["username"])) {
    header("Location:dashboard.php");
    exit;
}
$msg = '';
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user data into the database
    $sql = "INSERT INTO `user` (`name`, `username`, `password`) VALUES ('$name', '$username', '$hashedPassword')";

    if ($mysqli->query($sql) === TRUE) {
        $msg =  '<div class="alert alert-success" role="alert">Registration successful!</div>';
    } else {

        $msg =  '<div class="alert alert-danger" role="alert">' . 'Error: ' . $sql . '<br>' . $mysqli->error . '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <form action="" method="POST">
                            <div class="card-body p-5 text-center">
                                <?php echo (isset($msg) && $msg != "") ? $msg : ''; ?>
                                <a href="index.php" class="btn btn-secondary">Back to Home</a>
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                    <p class="text-white-50 mb-5">Please enter your username and password!</p>

                                    <div class="form-outline form-white mb-4">
                                        <input name="name" type="text" id="name" class="form-control form-control-lg" required />
                                        <label class="form-label" for="name">Name</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input name="username" type="text" id="username" class="form-control form-control-lg" required />
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>



                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>

                                </div>

                                <div>
                                    <p class="mb-0">Do you have an account? <a href="login.php" class="text-white-50 fw-bold">Sign
                                            In</a>
                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>