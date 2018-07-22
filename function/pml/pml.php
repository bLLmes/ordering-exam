<?php

class PML{
	function getPizza($pml, $count_pizza){
		$pizza_tags 	= Helper::countItem($pml, '{/pizza}');
		$order_tags 	= Helper::countItem($pml, '{/order}');
		$pml    		= preg_replace('/{[\/]pizza}/', "", $pml);
		$split_pizza	= preg_split('/{pizza[^}]*[^\/]}/i', $pml, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$pizza 			= [];
		$order_number 	= Helper::getNumber($split_pizza[0]);
		$checker 		= Order::uniqueOrder($order_number);
		$status 		= "success";
		$message 		= "";

		if($pizza_tags >= 25){
			$element    = Helper::getMessage('pizza', 'max', 0);
			$status 	= $element['status'];
			$message 	= $element['message'];
		}
		if($checker){
			$element    = Helper::getMessage('order', 'unique', 0);
			$status 	= $element['status'];
			$message 	= $element['message'];
		}
		if($order_tags >= 2){
			$element    = Helper::getMessage('order', 'max', 0);
			$status 	= $element['status'];
			$message 	= $element['message'];
		}

		for ($i=0; $i < $count_pizza; $i++) { 
			# code...
			if($i == 0){
				$element    	= PML::getElement($split_pizza[1]);
			}
			else{
				$element    = PML::getElement($split_pizza[$i+1]);
			}
			if($element['status'] == "failed"){
				$status 	= $element['status'];
				$message 	= $element['message'];
			}
			$pizza[]   	 	= array('order_number' => $order_number, 'size' => $element['size'], 'crust' => $element['crust'], 'type' => $element['type'], 'status' => $status, 'message' => $message);
		}
		return $pizza;
	}

	function getElement($pml){
		$size 			= Helper::removeSpaces(Element::getSize($pml));
		$crust 			= Helper::removeSpaces(Element::getCrust($pml));
		$arr_type 	    = Element::getType($pml);
		$type 			= Helper::removeSpaces($arr_type[0]);
		$status 		= "success";
		$message 		= "";
		if (strpos($type, 'custom') !== false){
			$type 		= pizzaToppings::getToppings($arr_type[1]);
		}
		if(is_array($type)){
			if(array_key_exists('status', $type)){
				$status 		= $type['status'];
				$message 		= $type['message'];
			}
		}
		$element 		= array('size' => $size, 'crust' => $crust, 'type' => $type, 'message' => $message, 'status' => $status);
		return $element;
	}


}

class Element{
	function getSize($pml){
		$size			= preg_split('/{[\/]size}/', $pml, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$size    		= preg_replace('/{size}/', "", $size);
		return $size[0];
	}

	function getCrust($pml){

		$crust			= explode('{/size}', $pml);
		if(is_array($crust) && array_key_exists(1, $crust)){
			$crust			= preg_split('/{[\/]crust}/', $crust[1], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			$crust    		= preg_replace('/{crust}/', "", $crust);
		}
		return $crust[0];
	}

	function getType($pml){
		$type				= explode('{/crust}', $pml);
		if(is_array($type) && array_key_exists(1, $type)){
			$type			= preg_split('/{[\/]type}/', $type[1], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			$type    		= preg_replace('/{type}/', "", $type);
		}
		return $type;
	}
}

class pizzaToppings{
	function getToppings($pml){
		$count_type 				= Helper::countItem($pml, '{/toppings}');
		$toppings					= explode('{/toppings}', $pml);
		$arr_toppings       		= [];
		$item_tags 					= 0;
		$message 					= "";
		$status 					= "success";
		for ($i=0; $i < $count_type; $i++) { 
			$arr_item       		= [];
			$attribute  			= Helper::getNumber($toppings[$i]);
			$item_tags 				= Helper::countItem($toppings[$i], '{/item}');
			if($item_tags >= 13){
				$element    		= Helper::getMessage('toppings', 'tags', $item_tags);
			}
			if($attribute >= 3){
				$element    		= Helper::getMessage('toppings', 'area', $attribute);
			}
			$items	    			= explode('{/item}', $toppings[$i]);
			foreach ($items as $key => $item) {
				if (strpos($item, '{item}') !== false) {
					$item				= explode('{item}', $item);
					$arr_item[] 		= Helper::removeSpaces($item[1]);
				}
			}
			$type  					= pizzaToppings::toppingsType($attribute);
			$arr_toppings[$type]	= $arr_item;
		}
		$arr_toppings['message'] = "";
		$arr_toppings['status']  = "success";
		if(isset($element)){
			if(array_key_exists('status', $element)){
				$arr_toppings['message'] = $element['message'];
				$arr_toppings['status']  = $element['status'];
			}
		}
		return $arr_toppings;
	}

	function toppingsType($attribute){
		$type 		= "";
		if ($attribute == 0) {
			$type 	= "whole";
		}
		elseif($attribute == 1){
			$type 	= "first-half";
		}
		else{
			$type 	= "second-half";
		}
		return $type;
	}
}
?>