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
	<a href="http://localhost/myecommerce/index.php/shop/show/0/x"><h1 class="text-center">MY SHOP</h1></a>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div id="main">
					<?php

					echo '<h3>'.$products[$sg3]->product_name.' :'.$products[$sg3]->product_price.' USD</h3>';
					echo '<img src="http://localhost/myecommerce/shop/'.$products[$sg3]->pic_name.'.jpg" alt="">';
					
					?>
				</div>
				<br>
				<div id="thumb">
					<form class="form-inline" role="form">
						
						<?php 
						foreach ($products as $key => $p) 
						{
							if($p->product_id == $products[$sg3]->product_id)
							{
								echo '<a href="http://localhost/myecommerce/index.php/shop/show/'.$key.'/x"><img src="http://localhost/myecommerce/shop/'.$p->pic_name.'.jpg" alt="" width="100px"></a>';
							}
						}
						?>
					</form>
				</div>

			</div>

			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<h3>Product List</h3>
				<?php 
				$prods = [];
				foreach ($products as $key => $p) {
					if(!in_array($p->product_id, $prods)){
						$prods[] = $p->product_id;
						echo '<p><a href="http://localhost/myecommerce/index.php/shop/show/'.$key.'/'.$sg4.'">'.$p->product_name.'</a></p>';
						echo '<a href="http://localhost/myecommerce/index.php/shop/addCart/'.$p->product_id.'/'.$sg4.'" class="btn btn-default">Add</a>';
					}
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
						if($cart <> ' '){
							foreach ($cart as $c) {
								echo '<tr>';
								echo '<td>'.$c['product_id'].'</td>';
								echo '<td>'.$c['product_name'].'</td>';
								echo '<td>'.$c['product_price'].'</td>';
								echo '<td>'.$c['count'].'</td>';
								echo '<td>'.$c['sub_total'].'</td>';
								echo '</tr>';
							}
						}
						?>
					</tbody>
				</table>
				<?php
				if($cart <> ' '){
					echo "<h3>Total: ".number_format($total,0,',',' ')." USD </h3>";
				}
				?>

			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>