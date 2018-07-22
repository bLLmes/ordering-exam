<?php include 'function/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pizza Pizza</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/css.php'; ?>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="jumbotron text-center">
	  <h1>Pizza Pizza</h1> 

	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading">Send PML Document</div>
				  <div class="panel-body">
				  <?php $result = makeOrder(); ?> 
				  	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-horizontal">
				  	<?php if ($result['status'] == "failed"): ?>
					  <div class="alert alert-danger">
					  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error!</strong> <?php echo $result['message']; ?>
				      </div>
				  	<?php elseif($result['status'] == "success"): ?>
				  	  <div class="alert alert-success">
					  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> <?php echo $result['message']; ?>
				      </div>
				    <?php else: ?>
				      <div class="alert alert-warning">
					  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Note!</strong> Please enter your PML Document in the textarea field below.
				      </div>
				  	<?php endif ?>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="email">Address:</label>
					    <div class="col-sm-10">
					    	<input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $result['address']; ?>">
					    	<span class="help-block"><?php echo $result['address_mes']; ?></span>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="email">PML Document:</label>
					    <div class="col-sm-10">
					    	<textarea class="pml-docu" name="pml"><?php echo $result['pml']; ?></textarea>
					    	<span class="help-block"><?php echo $result['pml_mes']; ?></span>
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <input type="submit" class="btn btn-default" name="submit" value="Submit" />
					    </div>
					  </div>
					</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/js.php'; ?>
</body>
</html>