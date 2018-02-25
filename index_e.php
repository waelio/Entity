<?php
/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 2/1/2016
 * Time: 1:35 PM
 */

require 'Entity.php';


echo 'Hello';


$test = new Entity();
//echo $test;
debug_this($test);

//$test->initiate();



function debug_this($val){

	echo "<pre>".print_r($val,true)."</pre>";

}