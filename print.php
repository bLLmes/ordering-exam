<?php include 'function/functions.php'; ?>
<?php $id 			= $_GET['id']; ?>
<?php $order 		= Order::printTicket($id); ?>
<?php $pizza 		= Pizza::printTicket($id); ?>

<!DOCTYPE html>
<html>
<head>
	<title>PRINT TICKET</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/css.php'; ?>
</head>
<body class="">
	<div class="ticket-body">
		<h3 class="text-center">Pizza Ticket</h3>

		<p class="order-content">Order <?php echo $order->order_id; ?>:</p>
		<?php $auto = 0; ?>
		<?php foreach ($pizza as $key => $pizza_info): ?>
			<?php $auto++; ?>
			<p class="first-indent">Pizza <?php echo $auto; ?> - <?php echo $pizza_info['size']; ?>, <?php echo $pizza_info['crust']; ?>, <?php echo $pizza_info['type']; ?>
			<?php if ($pizza_info['type'] == "custom"): ?>
				<?php $toppings 		= Toppings::printTicket($pizza_info['id'], 0); ?>
				<p class="second-indent">
					Toppings Whole:
					<?php foreach ($toppings as $key => $topping): ?>
						<p class="third-indent"><?php echo $topping['name']; ?></p>
					<?php endforeach ?>
				</p>
				<?php $toppings 		= Toppings::printTicket($pizza_info['id'], 1); ?>
				<p class="second-indent">
					Toppings First-Half:
					<?php foreach ($toppings as $key => $topping): ?>
						<p class="third-indent"><?php echo $topping['name']; ?></p>
					<?php endforeach ?>
				</p>
				<?php $toppings 		= Toppings::printTicket($pizza_info['id'], 2); ?>
				<p class="second-indent">
					Toppings Second-Half:
					<?php foreach ($toppings as $key => $topping): ?>
						<p class="third-indent"><?php echo $topping['name']; ?></p>
					<?php endforeach ?>
				</p>
			</p>
			<?php endif ?>
		<?php endforeach ?>
	</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>
