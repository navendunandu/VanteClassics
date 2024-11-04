<?php
include("../Assets/Connection/connection.php");
session_start();

if(isset($_POST['btn_submit']))
{
	$Email = $_POST['txt_mail'];
	$Password = $_POST['txt_pwd'];
	
	$selAdmin = "select * from tbl_adminreg where admin_email = '$Email' and admin_pwd = '$Password'";
	$ResultAdmin = $Con -> query($selAdmin);
	$selMan = "select * from tbl_manufacturer where manufacturer_email = '$Email' and manufacturer_password = '$Password'";
	$ResultMan = $Con -> query($selMan);
	$selUser = "select * from tbl_user where user_email = '$Email' and user_password = '$Password'";
	$ResultUser = $Con -> query($selUser);
	$selDes = "select * from tbl_designer where designer_email = '$Email' and designer_password = '$Password'";
	$ResultDes = $Con -> query($selDes);
	if($data = $ResultAdmin -> fetch_assoc())
	{
		$_SESSION['aid'] = $data['admin_id'];
		header("location:../Admin/HomePage.php");
	}
	else if($data = $ResultMan -> fetch_assoc())
	{
		if($data['manufacturer_vstatus']==1)
		{
		$_SESSION['mid']=$data['manufacturer_id'];
		header("location:../Manufacturer/HomePage.php");
		}
		else if($data['manufacturer_vstatus']==2)
		{
			?>
			<script>
			alert("Rejected");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Pending");
			</script>
            <?php
		}
	}
	else if($data = $ResultUser -> fetch_assoc())
	{
		$_SESSION['uid']=$data['user_id'];
		header("location:../User/HomePage.php");
	}
	else if($data = $ResultDes -> fetch_assoc())
	{
		$_SESSION['did']=$data['designer_id'];
		header("location:../Designer/HomePage.php");
	}
	else{
		?>
			<script>
			alert("Invalid Credentials")
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
      <td>E mail</td>
      <td><label for="txt_mail"></label>
      <input type="email" name="txt_mail" id="txt_mail" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pwd"></label>
      <input type="password" name="txt_pwd" id="txt_pwd" /></td>
    </tr>
	<tr>
	<td colspan="2">
	<a href="ForgotPassword.php">Forgot Password?</a>
    </td>
	</tr>
    <tr>
      <td colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Login" />
      <input type="reset" name="btn_clear" id="btn_clear" value="Clear" /></td>
    </tr>
  </table>
</form>
</body>
</html>