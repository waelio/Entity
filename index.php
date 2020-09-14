<?php

/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 3/5/2016
 * Time: 1:08 PM
 */


require 'Idea.php';


$father = new Idea(null, array('name' => 'Salsa'));

$father->setType(strval('div'));
$father->set_content("This a Test");
$father->setAttribute(array("id" => 'app'));
$father->setAttribute(array("data-name" => $father->getAttribute('name')));
$father->setAttribute(array("style" => "background-color:red; padding:0 10px;"));

$father->display();

// debug_this($father);




function debug_this($val)
{

	echo "<pre>" . print_r($val, true) . "</pre>";
}
