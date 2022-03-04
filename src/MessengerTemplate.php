<?php


namespace Messenger;


class MessengerTemplate{

	use MessengerError;
	


	//Create new messenger template instance
	public function __construct($template_file, $messenger){

		if($template_file != null){
			//load the template file to use for sending the message
			$template_file = "templates/{$template_file}";

			if(file_exists($template_file)){
				$template_content = file_get_contents($template_file);


				foreach($messenger as $key => $value){


					//echo "$key => $value\n";
					$pattern = "/{{\s*$key\s*}}/";
					
					if(preg_match_all($pattern, $template_content, $matched)){

						//print_r($matched);

						if(count($matched) > 0){
							$template_content = preg_replace($pattern, $value, $template_content);
						}

					}
				

				}

				$this->template_content = $template_content;

		
				

			

			}else{

				$this->showError("The template {$template_file} does not exist");

			}
		}





	}


	public function runTemplateEngine(){

		 return $this->template_content;


	}



}