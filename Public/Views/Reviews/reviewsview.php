<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ITEH-phpDomaci/Controllers/ReviewViewController.php";

$controller = new ReviewViewController();

$movie = null;
$reviews = [];
try {
    $movie = $controller->getMovieById();
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
            <?= 'Home / ' . $movie ?>
        <?php else: ?>
            Home / Error
        <?php endif; ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <nav aria-label="breadcrumb" class="mb-5">
        <h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../Movies/index.php" class="link-primary" style="text-decoration: none">Home</a></li>
                <?php if($movie) : ?>
                    <li class="breadcrumb-item active" aria-current="page">
                      <?= $movie ?>
                    </li>
                <?php endif; ?>
            </ol>
        </h3>
    </nav>

    <?php if($movie) : ?>
        <hr class="my-3" />

        <div class="mb-4">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <a href="./reviewsadd.php?id=<?= $movie->getId() ?>"
                        class="btn btn-dark mb-4">Add a review</a>
            </div>

            <h2 class="mb-4">Reviews</h2>

            <div class="alert alert-danger" style="display: none;" role="alert" id="reviewDeleteFalse"></div>
            <div class="alert alert-success" style="display: none;" role="alert" id="reviewDeleteTrue">
                ✨ Success!
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