<?php

class Order{
	function add($data, $address){
		global $con;
		$date 			= Helper::timestamp();
		$order_id 		= $data[0]['order_number'];
		$query 			= $con->query("INSERT INTO orders values ('', '$order_id', '$address', 1, '$date', '$date')");
		foreach ($data as $key => $pizza) {
			$data 		= Pizza::add($pizza, $key+1);
		}
	}

	function uniqueOrder($id){
		global $con;
		$query   	= $con->query("SELECT * from orders where order_id = '$id'");
		$row		= $query->fetch_object();
			
		return $row;
	}

	function getData($status){
		global $con;
		if ($status == 1) {
			return $con->query("SELECT * FROM orders where status = '1'");
		}
		else{
			return $con->query("SELECT * FROM orders");	
		}
	}

	function printTicket($id){
		global $con;
		$con->query("UPDATE orders set status = 0 where order_id = '$id'");
		$query   	= $con->query("SELECT * from orders where order_id = '$id'");
		return $query->fetch_object();
	}
}

class Pizza{
	function add($pizza, $id){
		global $con;
		$date 			= Helper::timestamp();
		$order_id 		= $pizza['order_number'];
		$size 			= $pizza['size'];
		$crust 			= $pizza['crust'];
		$type 			= $pizza['type'];
		$toppings 		= $type;
		$whole 			= 0;
		$first 			= 0;
		$second 		= 0;
		if (is_array($type)) {
			if(array_key_exists('whole', $type)){
				$whole 		= count($type['whole']);
			}
			if(array_key_exists('first-half', $type)){
				$first 		= count($type['first-half']);
			}
			if(array_key_exists('second-half', $type)){
				$second 	= count($type['second-half']);
			}
			$toppings   = "custom";
		}
		$query 			= $con->query("INSERT INTO pizza_order values ('', '$order_id', '$size', '$crust', '$toppings', '$whole', '$first', '$second')");
		if (is_array($type)) {
			$pizza_id   = $con->insert_id;
			if(array_key_exists('whole', $type)){
				Toppings::add(0, $type['whole'], $pizza_id);
			}
			if(array_key_exists('first-half', $type)){
				Toppings::add(1, $type['first-half'], $pizza_id);
			}
			if(array_key_exists('second-half', $type)){
				Toppings::add(2, $type['second-half'], $pizza_id);
			}
		}
	}
	function getData($id){
		global $con;
		return $con->query("SELECT * FROM pizza_order where order_id = '$id'");
	}
	function printTicket($id){
		global $con;
		return $con->query("SELECT * from pizza_order where order_id = '$id'");
	}
}

class Toppings{
	function add($area, $toppings, $id){
		global $con;
		foreach ($toppings as $key => $topping) {
			$query 			= $con->query("INSERT INTO pizza_toppings values ('', '$id', '$topping', '$area')");
		}
	}

	function printTicket($id, $area){
		global $con;
		return $con->query("SELECT * from pizza_toppings where pizza_id = '$id' and area = '$area'");
	}
}

?>