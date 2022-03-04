<?php
ini_set("display_errors", "on");
require "vendor/autoload.php";


use Messenger\Messenger;


$messenger = new Messenger;


$user_data = [
			'firstname' => "James",
			'lastname' => "John"
	];


$messenger->sendMessage("theoafactor@gmail.com", "Welcome to our Website", $user_data, "email.html"); //send your message









