<?php

// Base model class shared by all database models.
abstract class Model
{
    protected PDO $db;

// Open the shared PDO database connection when a model is created.
    public function __construct()
    {
        $this->db = Database::getConnection();
    }
}
