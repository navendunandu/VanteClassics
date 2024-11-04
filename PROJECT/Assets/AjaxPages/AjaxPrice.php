<?php
include("../Connection/Connection.php");
$id=$_GET['cid'];
$qty=$_GET['qty'];
$UpQry="update tbl_cart set cart_qty='$qty' where cart_id='$id'";
$Con->query($UpQry);

?>