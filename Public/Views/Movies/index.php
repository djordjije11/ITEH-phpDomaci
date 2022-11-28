<?php
include $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/Definitions/definitions.php";
require_once BROKERS_PATH."EntityBroker.php";
require_once BROKERS_PATH."MovieBroker.php";

$movies = new MovieBroker();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

<main class="container fluid">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link home text-info" aria-current="page" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link add new movie text-info" aria-current="page" href="\ITEH-phpDomaci\Public\Views\Movies\moviesadd.php">Add a new movie</a>
  </li>
</ul>

<div class="mb-4">
    <!-- MENJAJ OVOOOOOOOOOOOOOOOOO -->
        <h1 class="mb-3">List of movies</h1>
        <div class="alert alert-danger" style="display: none;" role="alert" id="movieDeleteFalse"></div>
        <div class="alert alert-success" style="display: none;" role="alert" id="movieDeleteTrue">
            ✨ Success!
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($movies->getAllEntities() as $movie): ?>
                    <tr>
                        <td><?= $movie->getId(); ?></td>
                        <td><?= $movie->getName(); ?></td>
                        <td><?= $movie->getYear(); ?></td>
                        <td style="font-size: small;"><?= $movie->getDescription(); ?></td>
                        <td>
                            <a href="/ITEH-phpDomaci/Public/Views/Reviews/reviewsview.php?id=<?= $movie->getId(); ?>">
                                <button class="btn btn-outline-secondary">View reviews</button>
                            </a> 
                        </td>
                        <td>
                        <button type="button" class="btn btn-outline-secondary" onclick="deleteRow(this, <?= $movie->getId(); ?>,
                                        '/ITEH-phpDomaci/Controllers/MovieDeleteController.php', '#movieDeleteFalse', '#movieDeleteTrue')">
                                Delete movie
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script src="/ITEH-phpDomaci/Public/Javascript/delete.js"></script>
</body>
</html>