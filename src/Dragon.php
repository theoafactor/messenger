<?php

namespace Dragon;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


use Dragon\DragonTemplate;

use DevCoder\DotEnv;



class Dragon {

	use DragonError;
	


	public $message;

	public $dragon;

	

	
	public function __construct(){


		(new DotEnv(__DIR__ . '/.env'))->load();

		echo getenv('APP_ENV');
		// dev
		echo getenv('DATABASE_DNS');
		// mysql:host=localhost;dbname=test;


		//create new mailer
		//$this->mailer = new PHPMailer(true);


		//initialize the DragonError


	}




	/**
	 * [setData description]
	 * @param  array  $user_data [must be an array of the user data]
	 * @return [type]            [description]
	 */
	private function setData(array $user_data){



		foreach($user_data as $user_property => $value){

			//$user_property is the dynamic property ...
			//...while the $value is the value of the dynamic property..
			$this->$user_property = $value;
		

		}



	}



	/**
	 * Sends the messasge
	 * @param  [type] $recepient     [description]
	 * @param  [type] $user_data     [description]
	 * @param  [type] $template_path [description]
	 * @return [type]                [description]
	 */
	public function sendMessage(string $recepient, array $user_data = null, string $template_file = null){

		//set the $user_data
		if($user_data != null){

			$this->setData($user_data);

		}

		$dragonTemplate = new DragonTemplate($template_file, $this);

		//run the template engine
		$dragonTemplate->runTemplateEngine();
	


	}




}
