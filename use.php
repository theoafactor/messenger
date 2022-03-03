<?php
ini_set("display_errors", "on");
require "vendor/autoload.php";


use Dragon\Dragon;


$dragon = new Dragon;


$user_data = [
			'firstname' => "James",
			'lastname' => "John"
	];

$dragon->sendMessage("theoafactor@gmail.com", "Welcome to our Website", $user_data, "email.html"); //send your message









