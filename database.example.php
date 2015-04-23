<?php
class Database
{
    private static $dbName = '' ;
    private static $dbHost = '' ;
    private static $dbUserName = '';
    private static $dbUserPassword = '';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbName=".self::$dbName, self::$dbUserName, self::$dbUserPassword); 
		  self::$cont->query("use ".self::$dbName);
		}
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>