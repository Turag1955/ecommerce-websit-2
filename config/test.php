<?php

/*
  require_once './database.php';
  require_once './function.php';
  $obj = new query();
  $obj2 = new tool();
  $condition = ['id' =>3];
  //$result = $obj->getData('users','*',$condition);
  //$result = $obj->deleteData('users',$condition);
  //echo $result;
  //$obj2->pr($result);
 * 
 */

class class1 {

    function __construct() {
        $this->x = 'hello';
        return $this->x;
    }

}

$obj = new class1();
echo $obj->x;
?>