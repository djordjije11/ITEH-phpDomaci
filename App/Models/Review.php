<?php
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Models/Entity.php";
require_once $_SERVER['DOCUMENT_ROOT']."/ITEH-phpDomaci/App/Brokers/ReviewBroker.php"; 
class Review extends Entity
{
    private string $text;
    private int $movieId;
    private int $rating;
    public function __toString()
    {
        return $this->text.' - '.$this->rating;
    }
    public function getText() : string {
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }
    public function getMovieId() : int {
        return $this->movieId;
    }
    public function setMovieId($movieId){
        $this->movieId = $movieId;
    }
    public function getRating() : int{
        return $this->rating;
    }
    public function setRating($rating){
        $this->rating = $rating;
    }

    /**
     * @throws Exception
     */
    public function save() : void
    {
        (new ReviewBroker())->save($this);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function delete() : void
    {
        (new ReviewBroker())->delete($this);
    }
}