<?php
require_once("database-connection.php");

if (isset($_SESSION["username"])) {
    header("Location:dashboard.php");
    exit;
}

$msg = '';

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to check user credentials
    $sql = "SELECT `id`, `username`, `password`, `name` FROM `user` WHERE `username`='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set session variables upon successful login
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["name"] = $row["name"];

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $msg =  '<div class="alert alert-danger" role="alert">Invalid password. Please try again.</div>';
        
        }
    } else {
        $msg =  '<div class="alert alert-danger" role="alert">Invalid username. Please try again.</div>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <form action="" method="POST">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                            <?php echo (isset($msg) && $msg != "") ? $msg : ''; ?>
                            <a href="index.php" class="btn btn-secondary">Back to Home</a>
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                    <div class="form-outline form-white mb-4">
                                        <input name="username" type="text" id="username" class="form-control form-control-lg" required />
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>



                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>

                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign
                                            Up</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>