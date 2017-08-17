<?php
require('print.php');

class Test extends PHPUnit_Framework_TestCase
{
  public function testOne(){
    $this->assertEquals(print_Name(),'tww');
  } 
}
?>
