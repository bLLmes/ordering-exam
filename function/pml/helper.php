<?php

class Helper{
	function removeSpaces($word){
		$word = str_replace(" ", '', $word);
		return ucfirst($word);
	}

	function countItem($pml, $char){
		return substr_count($pml, $char);
	}

	function getNumber($pml){
		return preg_replace('/[^0-9]/', '', $pml);
	}

	function timestamp(){
		date_default_timezone_set('Asia/Manila');
		return date('Y-m-d h:i:s a', time());
	}

	function getMessage($tags, $validate, $value){
		$message 		= "Please fill up the required field and try again";
		$field 			= "";
		$status 		= "failed";
		if ($tags == "pizza") {
			if ($validate == "max") {
				$message 		= "The pizza must only have twenty-four(24) item in each order.";
			}			
		} 
		elseif($tags == "order") {
			if ($validate == "unique") {
				$message 		= "The order ID is already exist.";
			}
			elseif($validate == "max"){
				$message 		= "The PML Document must only have one(1) order.";
			}
		}
		elseif($tags == "toppings") {
			if ($validate == "tags") {
				$message 		= "Each toppings must only have twelve(12) item";
			}
			elseif($validate == "area"){
				$message 		= "The only available area toppings are whole pizza = zero(0), first-half = one(1) and second-half = two(2). Please check the value of attribute area in your toppings.";
			}
		}
		elseif($tags == "field"){
			if($validate == "pml"){
				$field	= "The PML Document must not be empty.";
			}
			elseif($validate == "address"){
				$field	= "The address field must not be empty.";
			}
		}
		
		$element 		= array('field' => $field, 'message' => $message, 'status' => $status);
		return $element;
	}
}
?>