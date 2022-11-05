<?php
require_once MODELS_PATH."Entity.php";
require_once APP_PATH."DatabaseConnector".DIRECTORY_SEPARATOR."dbConnector.php";
abstract class EntityBroker
{
    protected DbConnector $database;
    abstract protected function getEntityFromRow(array $row) : Entity;
    abstract protected function getTableName() : string;
    public function __construct()
    {
        $this->database = new DbConnector();
    }
    public function delete(Entity $entity) : void
    {
        $id = $entity->getId();
        if(!$id) throw new Exception("Missing ID!");
        $this->database->connect();
        $statement = $this->database->prepareStatement("delete from {$this->getTableName()} where id = ?");
        $statement->bind_param('i', $id);
        if($statement->execute()) {
            $entity->setId(null);
        }
        $statement->close();
        $this->database->disconnect();
    }
    protected function getEntityById(int $id) : ?Entity
    {
        $this->database->connect();
        $statement = $this->database->prepareStatement("SELECT * FROM {$this->getTableName()} where id = ?");
        $statement->bind_param("i", $id);
        $record = null;
        if($statement->execute()) {
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                $record = $this->getEntityFromRow($row);
            }
        }
        $statement->close();
        $this->database->disconnect();
        return $record;
    }
    protected function getAllEntities(string $query, string $bindingString = null, array $bindingValues = []) : array
    {
        $this->database->connect();
        $statement = $this->database->prepareStatement("SELECT * FROM ".$this->getTableName());
        if($bindingString && count($bindingValues) === strlen($bindingString)) {
            $statement->bind_param($bindingString, ...$bindingValues);
        }
        $records = [];
        if($statement->execute()) {
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                $records[] = $this->getEntityFromRow($row);
            }
        }
        $statement->close();
        $this->database->disconnect();
        return $records;
    }
}