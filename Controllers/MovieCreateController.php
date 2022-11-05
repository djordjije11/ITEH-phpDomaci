<?php
include $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/Definitions/definitions.php";
require_once MODELS_PATH. "Movie.php";
class MovieCreateController
{
    public function handle(): array
    {
        $movie = new Movie();

        $movie->setName($_POST['name']);
        $movie->setYear($_POST['year']);
        $movie->setDescription($_POST['description']);

        try {
            $movie->save();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Failed while saving!'];
        }
        return ['success' => true];
    }
}

echo json_encode((new MovieCreateController)->handle());