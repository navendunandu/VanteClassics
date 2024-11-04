<?php ob_start();
include("../Assets/Connection/connection.php");
include("Head.php");?>
        
        <div class="row">
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Total Users</h5>
                <h3 class="card-title"><i class="tim-icons icon-single-02 text-primary "></i> <?php $SelQry="Select count(*) as count from tbl_user";
                $Result = $Con -> query($SelQry);
                $row=$Result->fetch_assoc();
                echo $row['count'];
                ?></h3>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Total Sales</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info "></i><?php $SelQry="Select sum(booking_amount) as amount from tbl_booking b inner join tbl_cart c on b.booking_id=c.cart_id where c.cart_status between 0 and 5";
                $Result = $Con -> query($SelQry);
                $row=$Result->fetch_assoc();
                echo $row['amount'];
                ?></h3>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Total Products</h5>
                <h3 class="card-title"><i class="tim-icons icon-bag-16 text-success "></i><?php $SelQry="Select count(*) as count from tbl_product";
                $Result = $Con -> query($SelQry);
                $row=$Result->fetch_assoc();
                echo $row['count'];
                ?></h3>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Completed Orders</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info "></i> <?php $SelQry="Select count(*) as count from tbl_booking b inner join tbl_cart c on b.booking_id=c.cart_id where c.cart_status between 0 and 5";
                $Result = $Con -> query($SelQry);
                $row=$Result->fetch_assoc();
                echo $row['count'];
                ?></h3>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row">
          <!-- SALES TABLE START -->
          <div class="col-lg-6 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Manufacturer Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                     <th>
                        Name
                      </th>
                      <th>
                        Contact
                      </th>
                      <th>
                        Place
                      </th>
                      <th>
                        District
                      </th>
                      
                    </thead>
                    <tbody>
                    <?php 
   $SelQry="select *from tbl_manufacturer m inner join tbl_place p on m.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where manufacturer_vstatus=1 limit 5";
    $result=$Con->query($SelQry);
	$i=0;
	while($row=$result->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $row['manufacturer_name'];?></td>
      <td><?php echo $row['manufacturer_contact'];?></td>
      <td><?php echo $row['place_name'];?></td>
      <td><?php echo $row['district_name'];?></td>
	<?php
	}
	?>          
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- SALES TABLE ENDS -->
           <!-- SELLER TABLE STARTS -->
           <div class="col-lg-6 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Orders Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                    <th>
                        Sl No.
                      </th>
                      
                      <th>
                        Product Name
                      </th>
                      <th>
                        Quantity
                      </th>
                      <th>
                        Price
                      </th>
                      <th>
                        Total Price
                      </th>
                      <th>
                        Status
                      </th>
                    </thead>
                    <tbody>
                    <?php
	$i=0;
    $SelQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_manufacturer m on m.manufacturer_id=p.manufacturer_id order by b.booking_id desc limit 5";
	$result=$Con->query($SelQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
 ?>	
  <tr>
    <td><?php echo $i; ?></td>
   
    <td><?php echo $row['product_name'];?></td>
    <td><?php echo $row['cart_qty'];?></td>
    <td><?php echo $row['product_price'];?></td>
    <td><?php echo $row['cart_qty']*$row['product_price'];?></td>
    <td><?php if($row['cart_status']==1){
		echo "Payment recieved";
	}else if($row['cart_status']==2)
	{
		echo "Order packed";
	}else if($row['cart_status']==3)
	{
		echo "Order Shipped";
	}else if($row['cart_status']==4)
	{
		echo "Delivered";
	}else if($row['cart_status']==5)
	{
		echo "Return Requested";
	}else if($row['cart_status']==6)
	{
		echo "Return Accepted";
	}else if($row['cart_status']==7)
	{
		echo "Return Completed Successfully";
	}
}
	?></td>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- SELLER TABLE ENDS -->
        </div>
        <?php
            include("Foot.php");
            ob_flush();
            ?>        