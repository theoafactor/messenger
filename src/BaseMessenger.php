<?php 

namespace Messenger;

use DevCoder\DotEnv;


class BaseMessenger{



	public function __construct(){

		(new DotEnv(__DIR__ . '/.env'))->load();

		echo getenv('SENDER_NAME');
	}


}