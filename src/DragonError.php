<?php

namespace Dragon;


trait DragonError{


	public function showError($error_message = null){

		ini_set("display_errors", "on");


		if($error_message){

			//do all kinds of stuffs to the $error_message
			//return the $variable 
			
			echo $error_message;

		}

	}


}