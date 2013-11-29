<?php 
	include ('../Tash.php');
	$tash = new Tash(dirname(__FILE__).'/');
	
	$data = array(
		"name" => "Chris",
		"value" => 10000,
		"taxed_value" => 10000 - (10000 * 0.4),
		"in_ca" => true,
		"company" => "<b>GitHub</b>",
		"repo" => array(
		    array("name"=>"resque"),
				array("name"=>"hub" ),
				array("name"=>"rip" )
		  ),
		"person?" => array("name"=>"Jon"),
		"names" => array(
			array("name"=>"Tom"),
			array("name"=>"Dick"),
			array("name"=>"Harry")
		)
	);
	
	echo $tash->render_file('example.html',$data);
?>