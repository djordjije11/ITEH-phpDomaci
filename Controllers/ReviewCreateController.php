<?php
include $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/Definitions/definitions.php";
require_once MODELS_PATH. "Review.php";
class ReviewCreateController
{
    public function handle(): array
    {
        $review = new Review();

        $review->setText($_POST['reviewText']);
        $review->setRating($_POST['rating']);
        $review->setMovieId($_POST['movieId']);

        try {
            $review->save();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Failed while saving!'];
        }
        return ['success' => true];
    }
}

echo json_encode((new ReviewCreateController)->handle());