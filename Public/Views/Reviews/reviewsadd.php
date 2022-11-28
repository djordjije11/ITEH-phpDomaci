<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ITEH-phpDomaci/Controllers/ReviewViewController.php";

$controller = new ReviewViewController();
$movie = null;
$movieId = $_GET['id'];
try {
    $movie = $controller->getMovieById($movieId);
} catch (Exception $e) { }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a new review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<main class="container fluid">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link home text-info" aria-current="page" href="../Movies/index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link add new review text-info" aria-current="page" href="./reviewsview.php?id=<?= $movieId ?>"><?= $movie ?> - Reviews</a>
  </li>
</ul>
    <h2 class="mb-4"><?= $movie ?></h2>
    <h3 class="mb-4">Add a review</h3>
    <div class="alert alert-danger" style="display: none;" role="alert" id="reviewSavedFalse"></div>
    <div class="alert alert-success" style="display: none;" role="alert" id="reviewSavedTrue">
        Success!
    </div>
    
    <div class="mb-4">
    <form>
  <div class="form-group row">
    <label for="rating" class="col-sm-2 col-form-label">Rating</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rating">
    </div>
  </div>
  <div class="form-group row">
    <label for="reviewText" class="col-sm-2 col-form-label">Review</label>
    <div class="col-sm-10">
      <textarea placeholder="Your impressions..." class="form-control" id="reviewText" rows="7"></textarea>
    </div>
  </div>
  <button type="button" id="saveReview" class="btn btn-info mb-4" 
  onclick="addReview(<?= $movieId ?>, '#rating', '#reviewText', '/ITEH-phpDomaci/Controllers/ReviewCreateController.php', '#reviewSavedTrue', '#reviewSavedFalse')">
  Save a review
</button>
</form> 
</div>

</main>
<script src="/ITEH-phpDomaci/Public/Javascript/create.js"></script>
<script src="/ITEH-phpDomaci/Public/Javascript/createReview.js"></script>
</body>
</html>