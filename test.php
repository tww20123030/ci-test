<?php
  
/**
 * @author 
 * @copyright 2017
 */

require('test_api.php');

// test get
function test_get($class_id){
    $res = http("http://localhost:8082/restful_api/class/$class_id", "");
    assert(count($res) == 2*1);  
    // var_dump($res);
}
// test post
function test_post($value1, $value2){
    $res = http("http://localhost:8082/restful_api/class", array('name' => $value1, 'count' => $value2), 'POST');
    // $res = json_decode($res);
    // file_put_contents("./log", $res);
    $found = false;
    foreach ($res as $ele){ 
      //echo "This Site url is $url! <br />"; 
      if($ele['name'] == $value1 && $ele['count'] == $value2){
        $found = true;
      }
    }
    assert($found == true); 
    // var_dump($res);
}
// test PUT
function test_put($class_id, $value1, $value2) {
    $res = http("http://localhost:8082/restful_api/class/$class_id?name=$value1&count=$value2", "", 'PUT');
    $found = false;
    foreach ($res as $ele){ 
      //echo "This Site url is $url! <br />"; 
      if($ele['name'] == $value1 && $ele['count'] == $value2){
        $found = true;
      }
    }
    assert($found == true);
    // var_dump($res);
}
// test patch
function test_patch($class_id, $attr, $value) {
    $res = http("http://localhost:8082/restful_api/class/$class_id?$attr=$value", "", 'PATCH');
    $found = false;
    foreach ($res as $ele){ 
      //echo "This Site url is $url! <br />"; 
      if($ele[$attr] == $value){
        $found = true;
      }
    }
    assert($found == true);
    // var_dump($res);
}
// test delete
function test_delete($class_id) {
   $res1 = http("http://localhost:8082/restful_api/class/$class_id", "");
   // var_dump($res1);
   $name = $res1['name'];
   $count = $res1['count'];
   
   $res2 = http("http://localhost:8082/restful_api/class/$class_id", "", 'DELETE'); 
   $found = false;
   foreach ($res2 as $ele){ 
      //echo "This Site url is $url! <br />"; 
      if($ele['name'] == $name && $ele['count'] == $count) {
        $found = true;
      }
   }
   assert($found == false);
   // var_dump($res2);
}
test_get(1);
test_post('SAT', 30);
test_put(1, 'SAT', 30);
test_patch(2, 'count', 26);
test_delete(1);
?>
