<?php
  
/**
 * @author 
 * @copyright 2017
 */

require('test_api.php');
$error = 0;
// test get
function test_get($class_id){
    global $error;
    $res = http("http://localhost:80/ci-test/class/$class_id", "");
    #echo assert(count($res) == 2*1);
    if (assert(count($res) == 2*1) != 1) #assert(parameter)return 1 if the parameter is true
     $error = 1;  
    #var_dump($res);
}
// test post
function test_post($value1, $value2){
    $res = http("http://localhost:80/ci-test/class", array('name' => $value1, 'count' => $value2), 'POST');
    // $res = json_decode($res);
    // file_put_contents("./log", $res);
    $found = false;
    foreach ($res as $ele){ 
      if($ele['name'] == $value1 && $ele['count'] == $value2){
        $found = true;
      }
    }
    if(assert($found == true) != 1)
     $error = 1;  
    // var_dump($res);
}
// test PUT
function test_put($class_id, $value1, $value2) {
    $res = http("http://localhost:80/ci-test/class/$class_id?name=$value1&count=$value2", "", 'PUT');
    $found = false;
    foreach ($res as $ele){ 
      if($ele['name'] == $value1 && $ele['count'] == $value2){
        $found = true;
      }
    }
   if(assert($found == true) != 1)
     $error = 1;  
    // var_dump($res);
}
// test patch
function test_patch($class_id, $attr, $value) {
    $res = http("http://localhost:80/ci-test/class/$class_id?$attr=$value", "", 'PATCH');
    $found = false;
    foreach ($res as $ele){ 
      if($ele[$attr] == $value){
        $found = true;
      }
    }
    if(assert($found == true) != 1)
     $error = 1;  
    // var_dump($res);
}
// test delete
function test_delete($class_id) {
   $res1 = http("http://localhost:80/ci-test/class/$class_id", "");
   // var_dump($res1);
   $name = $res1['name'];
   $count = $res1['count'];
   
   $res2 = http("http://localhost:80/ci-test/class/$class_id", "", 'DELETE'); 
   $found = false;
   foreach ($res2 as $ele){ 
      if($ele['name'] == $name && $ele['count'] == $count) {
        $found = true;
      }
   }
   if( assert($found == false) != 1)
     $error = 1;
   // var_dump($res2);
}
echo "Test GET!\n";
test_get(1); //right
echo "Test POST!\n";
test_post('SAT', 30);
echo "Test PUT!\n";
test_put(1, 'SAT', 30);
echo "Test PATCH!\n";
test_patch(2, 'count', 26);
echo "Test DELETE!\n";
test_delete(1);
if ($error){
  echo "failed!\n";
  exit(1);
}
else{
  echo "Test end, all passed!\n";
  exit(0);
}
?>
