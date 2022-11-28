<?php

require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Brokers/MovieBroker.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Brokers/ReviewBroker.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Review.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Movie.php";

class ReviewViewController
{
    
    public function getMovieById($id) : ?Movie
    {
        if(!$id) {
            return null;
        }
        $broker = new MovieBroker();
        return $broker->getEntityById($id);
    }
    public function getReviewsForMovie(Movie $movie) : array
    {
        return (new ReviewBroker())->getReviewsForMovie($movie);
    }
}