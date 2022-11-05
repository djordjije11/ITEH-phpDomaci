<?php

$root = dirname(__DIR__).DIRECTORY_SEPARATOR."ITEH-phpDomaci".DIRECTORY_SEPARATOR;
define('APP_PATH', $root.'App'.DIRECTORY_SEPARATOR);
define('BROKERS_PATH', APP_PATH.DIRECTORY_SEPARATOR."Brokers".DIRECTORY_SEPARATOR);
define('MODELS_PATH', APP_PATH.DIRECTORY_SEPARATOR."Models".DIRECTORY_SEPARATOR);

require_once MODELS_PATH."Review.php";

$review = new Review();

$review->setText("Scarface has a great storyline, brutal violence as well as having Al Pacino at one of his finest roles. Scarface is one of the best gangster dramas!");
$review->setMovieId(4);
$review->setRating(10);

$review->save();

echo $review;