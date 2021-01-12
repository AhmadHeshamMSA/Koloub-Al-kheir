<?php

include_once 'Config.php';

class Employees {

    public $id;
    public $name;
    public $address;
    public $salary;
    public $rank;
    public $PhoneNumber;

    function __construct ( $id, $name, $address, $salary, $rank, $PhoneNumber)
    {
         $db = DBConnection::getInstance();
         $this->id = $id;
         $this->name = $name;
         $this->address = $address;
         $this->salary = $salary;
         $this->rank = $rank;
         $this->PhoneNumber = $PhoneNumber;
     }

     public static function SelectAllEmployees()
     {
        $sql = "SELECT * FROM employees order by id";
         $EmplyeesDataSet = mysql_query($sql) or die(mysql_error());

         $i=0;
         $result;
         while ($row = mysql_fetch_array($EmplyeesDataSet)) {
             $MyObj= new Employees($row["id"]);
             $result[$i]=$MyObj;
             $i++;
         }
         return $result;   
     }

}

?>