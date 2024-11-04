<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$id=$_GET['pid'];
	$qty=$_POST['txt_qty'];
	$InsQry="insert into tbl_stock(stock_qty,stock_date,product_id) values('$qty',curdate(),'$id')";
	if($Con->query($InsQry))
		{
			?>
			<script>
			alert("Stock Updated");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Error");
			</script>
            <?php
		}
}

if(isset($_GET['did']))
{
	$DelQry="delete from tbl_stock where stock_id=".$_GET['did'];
	if($Con->query($DelQry))
	{
			?>
			<script>
			window.location="Stock.php?pid=<?php echo $_GET['pid'] ?>";
			</script>
           <?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .stock-container {
            max-width: 600px; /* Limit width */
            margin: auto; /* Center the container */
            margin-top: 50px; /* Space above */
            padding: 20px; /* Padding around */
            background-color: #fff; /* White background for the card */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .stock-container .btn {
            background-color: #6c7ae0; /* Button color */
            color: white; /* Text color */
        }
        .stock-container .btn:hover {
            background-color: #5a6fb2; /* Darker shade on hover */
        }
        .table thead th {
            background-color: #6c7ae0; /* Header color */
            color: white; /* Text color */
        }
        .table td a {
            color: #6c7ae0; /* Link color */
        }
        .table td a:hover {
            color: #5a6fb2; /* Darker shade on hover */
        }
    </style>
</head>
<body>
<div class="stock-container">
    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3">
            <label for="txt_qty" class="form-label">Stock Quantity</label>
            <input required type="text" class="form-control" name="txt_qty" id="txt_qty" />
        </div>
        <div class="text-center mb-4">
            <button type="submit" name="btn_submit" id="btn_submit" class="btn">Submit</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Stock Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            $SelQry="select * from tbl_stock s inner join tbl_product p on s.product_id=p.product_id where s.stock_id=".$_GET['pid'];
            $result=$Con->query($SelQry);
            while($row=$result->fetch_assoc())
            {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['stock_qty']; ?></td>
                <td><?php echo $row['stock_date']; ?></td>
                <td><a href="Stock.php?did=<?php echo $row['stock_id'];?>&pid=<?php echo $row['product_id'] ?>">Delete</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
        $selStock="SELECT SUM(stock_qty) as sum from tbl_stock where product_id =".$_GET['pid'];
        $resStock=$Con->query($selStock);
        $dataStock=$resStock->fetch_assoc();
        $totalStock=$dataStock['sum'];
        $selCart="SELECT SUM(cart_qty) as sum from tbl_cart where cart_status>=1 AND cart_status<6";
        $resCart=$Con->query($selCart);
        $dataCart=$resCart->fetch_assoc();
        $cartStock=$dataCart['sum'];
        $remStock=$totalStock-$cartStock;
        ?>
        <div class="container">
          <p>Total Stock:<?php echo $totalStock ?></p>
          <p>Remaining Stock:<?php echo $remStock ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>