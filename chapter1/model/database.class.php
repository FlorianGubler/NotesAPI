<?php
class Database
{
    protected $connection = null;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

        if (mysqli_connect_errno()) {
            throw new Exception("Could not connect to database.");
        }
    }

    public function select($query, $types = "", $params = [])
    {
        $stmt = $this->executeStatement($query, $types, $params);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $result;
    }

    public function modify($query, $types = "", $params = [])
    {
        $stmt = $this->executeStatement($query, $types, $params);
        $stmt->close();
        return true;
    }

    public function executeStatement($query, $types, $params)
    {
        $stmt = $this->connection->prepare($query);

        if ($stmt === false) {
            throw new Exception("Unable to do prepared statement: " . $query);
        }

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        return $stmt;
    }
}
