<?php

namespace Repository\Database;

class Connection
{
    private $DB;

    public function Connector($Query)
    {
        try {
            $this->DB = new \PDO("mysql:host=localhost;dbname=ticket;", 'root', '');

            $Statement = $this->DB->prepare($Query);

            $Statement->execute();

            return $Statement;
        }
        catch (\Exception $l)
        {
            $l->getMessage();
        }
    }
}