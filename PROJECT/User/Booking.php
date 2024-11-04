<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_GET['cid'])){
  $UpQry="update tbl_cart set cart_status='5' where cart_id=".$_GET['cid'];
  if($Con->query($UpQry)){}
  else{
    ?>
		<script>
			alert("Something went wrong")
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
  .btn-complaint {
    background-color: #ffdab9; /* Pastel Peach */
    color: #555; 
    border: none;
    border-radius: 5px;
  }
  .btn-complaint:hover {
    background-color: #ffc9a1; /* Lighter Peach */
  }
  
  .btn-return {
    background-color: #ffd1dc; /* Pastel Pink */
    color: #555; 
    border: none;
    border-radius: 5px;
  }
  .btn-return:hover {
    background-color: #ffbbc9; /* Lighter Pink */
  }

  .btn-rating {
    background-color: #b0c4de; /* Light Steel Blue */
    color: #555; 
    border: none;
    border-radius: 5px;
  }
  .btn-rating:hover {
    background-color: #a4d7df; /* Lighter Blue */
  }
</style>

</head>

<body>
<div class="container mt-5">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">Sl No.</th>
        <th scope="col">Photo</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Total Price</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $SelQry="select * from tbl_booking b inner join tbl_cart c on b.booking_id=c.booking_id inner join tbl_product p on p.product_id=c.product_id where b.booking_status>='2' and b.user_id=".$_SESSION['uid'];
      $result=$Con->query($SelQry);
      while($row=$result->fetch_assoc())
      {
          $i++;
      ?>  
      <tr>
        <td><?php echo $i;?></td>
        <td><img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo'];?>" class="img-fluid" width="100" height="100"/></td>
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['cart_qty'];?></td>
        <td><?php echo $row['product_price'];?></td>
        <td><?php echo $row['cart_qty']*$row['product_price'];?></td>
        <td>
          <?php 
            if($row['cart_status']==1){
              echo "Order is being packed";
            }else if($row['cart_status']==2){
              echo "Order packed";
            }else if($row['cart_status']==3){
              echo "Order Shipped";
            }else if($row['cart_status']==4){
              echo "Delivered";
            }else if($row['cart_status']==5){
              echo "Return Requested";
            }else if($row['cart_status']==6){
              echo "Return Accepted";
            }else if($row['cart_status']==7){
              echo "Return Completed Successfully";
            }
          ?>
        </td>
        <td>
          <a href="PostComplaint.php?pid=<?php echo $row['product_id']?>" class="btn btn-complaint btn-sm">Complaint</a>
          <?php if($row['cart_status']==4){ ?>
            <a href="Booking.php?cid=<?php echo $row['cart_id']?>" class="btn btn-return btn-sm">Return</a>
          <?php } ?>
          <a href="Rating.php?pid=<?php echo $row['product_id']?>" class="btn btn-rating btn-sm">Rating</a>
          <a href="Bill.php?cid=<?php echo $row['cart_id']?>" class="btn btn-rating btn-sm">Generate Bill</a>
        </td>
      </tr>
      <?php 
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>