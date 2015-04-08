<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My shop</title>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php
		$sg3 = $this->uri->segment(3);
		$sg4 = $this->uri->segment(4);
	?>
	<a href="http://localhost/myecommerce/index.php/shop/show/1/1/1"><h1 class="text-center">MY SHOPPING</h1></a>
	<div class="container">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div id="main">
				<h3>Info</h3>
				<?php
				if($sg3 != null){
					if($sg4 != 'x')
					{
						echo '<img src="http://localhost/myecommerce/shop/'.$products[$sg4-1]->pic_name.'.jpg" alt="">';
					}
					else {
						echo "Buy once, buy more & buy more";	
					}
				}
				else
				{
					echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
				}
				?>
			</div>
			<br>
			<div id="thumb">
				<form class="form-inline" role="form">
					<div class="form-group">
							<?php 
							$i=1;
							foreach ($products as $key => $p) {
								if($p->product_id == $sg3){
									echo '<a href="http://localhost/myecommerce/index.php/shop/show/'.$p->product_id.'/'.$p->pic_id.'><img src="http://localhost/myecommerce/shop/'.$p->pic_name.'.jpg" alt=""></a>';
								}
							}
						?>
					</div>
					<?php 
					if($sg3 != null){
							$i=0;
							foreach ($products as $key => $p) {
								if($p->product_id == $sg3){
									echo '<a href="http://localhost/myecommerce/index.php/shop/show/'.$p->product_id.'/'.$p->pic_id.'/1">
									<img src="http://localhost/myecommerce/shop/'.$p->pic_name.'.jpg" alt="" width="100px">
								</a>';
							}
						}
					}
					else{
						echo '<center><img src="http://localhost/myecommerce/shop/smile.jpg" alt=""><center>';
					}
					?>
				</form>
			</div>

	</div>

	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<h3>Product</h3>
		<?php 
		if($sg3 != null){
			$prods = [];
			foreach ($products as $p) {
				$obj['product_id'] =  $p->product_id;
				$obj['products'] =  $p->product_name;
				// neu nhu ko co trong shop
				if(!in_array($obj, $prods)){
					$prods[] = $obj;
					echo '<p><a href="http://localhost/myecommerce/index.php/shop/show/'.$p->product_id.'/'.$p->pic_id.'/1">'.$obj['products'].'</a></p>';
				}
			}
		}
		else{
			echo  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		}
		?>

	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<h3>Your carts</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Sum</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($cart as $c) {
						echo '<tr>';
						echo '<td>'.$c['product_id'].'</td>';
						echo '<td>'.$c['product_name'].'</td>';
						echo '<td>'.$c['product_price'].'</td>';
						echo '<td>'.$c['count'].'</td>';
						echo '<td>'.$c['sub_total'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
		<?php
			echo "<h3>Summary: ".$total." </h3>";
		?>

	</div>

</div>
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>