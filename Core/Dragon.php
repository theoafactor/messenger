<?php

namespace Dragon;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require "vendor/autoload.php";



class Dragon {


	public $firstname;
	public $lastname;
	public $middlename;
	public $email_addrress;
	public $message;


	/**
	 * Private data
	 */
	

	
	public function __construct(){


		//create new mailer
		$this->dragon = new PHPMailer(true);


	}


}
