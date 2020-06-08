<?php 
session_start();
include"connection.php";

//add to cart section - will only execute when button click
if(isset($_POST["add_to_cart"]))
{
	//this session will check if there is data or not 
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;//stores all the items into session
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';//if item is already added
		}
	}
	else 
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
//removes an product from shopping cart
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				//once a product has been removed, redirected to shoppingcart page
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="shopppingcart.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
      <meta charset="utf-8">
      <title>moblieView</title>
      <meta name="viewport" content="width=device-width, inital-scale=1.0">
      <link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
	</head>
	<header>
         <div class="nav-container">
            <div class="img-logo">
               <a href="../index.html">
               <img src="../images/logov2.jpg" alt="company logo" class="logo">
               </a>
            </div>
            <div class="nav">
               <ul>
                  <li><a href="../index.html">Home</a></li>
				  <?php 
				  if(isset($_SESSION['username'])){?>
				  <li><a href="logout.php">Logout</a></li>
				  <?php }else{ ?>
				  <li><a href="loginForm.php">Login</a></li>
				  <?php } 				  
				  if($level = "admin") {
				  ?>
				  <li><a href="admin.php">Admin</a></li>
				  <?php } ?>
               </ul>
            </div>
         </div>
      </header>
	<body>
	<!-- Gathers data from myphpadmin database -->
		<div class="wrapper">
			<div class="content">
			<br />
			<?php
				$query = "SELECT * FROM tbl_products ORDER BY id ASC";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<!-- Displays the name, image and price of products  -->
			<div class="container">
				<form method="post" action="shopppingcart.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="../images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">£ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<!-- Displays the products in shopping cart  -->
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					//checks session shopping cart is not empty
					if(!empty($_SESSION["shopping_cart"]))//if empty will not display anything
					{
						$total = 0;//stores item price
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<!-- This section will print the item name, quantity, price, total   -->
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>£ <?php echo $values["item_price"]; ?></td>
						<td>£ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="shopppingcart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">£ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>					
						
				</table>
			</div>
		</div>
		<button type="submit" name="checkout" class="btn">Checkout</button>
		</div>
	</div>
	<br />
	</body>
</html>