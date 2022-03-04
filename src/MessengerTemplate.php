<?php


namespace Messenger;


class MessengerTemplate{

	use MessengerError;
	


	//Create new messenger template instance
	public function __construct($template_file, $messenger){

		
		if($template_file != null){

			//load the template file for use for sending the message
			
			//the template file most likely is made up of paths
			
			$template_path = explode("/", $template_file);

			$overall_path = "";
			if(count($template_path) > 1){

				//loop
				$path = "";
				for($i = 0; $i < count($template_path) - 1; $i++){

					$path .= $template_path[$i];

				}


				$actual_template_file = $template_path[count($template_path) - 1];

				//overall path
				$overall_path = $path ."/".$actual_template_file;

			}else{

				$overall_path = $template_file;

			}


			//look for the file in the $overall_path
			if(file_exists($overall_path)){
				$template_content = file_get_contents($overall_path);


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