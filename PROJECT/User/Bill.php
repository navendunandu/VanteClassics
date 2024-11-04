<?php
include("../Assets/Connection/Connection.php"); 
$selqry="select * from tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id inner join tbl_user u on u.user_id=b.user_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_manufacturer k on k.manufacturer_id=p.manufacturer_id where c.cart_id='".$_GET["cid"]."'";
$result=$Con->query($selqry);
$data=$result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
      * {
        box-sizing: border-box;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
      }

      .main-pd-wrapper {
        box-shadow: 0 0 10px #ddd;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        width: 1000px;
        margin: auto;
      }

      .table-bordered {
        border: 1px solid #ddd;
        border-collapse: collapse;
      }

      .table-bordered td,
      .table-bordered th {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
        text-align: left;
      }

      h4 {
        text-align: center;
        margin: 0;
      }

      h4, p {
        line-height: 1.5;
      }

      .header-section {
        display: table-header-group;
      }

      .header-info {
        text-align: center;
        color: #4a4a4a;
      }

      .header-info span {
        color: #6c7ae0;
        font-size: 56px;
      }

      .button {
        float: right;
        color: #FFF;
        background: #6c7ae0;
        border: none;
        margin: 20px;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
      }

      .button:hover {
        background: #5a6bbd; /* Darker Shade for Hover Effect */
      }

      .total-value {
        background: #6c7ae0; /* Main Theme Color */
        color: #fff;
        text-align: right;
      }

      .cropped {
        float: right;
        margin-bottom: 20px;
        height: 100px; /* height of container */
        overflow: hidden;
      }

      .cropped img {
        width: 400px;
        margin: 8px 0px 0px 80px;
      }
    </style>
  </head>
  <body>
    <br /><br /><br /><br /><br /><br />
    
    <section class="main-pd-wrapper" id="content">
      <div class="header-section">
        <h4><b>Tax Invoice</b></h4>
        <table style="width: 100%; table-layout: fixed">
          <tr>
            <td style="border-left: 1px solid #ddd; border-right: 1px solid #ddd">
              <div class="header-info">
                <span>Vante Classics</span>
                <p style="font-weight: bold; margin-top: 15px">GST TIN : 06AAFCD6498P1ZT</p>
                <p style="font-weight: bold">
                  Toll Free No. :
                  <a href="tel:018001236477" style="color: #6c7ae0">1800-123-6477</a>
                </p>
              </div>
            </td>
            <td align="right" style="padding-left: 50px;">
              <div>
                <h4 style="margin: 5px 0">Bill to/ Ship to</h4>
                <p style="font-size: 14px">
                  <?php echo $data["user_address"] ?>
                  <br />
                  Tel:<?php echo $data["user_contact"] ?>
                </p>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <table class="table table-bordered h4-14" style="width: 100%; margin-top: 15px">
        <thead>
          <tr style="background: #e6e6ff;">
            <td colspan="3">
              <p>Booking Date:- <?php echo $data["booking_date"] ?></p>
              <p style="margin: 5px 0">Invoice Generated:- <?php echo date("Y-m-d"); ?></p>
            </td>
            <td colspan="3" style="width: 300px">
              <h4 style="margin: 0">Sold By:</h4>
              <p><?php echo $data["manufacturer_name"] ?></p>
            </td>
          </tr>
          <tr>
            <th style="width: 50px">#</th>
            <th style="width: 150px">Product</th>
            <th style="width: 100px">Photo</th>
            <th style="width: 150px">Price</th>
            <th style="width: 80px">Qty</th>
            <th style="width: 120px"><h4>TOTAL Value</h4></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>01</td>
            <td><?php echo $data["product_name"] ?></td>
            <td><img src="../Assets/Files/Product/Photo/<?php echo $data["product_photo"];?>" width="119" height="92" /></td>
            <td><?php echo $data["product_price"] ?></td>
            <td><?php echo $data["cart_qty"] ?></td>
            <td><?php echo $data["product_price"] * $data["cart_qty"] ?></td>
          </tr>
        </tbody>
      </table>

      <table class="table-bordered" style="width: 100%; margin-top: 30px">
        <tr class="total-value">
          <th>Total Order Value</th>
          <td style="width: 70px; text-align: right; border-right: none">
            <b><?php echo $data["product_price"] * $data["cart_qty"] ?></b>
          </td>
          <td colspan="5" style="border-left: none"></td>
        </tr>
      </table>
    </section>
    <button id="cmd" onClick="printDiv('content')" class="button">Download Bill</button>
  </body>
</html>

    
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js'></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>