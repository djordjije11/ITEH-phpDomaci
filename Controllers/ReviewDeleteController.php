<?php
include $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/Definitions/definitions.php";
require_once MODELS_PATH. "Review.php";

class ReviewDeleteController
{
    public function handle(): array
    {
        $review = new Review();
        $review->setId($_POST['id']);
        try {
            $review->delete();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Failed while deleting!'];
        }
        return ['success' => true];
    }
}
echo json_encode((new ReviewDeleteController())->handle());