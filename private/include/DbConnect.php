<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 8/31/2021
 * Time: 8:27 PM
 */

class dbConnect
{
    private $dbdsn = "mysql:host=localhost;dbname=oop-db";
    private $dbuname = "root";
    private $dbpass = "";
    private $pdo = NULL;

    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->dbdsn, $this->dbuname, $this->dbpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die ("An Error Occured : " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

}