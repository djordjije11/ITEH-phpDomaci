<?php

require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Review.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Entity.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Brokers/EntityBroker.php";
class ReviewBroker extends EntityBroker
{
    public function getReviewsForMovie(Movie $movie) : array
    {
        return $this->getAll(
            "SELECT * FROM reviews
         where movie_id = ?", "i", [$movie->getId()]
        );
    }
    public function getAllEntities() : array{
        return $this->getAll("SELECT * FROM {$this->getTableName()}");
    }
	function getEntityFromRow(array $row): Entity {
        $record = new Review();
        $record->setId($row['id']);
        $record->setText($row['text']);
        $record->setMovieId($row['movie_id']);
        $record->setRating($row['Rating']);
        return $record;
	}
	protected function getTableName(): string
    {
        return 'reviews';
    }
    public function save(Review $review) : void
    {
        $this->database->connect();
        $text = $review->getText();
        $movieId = $review->getMovieId();
        $rating = $review->getRating();
        if($id = $review->getId()) {
            $statement = $this->database->prepareStatement("update reviews set text = ?, movie_id = ?, rating = ? where id = ?");
            $statement->bind_param("siii", $text, $movieId, $rating, $id);
            if(!$statement->execute()) {
                throw new Exception("Failed updating review!");
            }
        } else {
            $statement = $this->database->prepareStatement("insert into reviews(text, movie_id, rating) values(?, ?, ?)");
            $statement->bind_param("sii", $text, $movieId, $rating);
            if($statement->execute()) {
                $review->setId($statement->insert_id);
            } else {
                throw new Exception("Failed creating new review!");
            }
        }
        $statement->close();
        $this->database->disconnect();
    }
}