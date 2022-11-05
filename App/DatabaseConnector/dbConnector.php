<?php
class DbConnector
{
    private string $server = 'localhost';
    private string $database = 'dr20190162';
    private string $user = 'root';
    private string $password = '';
    private mysqli $connection;

    /**
     * @return void
     * @throws Exception
     */
    public function connect() : void
    {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->database);
        if ($this->connection->connect_errno) {
            throw new Exception("Unable to connect to database!");
        }
        $this->connection->set_charset("utf8");
    }
    public function disconnect() : void
    {
        $this->connection->close();
    }
    public function prepareStatement(string $sql) : mysqli_stmt
    {
        return $this->connection->prepare($sql);
    }
}