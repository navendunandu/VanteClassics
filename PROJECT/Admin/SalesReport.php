<?php
include("../Assets/Connection/connection.php");
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Date Filter Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Bookings by Date</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="">
                                <div class="form-group row">
                                    <label for="txt_start" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-4">
                                    <input type="date" class="form-control" name="txt_start" max="<?php echo Date('Y-m-d') ?>" id="txt_start">
                                    </div>
                                    <label for="txt_end" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-4">
                                    <input type="date" class="form-control" name="txt_end" max="<?php echo Date('Y-m-d')?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Booking Report Table -->
                <div class="col-md-12">
                    <?php
                    if (isset($_POST['btn_submit'])) {
                        $start = $_POST['txt_start'];
                        $end = $_POST['txt_end'];
                        $SelQry = "SELECT * FROM tbl_booking b 
                                   INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
                                   INNER JOIN tbl_product p ON p.product_id=c.product_id 
                                   WHERE b.booking_date BETWEEN '$start' AND '$end'";
                        $result = $Con->query($SelQry);
                        $i = 0;
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sales Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Product</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                            <td>
                                                <img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo']; ?>" 
                                                     alt="Product Photo" class="img-fluid" style="max-width: 100px;"/>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                                            <td><?php echo htmlspecialchars($row['cart_qty']); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>