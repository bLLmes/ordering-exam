<?php

include 'connection/db.php';
include 'model/order.php';
include 'pml/pml.php';
include 'pml/helper.php';

function makeOrder(){

	$status 				= "default";
	$message    			= "";
	$pml_mes	       		= "";
	$address_mes	       	= "";
	$pml        			= "";
	$address      			= "";
	if(isset($_POST['submit'])){
		$pml 				= $_POST['pml'];
		$address 			= $_POST['address'];
		$checker 			= true;
		if(strlen(trim($pml)) == 0){
			$pml_mes    	= Helper::getMessage('field', 'pml', 0);
			$message 		= $pml_mes['message'];
			$pml_mes 		= $pml_mes['field'];
			$checker 		= false;
		}
		if(strlen(trim($address)) == 0){
			$address_mes   	= Helper::getMessage('field', 'address', 0);
			$message 		= $address_mes['message'];
			$address_mes 	= $address_mes['field'];
			$checker 		= false;
		}
			
	 	if($checker === true){
	 		$count_pizza 		= Helper::countItem($pml,'{/pizza}');
		 	$result 			= PML::getPizza($pml, $count_pizza);

		 	foreach ($result as $key => $pizza) {
		 		if($pizza['status'] == "failed"){
		 			$status 	= $pizza['status'];
					$message    = $pizza['message'];
		 		}
		 	}
	 		$result 		= Order::add($result, $address);
	 		if($status == "default"){
	 			$status = "success";
	 		}
	 		if($status == "success"){
	 			$message    			= "The PML Document was successfully sent.";
		 		$pml        			= "";
				$address      			= "";
			}
	 	}
	}
	$data  		= array('pml' => $pml, 'pml_mes' => $pml_mes, 'address' => $address, 'address_mes' => $address_mes, 'status' => $status, 'message' => $message);
	return $data;
}


?>