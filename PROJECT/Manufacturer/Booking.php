<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
 
session_start();
if(isset($_GET['cid']))
{
	$id=$_GET['cid'];
	$stat=$_GET['stat'];
	$selUser="select*from tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id inner join tbl_user u on b.user_id =u.user_id where c.cart_id=".$id;
	$result=$Con->query($selUser);
	$row=$result->fetch_assoc();
	$email=$row['user_email'];
	$UpQry="update tbl_cart set cart_status='$stat' where cart_id='$id'";
	if($Con->query($UpQry)){
		if($stat==3){
			$mail = new PHPMailer(true);

			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = ' vanteclassics@gmail.com'; // Your gmail
			$mail->Password = ''; // Your gmail app password
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
		  
			$mail->setFrom('vanteclassics@gmail.com'); // Your gmail
		  
			$mail->addAddress($email);
		  
			$mail->isHTML(true);
		  
			$mail->Subject = "Greetings ";  //Your Subject goes here
			$mail->Body = "Your order has been shipped"; //Mail Body goes here
		  if($mail->send())
		  {
			?>
		<script>
			alert("Email Send")
		</script>
			<?php
		  }
		  else
		  {
			?>
		<script>
			alert("Something went wrong")
		</script>
			<?php
		  }
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled Document</title>
<!-- Bootstrap CSS -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

<style>
	/* Ensure the container is flexbox centered */
	.border-table-container {
		display: flex;
		justify-content: center;
		align-items: center;
		border-radius: 8px;
		padding: 20px;
		min-height: 80vh;
		background-color: #f9f9f9;
	}

	/* Center the table and adjust its styling */
	.table {
		width: 100%;
		max-width: 1200px; /* Maximum width for the table */
		margin: 0 auto;
		background-color: #fff;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		border-radius: 8px; /* Rounded corners */
		overflow: hidden; /* Rounded corners effect */
		padding: 20px;
	}

	/* Table header and row styling */
	.table th{
		vertical-align: middle;
		text-align: center;
		background-color: #6c7ae0; /* Your preferred shade for header */
	}
	table td {
		vertical-align: middle;
		text-align: center;
	}

	/* Style for images inside the table */
	.table img {
		width: 100px;
		height: auto;
	}

	/* Style for action links */
	.table a {
		text-decoration: none;
		color: #6c7ae0;
		font-weight: bold;
	}

	.table a:hover {
		text-decoration: underline;
	}

	/* Highlighted status text */
	.status {
		font-weight: bold;
	}
</style>
</head>

<body>

<!-- The centered table content -->
<div class="order-table-container">
	<div class="table-responsive">
		<h2 class="text-center mb-4">Order Management</h2>
		<table class="table table-bordered table-hover">
			<thead class="th">
				<tr>
					<th>Sl No.</th>
					<th>Photo</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total Price</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				$SelQry = "SELECT * FROM tbl_booking b INNER JOIN tbl_cart c ON c.booking_id=b.booking_id INNER JOIN tbl_product p ON p.product_id=c.product_id INNER JOIN tbl_manufacturer m ON m.manufacturer_id=p.manufacturer_id WHERE m.manufacturer_id=" . $_SESSION['mid'];
				$result = $Con->query($SelQry);
				while ($row = $result->fetch_assoc()) {
					$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo']; ?>" alt="Product Image" /></td>
						<td><?php echo $row['product_name']; ?></td>
						<td><?php echo $row['cart_qty']; ?></td>
						<td>₹<?php echo $row['product_price']; ?></td>
						<td>₹<?php echo $row['cart_qty'] * $row['product_price']; ?></td>
						<td class="status">
							<?php
							if ($row['cart_status'] == 1) {
								echo "Payment Received";
							} else if ($row['cart_status'] == 2) {
								echo "Order Packed";
							} else if ($row['cart_status'] == 3) {
								echo "Order Shipped";
							} else if ($row['cart_status'] == 4) {
								echo "Delivered";
							} else if ($row['cart_status'] == 5) {
								echo "Return Requested";
							} else if ($row['cart_status'] == 6) {
								echo "Return Accepted";
							} else if ($row['cart_status'] == 7) {
								echo "Return Completed Successfully";
							}
							?>
						</td>
						<td>
							<?php if ($row['cart_status'] == 1) { ?>
								<a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=2">Packed</a>
							<?php } if ($row['cart_status'] == 2) { ?>
								<a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=3">Shipped</a>
							<?php } if ($row['cart_status'] == 3) { ?>
								<a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=4">Delivered</a>
							<?php } if ($row['cart_status'] == 5) { ?>
								<a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=6">Pick Return</a>
							<?php } if ($row['cart_status'] == 6) { ?>
								<a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=7">Return Received</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<br>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>