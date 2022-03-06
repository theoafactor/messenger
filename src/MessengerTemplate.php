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
					$pattern = "/{{\s*$key\s*}}/";
					$array_pattern = "/\s*@foreach\s*\($key as \w+\)\s*{{\s*\w+\s*}}\s*@endforeach/";


					//when the value is a string, 
					if(gettype($value) == "string"){

						//check if the key is inside the template
						if(preg_match_all($pattern, $template_content, $matched)){

							if(count($matched) == true){
								//there is a match..
								
								$template_content = preg_replace($pattern, $value, $template_content);

				
							}



						}


					}

					if(gettype($value) == "array"){

						//if the $value type is "array" and the $key matches.. throw an error
						if(preg_match_all($pattern, $template_content, $check_matched)){

							if(count($check_matched)){
								die("Nah. You can't do that.<br> You can't reference an array -> <strong>$key</strong> in the template. <br> You should loop instead");
							}

						}


						//check for the actual pattern
						if(preg_match_all($array_pattern, $template_content, $matched_array)){

							if(count($matched_array) > 0){
								//there is a match
								//this is a loop..
							
								$matched_array_loops = $matched_array[0];


								
								foreach($matched_array_loops as $matched_array_loop){

									//echo "<pre>";
									$matched_array_loop = trim($matched_array_loop);
									//print_r($matched_array_loop);

									$internal_matched_array_loop = explode(" as ", $matched_array_loop);

									$internal_matched_array_loop_part_two = $internal_matched_array_loop[1];

									$check = explode("{{" , $internal_matched_array_loop_part_two);

									$final_check_box = explode(")", $check[0]);

									$final_check = trim($final_check_box[0]);

									//echo $final_check;

									
									$sub_pattern = "/\s*{{\s*\w+\s*}}/";

									if(preg_match($sub_pattern, $matched_array_loop, $matched_array_loop_item)){

				
										$matched_loop_item = trim($matched_array_loop_item[0]);


										$matched_loop_item_box = explode("{{", $matched_loop_item);
										$matched_loop_item = trim($matched_loop_item_box[1]);

										$matched_loop_item_box = explode("}}", $matched_loop_item);

										$matched_loop_item = trim($matched_loop_item_box[0]);

										if($final_check == $matched_loop_item){
											//find that the $foreach(products as product) matches {{ product }}
											//
											$match_inside_for_pattern = "/\s*@foreach\s*\($key as $matched_loop_item\)\s*/";

											if(preg_match($match_inside_for_pattern, "@foreach($key as $matched_loop_item)", $is_matched_inside_for)){

												//create the property with this ..
												$all_matched_loop_items = "";
												foreach($value as ${$matched_loop_item}){
													$messenger->${$matched_loop_item} = ${$matched_loop_item};

													//echo ${$matched_loop_item};
													//replace ..
													$all_matched_loop_items .= "<li>".trim(${$matched_loop_item})."</li>";
													
												}
												$template_content = preg_replace($array_pattern, trim($all_matched_loop_items), $template_content);


												//$actual_loop_match = substr($matched_loop_item, 1, $last_two_loop_item_index);

												//echo $actual_loop_match;

												}else{
													//echo "NOTHIN HERE";
													die("No match");
													 
												}
											}else{

												die("You have an error in your loop syntax. Please check your template.");

											}

										

										


									}

									//echo $template_content;

									//die();
								}

							}

						}

					}



					

					
				

				}
		
				$this->template_content = $template_content;
				// echo $this->template_content;
				//die();
		
				

			

			}else{

				$this->showError("The template {$template_file} does not exist");

			}


		}



	}


	public function runTemplateEngine(){

		 return $this->template_content;


	}



}