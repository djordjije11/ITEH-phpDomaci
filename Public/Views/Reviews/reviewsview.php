<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ITEH-phpDomaci/Controllers/ReviewViewController.php";

$controller = new ReviewViewController();

$movie = null;
$reviews = [];
try {
    $movie = $controller->getMovieById($_GET['id']);
    $reviews = $movie ? $controller->getReviewsForMovie($movie) : [];
} catch (Exception $e) { }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php if($movie) : ?>
            <?= $movie ?>
        <?php else: ?>
            Error
        <?php endif; ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link home text-info" aria-current="page" href="../Movies/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link add new movie text-info" aria-current="page" href="./reviewsadd.php?id=<?= $movie->getId() ?>">Add a new review</a>
        </li>
    </ul>
    <h2>
        <?= $movie ?>
    </h2>

    <?php if($movie) : ?>
        <hr class="my-3" />

        <div class="mb-4">

            <h2 class="mb-4">Reviews</h2>

            <div class="alert alert-danger" style="display: none;" role="alert" id="reviewDeleteFalse"></div>
            <div class="alert alert-success" style="display: none;" role="alert" id="reviewDeleteTrue">
                Success!
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Text</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($reviews as $review): ?>
                    <tr>
                        <td><?= $review->getId(); ?></td>
                        <td><?= $review->getText(); ?></td>
                        <td><?= $review->getRating(); ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteRow(this, <?= $review->getId(); ?>,
                                            '/ITEH-phpDomaci/Controllers/ReviewDeleteController.php', '#reviewDeleteFalse', '#reviewDeleteTrue')">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Cannot load contact information.
        </div>
    <?php endif; ?>
</main>

<?php if($movie) : ?>
    <script src="/ITEH-phpDomaci/Public/Javascript/delete.js"></script>
<?php endif; ?>
</body>
</html>