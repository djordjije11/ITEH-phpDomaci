<?php
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Entity.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Brokers/MovieBroker.php";
class Movie extends Entity
{
    private string $name;
    private int $year;
    private string $description;
    public function __toString()
    {
        return $this->name.', '.$this->year;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getYear(): int
    {
        return $this->year;
    }
    public function setYear(int $year): void
    {
        $this->year = $year;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @throws Exception
     */
    public function save() : void
    {
        (new MovieBroker())->save($this);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function delete() : void
    {
        (new MovieBroker())->delete($this);
    }
}