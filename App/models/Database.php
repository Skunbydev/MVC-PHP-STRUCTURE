<?php

class Database
{
    protected function getConnection()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=mvc_structure", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
}
