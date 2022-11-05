<?php
include $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/Definitions/definitions.php";
require_once MODELS_PATH. "Movie.php";

class MovieDeleteController
{
    public function handle(): array
    {
        $movie = new Movie();
        $movie->setId($_POST['id']);
        try {
            $movie->delete();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Failed while deleting!'];
        }
        return ['success' => true];
    }
}
echo json_encode((new MovieDeleteController())->handle());