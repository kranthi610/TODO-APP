<?php
class Validations{
	public static function validate($input,$items){
		$errors=array();
		foreach($items as $item=>$item_value){
			foreach($item_value as $item_key=>$item_input){
				if( $item_key=='required' && empty($input[$item])){
					array_push($errors, "$item is required");
				}
				if( $item_key=='email' && !filter_var($input[$item], FILTER_VALIDATE_EMAIL) ){
					array_push($errors,"$item value is invalid");
				}
				if($item_key=='alphabetic' && (preg_match("/^[a-zA-Z ]+$/", $input[$item]) != 1)){
					array_push($errors,"$item cannot contain spaces and non-alphabetic characters");
				}
				if( $item_key=='numeric' && (preg_match("/^\d{10}+$/", $input[$item]) != 1)){
					array_push($errors,"$item contains only 10 digits ");
				}
			}
		}
		return $errors;
	}
}