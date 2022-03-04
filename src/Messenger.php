<?php

namespace Messenger;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


use Messenger\MessengerTemplate;

use DevCoder\DotEnv;


class Messenger{

	use MessengerError;
	


	public $message;

	public $messenger;


	private $mailer;

	private $senderName;
	private $username;
	private $password;
	private $host;
	private $port;


	

	
	public function __construct(){


		
		(new DotEnv(__DIR__ . '/.env'))->load();

		$this->senderName = getenv('SENDER_NAME');
		$this->username = getenv("SENDER_USERNAME");
		$this->password = getenv("SENDER_PASSWORD");
		$this->port = getenv("MAIL_PORT");
		$this->host = getenv("MAIL_HOST");

		$this->senderEmail = getenv("SENDER_EMAIL");


		//inialize the PHPMailer 
		
		$this->mailer = new PHPMailer(true);




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
	 * @param [string] $message_title
	 * @param  [type] $user_data     [description]
	 * @param  [type] $template_path [description]
	 * @return [type]                [description]
	 */
	public function sendMessage(string $recepient,  $message_title = null,  array $user_data = null, string $template_file = null){

		//set the $user_data
		$recepient_identifier = $recepient;
		if($user_data != null){

			$this->setData($user_data);

			$firstname_keys = array("firstname", "first name", "firstName", "FIRSTNAME", "name", "Name", "NAME");


			foreach($firstname_keys as $firstname){
				if(array_key_exists($firstname, $user_data)){
					$recepient_identifier = $user_data[$firstname];
					break;
				}
			}

		}








		$messengerTemplate = new MessengerTemplate($template_file, $this);

		//run the template engine
		$content = $messengerTemplate->runTemplateEngine();


		try{

			//$this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
			$this->mailer->isSMTP(); 
			$this->mailer->Host = $this->host;
			$this->mailer->SMTPAuth   = true;  
			$this->mailer->Username   = $this->username; 
			$this->mailer->Password   = $this->password;
			$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$this->mailer->Port       = $this->port;

			$this->mailer->SMTPOptions = array(
				    'ssl' => array(
				        'verify_peer' => false,
				        'verify_peer_name' => false,
				        'allow_self_signed' => true
    					)
					);

			$this->mailer->setFrom($this->senderEmail, $this->senderName);
			$this->mailer->addAddress($recepient, $recepient_identifier);

			$this->mailer->isHTML(true);

			$this->mailer->Subject = $message_title;

			$this->mailer->Body = $content;

			$this->mailer->send();

			echo "Message sent";



		}catch(Exception $e){
			echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
		}


	


	}




}
