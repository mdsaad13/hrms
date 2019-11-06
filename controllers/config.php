<?php

/**
 * Database connection 
 */
abstract class DB
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $DBName = "hrms";

    protected function DB_Connect(bool $flag)
    {
        if ($flag == TRUE) {
            R::setup("mysql:host=" . $this->host . ";dbname=" . $this->DBName, $this->username, $this->password);
            R::useFeatureSet("novice/latest");
        } else if ($flag == FALSE) {
            R::close();
        }
    }
}
