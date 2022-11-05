<?php
require_once MODELS_PATH."Movie.php";
require_once MODELS_PATH."Entity.php";
require_once BROKERS_PATH."EntityBroker.php";

class MovieBroker extends EntityBroker
{
	function getEntityFromRow(array $row): Entity {
        $record = new Movie();
        $record->setId($row['id']);
        $record->setName($row['name']);
        $record->setYear($row['year']);
        $record->setDescription($row['description']);
        return $record;
	}
    public function save(Movie $movie) : void
    {
        $this->database->connect();
        $name = $movie->getName();
        $year = $movie->getYear();
        $description = $movie->getDescription();
        if($id = $movie->getId()) {
            $statement = $this->database->prepareStatement("update movies set name = ?, year = ?, description = ? where id = ?");
            $statement->bind_param("sisi", $name, $year, $description, $id);
            if(!$statement->execute()) {
                throw new Exception("Failed updating movie!");
            }
        } else {
            $statement = $this->database->prepareStatement("insert into movies(name, year, description) values(?, ?, ?)");
            $statement->bind_param("sis", $name, $year, $description);
            if($statement->execute()) {
                $movie->setId($statement->insert_id);
            } else {
                throw new Exception("Failed creating new movie!");
            }
        }
        $statement->close();
        $this->database->disconnect();
    }
    protected function getTableName() : string{
        return 'movies';
    }
}