<?php

abstract class Model {

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $this->dbh = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASSWORD);
    }

    public function query($query)
    {
        $this->stmt = $this -> dbh -> prepare($query);
    }

    public function bind($param, $value, $type=null)
    {
        if(is_null($type)) {
            if(is_int($value)) {
                $type = PDO::PARAM_INT;
            }
            else if (is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            }
            else if (is_null($value)) {
                $type = PDO::PARAM_NULL;
            }
            else {
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet() // zwraca zestaw pasujących danych w postaci tabeli assoc
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount() // zwraca liczbę wierszy, na które podziałało zapytanie
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId() // zwraca ID z bazy ostatniego wstawionego wiersza
    {
        return $this->dbh->lastInsertId();
    }

    public function single() // zwraca pojedynczy wiersz w wyniku zapytania (czy user o takich danych istnieje)
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}