<?php
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Entity.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/DatabaseConnector/dbConnector.php";
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
    public function getEntityById(int $id) : ?Entity
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
    public function getAll($query , string $bindString = null, array $bindValues = []) : array
    {
        $this->database->connect();
        $statement = $this->database->prepareStatement($query);
        if($bindString && count($bindValues) === strlen($bindString)) {
            $statement->bind_param($bindString, ...$bindValues);
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