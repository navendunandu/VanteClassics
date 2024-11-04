<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_msg'])){
  $msg=$_POST['txt_msg'];
$UpQry="update tbl_assign set assign_msg='$msg' where assign_id=".$_GET['rjid'];
if($Con->query($UpQry)){}
else{
  ?>
    <script>
		alert("Error");
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
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Feedback</td>
      <td><input required type="text" name="txt_msg" id="txt_msg" /></td>
    </tr>
    <td colspan="2" align="center"><input type="submit" name="btn_msg" id="btn_msg" value="Submit" /></td>
   </table>
</form>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>