<?php 

namespace Dragon;

use DevCoder\DotEnv;


class BaseDragon{



	public function __construct(){

		(new DotEnv(__DIR__ . '/.env'))->load();

		echo getenv('SENDER_NAME');
	}


}