<?php include 'function/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pizza Pizza</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/css.php'; ?>
	<!-- <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/> -->
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="jumbotron text-center">
	  <h1>Pizza Pizza</h1> 

	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  <ul class="nav nav-tabs">
			    <li class="active"><a data-toggle="tab" href="#home">New Order</a></li>
			    <li><a data-toggle="tab" href="#menu1">Search</a></li>
			  </ul>

			  <div class="tab-content">
			    <div id="home" class="tab-pane fade in active">
			      <h3>NEW ORDERS</h3>
			        <div class="table-responsive">          
					  <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>#</th>
					        <th>Order ID</th>
					        <th>Address</th>
					        <th>Number of Pizza</th>
					        <th>Status</th>
					        <th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php $orders = Order::getData(1); ?>
					      <?php if ($orders->num_rows > 0): ?>					      	
						      <?php foreach ($orders as $key => $order): ?>
						      	<?php $pizza 		= Pizza::getData($order['order_id']); ?>
						      	<?php $status 		= "New"; ?>
						      	<?php if ($order['status'] == 0): ?>
						      		<?php $status 	= "Process"; ?>
						      	<?php endif ?>
						      	  <tr>
							        <td><?php echo $key+1; ?></td>
							        <td><?php echo $order['order_id']; ?></td>
							        <td><?php echo $order['address']; ?></td>
							        <td><?php echo $pizza->num_rows; ?></td>
							        <td><?php echo $status; ?></td>
							        <td><a href="print.php?id=<?php echo $order['order_id']; ?>" class="btn btn-default btn-md btn-danger">PRINT</a></td>
							      </tr>
						      <?php endforeach ?>
					      <?php endif ?>
					    </tbody>
					  </table>
					</div>
			    </div>


			    <div id="menu1" class="tab-pane fade">
			      <h3>Order History</h3>
	                <table class="table table-striped table-bordered" id="orderTable">
	                    <thead>
					      <tr>
					        <th>#</th>
					        <th>Order ID</th>
					        <th>Address</th>
					        <th>Number of Pizza</th>
					        <th>Pizza Order</th>
					        <th>Status</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php $orders 					= Order::getData(0); ?>
					      <?php $pizza_details 				= ""; ?>
					      <?php $toppings 					= 0; ?>
					      <?php if ($orders->num_rows > 0): ?>					      	
						      <?php foreach ($orders as $key => $order): ?>
						      	<?php $pizza 				= Pizza::getData($order['order_id']); ?>
						      	<?php $status 				= "New"; ?>
						      	<?php if ($order['status'] == 0): ?>
						      		<?php $status 			= "Process"; ?>
						      	<?php endif ?>
						      	<?php foreach ($pizza as $key_pizza => $pizza_info): ?>
						      		<?php $auto 			= $key_pizza+1; ?>
						      		<?php $toppings    		= number_format($pizza_info['first']) + number_format($pizza_info['second']) + number_format($pizza_info['whole']); ?>
						      		<?php if ($toppings == 0): ?>
						      			<?php $toppings 	= 1; ?>
						      		<?php endif ?>
						      		<?php $pizza_details  	= $pizza_details ."Pizza ". $auto ."- ". $pizza_info['size'] .", ". $pizza_info['crust'] .", ". $pizza_info['type'] .", Sum of Toppings: ". $toppings ."<br>"; ?>
						      	<?php endforeach ?>
						      	<?php if ($order['status'] == 0): ?>
						      		<?php $status 			= "Process"; ?>
						      	<?php endif ?>
						      	  <tr>
							        <td><?php echo $key+1; ?></td>
							        <td><?php echo $order['order_id']; ?></td>
							        <td><?php echo $order['address']; ?></td>
							        <td><?php echo $pizza->num_rows; ?></td>
							        <td><?php echo $pizza_details; ?></td>
							        <td><?php echo $status; ?></td>
							      </tr>
						      <?php endforeach ?>
					      <?php endif ?>
					    </tbody>
	                </table>
			    </div>


			  </div>
			</div>
		</div>

	</div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/js.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#orderTable').DataTable();
	} );
</script>
</body>
</html>