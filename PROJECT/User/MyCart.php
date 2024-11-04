<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_checkout']))
{
	$rate=$_POST['txt_rate'];
	$id=$_POST['txt_id'];
$UpQry="update tbl_booking set booking_status='1',booking_amount='$rate',booking_date=curdate() where booking_id='$id'";
$Con->query($UpQry);
$UpQry="update tbl_cart set cart_status='1' where booking_id='$id'";
$Con->query($UpQry);
header("location:Payment.php?bid='$id'");
}
if(isset($_GET['cid']))
{
	$DelQry="delete from tbl_cart where cart_id=".$_GET['cid'];
	if($Con->query($DelQry))
	{
		?>
        <script>
		window.location="MyCart.php";
		</script>
        <?php
	}
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        /* Adjust the centering to be more balanced */
        .cart-container {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align towards the top to avoid being too tight vertically */
            min-height: 80vh; /* Gives breathing space from the top */
            padding: 20px; /* Additional padding around the cart */
        }

        .card {
            width: 100%;
            max-width: 900px; /* Limiting the width of the card to prevent it from being too wide */
            margin: 20px auto; /* Auto margin for horizontal centering */
        }

        .total-price {
            font-weight: bold;
        }

        .no-items {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        img {
            max-width: 100px;
            height: auto;
        }
        input[type="submit"] {
      background-color: #6c63ff;
      color: white;
      border: none;
      font-weight: bold;
    }
    input[type="submit"]:hover {
      background-color: #574bff;
    }
    </style>
</head>

<body>
<body>

<div class="container cart-container">
    <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-4">Shopping Cart</h2>
        <form id="form1" name="form1" method="post" action="">
            <?php
            $i = 0;
            $bid = '';
            $checkout = 0;
            $SelQry = "select * from tbl_cart c inner join tbl_booking b on c.booking_id=b.booking_id inner join tbl_product p on c.product_id=p.product_id where b.booking_status=0 and c.cart_status=0 and b.user_id=" . $_SESSION['uid'];
            $result = $Con->query($SelQry);
            if ($result->num_rows > 0) {
                ?>
                <table class="table table-striped table-bordered cart-table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Sl No.</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $bid = $row['booking_id'];
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo']; ?>" alt="Product Image"/></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td>
                                <input required type="number" class="form-control" name="txt_qty" id="txt_qty" value="<?php echo $row['cart_qty']; ?>" onChange="TotalPrice(this.value,'<?php echo $row['cart_id'] ?>')"/>
                            </td>
                            <td>₹<?php echo $row['product_price']; ?></td>
                            <td>₹<?php echo $total = $row['product_price'] * $row['cart_qty']; ?></td>
                            <td><a href="MyCart.php?cid=<?php echo $row['cart_id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                        <?php
                        $checkout += $total;
                    }
                    ?>
                    <input type="hidden" name="txt_rate" id="txt_rate" value="<?php echo $checkout; ?>"/>
                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $bid; ?>"/>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <h4 class="total-price">Checkout Price: ₹<?php echo $checkout; ?></h4>
                        <input type="Submit" name="btn_checkout" id="btn_checkout" class="btn btn-primary" value="Checkout"/>
                    </div>
                </div>
                <?php
            } else {
                echo "<h1 class='no-items'>No items in cart</h1>";
            }
            ?>
        </form>
    </div>
</div>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function TotalPrice(qty,cid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPrice.php?qty=" + qty+"&cid="+cid,
      success: function (result) {

        //$("#txt_qty").html(result);
		window.location.reload()
      }
    });
  }
  </script>
</html>
<?php
include("Foot.php");
ob_flush();
?>