<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_change'])){
    
if(isset($_SESSION['ruid']))
{
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
	if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
    {
		$UpQry="update tbl_user set user_password='$new' where user_id=".$_SESSION['ruid'];
		if($Con->query($UpQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
		<?php
		 clearSession();
	}
    }
}
else if(isset($_SESSION['rmid']))
{
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
	if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$UpQry="update tbl_manufacturer set manufacturer_password='$new' where manufacturer_id=".$_SESSION['rmid'];
		if($Con->query($UpQry))
		{
			?>
			<script>
				alert("Password Updated")
				window.location="LogOut.php"
				</script>
			<?php
			 clearSession();
		}
	}
}
else if(isset($_SESSION['rdid']))
{
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
	if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$UpQry="update tbl_designer set designer_password='$new' where designer_id=".$_SESSION['rdid'];
		if($Con->query($UpQry))
		{
			?>
			<script>
				alert("Password Updated")
				window.location="LogOut.php"
				</script>
			<?php
		} clearSession();
	}
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
      }

      form {
        width: 350px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px #ddd;
        background-color: #fff;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      td {
        padding: 10px;
        font-size: 14px;
        color: #555;
      }

      input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
      }

      input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #6c7ae0; /* Theme color */
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      input[type="submit"]:hover {
        background-color: #5a6bbd; /* Darker shade for hover */
      }
    </style>
</head>
<body>
<form method="post" action="">
      <table>
        <tr>
          <td>New Password</td>
          <td><input type="password" name="txt_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required id="txt_pass"></td>
        </tr>
        <tr>
          <td>Confirm Password</td>
          <td><input type="password" name="txt_cpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required id="txt_cpass" id=""></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="btn_change" value="Change Password">
          </td>
        </tr>
      </table>
    </form>
</body>
</html>