<?php

include_once "../DB.php";
class CategoryModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new CategoryModel();
        }

        return self::$instance;
    }

    public static function getAllClient()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM categories WHERE status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getById($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM categories WHERE id='$Id' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
