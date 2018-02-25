<?php
/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 3/5/2016
 * Time: 1:08 PM
 */


require 'Idea.php';


$father = new Idea(array('name' => 'Salsa'));

$father->setType('span');
$father->set_content('htgfghfghfgh fghf');





//echo $father->getType();

$father->display();




//debug_this($father);




function debug_this($val){

	echo "<pre>".print_r($val,true)."</pre>";

}
