<?php
// echo "working";exit;
require_once("database-connection.php");


$pages = array();
$pagesResult = $mysqli->query('select * from page order by id asc');
if ($pagesResult->num_rows > 0) {
	while ($record = $pagesResult->fetch_assoc()) {
		$pages[$record['id']] = $record;
	}
} else {
	header("Location:404.php");
}

$images = array();
$imagesResult = $mysqli->query('select * from image order by id asc');
if ($imagesResult->num_rows > 0) {
	while ($imgrecord = $imagesResult->fetch_assoc()) {
		$images[$imgrecord['id']] = $imgrecord;
	}
}

$pagesResult->free();
$imagesResult->free();

$homePage = $pages['1'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $homePage['title'] ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


	<header class="p-3 bg-dark text-white">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
						<use xlink:href="#bootstrap" />
					</svg>
				</a>

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<?php
					foreach ($pages as $pageID => $pg) {
					?>
						<li><a href="page.php?id=<?php echo $pageID ?>" class="nav-link px-2 text-white"><?php echo $pg['title'] ?></a></li>
					<?php
					}
					?>

				</ul>

				<?php if (isset($_SESSION["username"]) && $_SESSION["username"] != "") { ?>
					<div class="text-end">
						<a href="dashboard.php" class="btn btn-success me-2">Dashboard</a>
						<a href="logout.php" class="btn btn-danger">Logout</a>
					</div>

				<?php } else { ?>
					<div class="text-end">
						<a href="login.php" class="btn btn-outline-light me-2">Login</a>
						<a href="register.php" class="btn btn-warning">Register</a>
					</div>
				<?php } ?>

			</div>
		</div>
	</header>


	<div class="d-flex align-items-start bg-light m-1  text-dark" style="min-height: 65vh;">
		<div class="nav flex-column nav-pills me-3 bg-dark" id="v-pills-tab" style="width: 20%;min-height: 65vh;" role="tablist" aria-orientation="vertical">
			<button class="nav-link active text-white text-start" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><?php echo $homePage['title'] ?></button>

		</div>
		<div class="tab-content" id="v-pills-tabContent" style="width: 70%;">
			<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
				<p><?php echo $homePage['content'] ?></p>

				<?php
				if (is_array($images) && sizeof($images) > 0) {
				?>
					<div class="row">
						<?php
						foreach ($images as $img) {
						?>
							<div class="col-md-4 mb-3">
								<a target="_blank" href="page.php?id=<?php echo $img['page_id'] ?>">
									<img src="<?php echo $img['url'] ?>" alt="" class="img-fluid"></a>
							</div>
						<?php
						}
						?>

					</div>

				<?php
				}
				?>

			</div>


		</div>
	</div>





	<footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
		<!-- Grid container -->
		<div class="container p-4">
			<!--Grid row-->
			<div class="row mt-4">
				<!--Grid column-->
				<div class="col-lg-412 col-md-12 mb-4 mb-md-0">
					<h5 class="text-uppercase mb-4">About liibaan</h5>

					<p>
						At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
						voluptatum deleniti atque corrupti.
					</p>

					<p>
						Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
						molestias.
					</p>


				</div>
				<!--Grid column-->




			</div>
			<!--Grid row-->
		</div>
		<!-- Grid container -->

		<!-- Copyright -->
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
			© 2024 Copyright liibaan 
		</div>
		<!-- Copyright -->
	</footer>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>