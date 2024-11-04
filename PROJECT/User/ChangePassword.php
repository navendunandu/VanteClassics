<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
$SelQry="select user_password from tbl_user where user_id=".$_SESSION['uid'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_oldpwd'];
	$new=$_POST['txt_newpwd'];
	$retype=$_POST['txt_repwd'];
	if($old!=$row['user_password'])
	{
		?>
		<script>
		alert("Incorrect password")
		</script>
        <?php
	}
	else if($new!=$retype)
	{
		?>
		<script>
		alert("Password doesn't match")
		</script>
        <?php
	}
	else
	{
		$UpQry="update tbl_user set user_password='$new' where user_id=".$_SESSION['uid'];
		if($Con->query($UpQry))
		{
			?>
		<script>
		alert("Updated")
		window.location="MyProfile.php";
		</script>
        <?php
			
		}
		else
		{
			?>
		<script>
		alert("Something went wrong")
		window.location="MyProfile.php";
		</script>
        <?php
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <!-- Bootstrap CSS -->
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h3 {
      margin-bottom: 20px;
      color: #333;
    }

    /* Custom color for the submit button */
    .btn-primary {
      background-color: #6c7ae0;
      border-color: #6c7ae0;
    }
    .btn-primary:hover {
  background-color: #5a69c9; /* Darker shade of #6c7ae0 */
  border-color: #5a69c9;
}
input[type="submit"]:hover {
            background-color: #5a6ab0; /* Darker shade on hover */
        }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
  </style>

</head>

<body>
<div class="container">
  <div class="form-container">
    <h2>Change Password</h2>
    <form id="form1" name="form1" method="post" action="">
      <div class="form-group">
        <label for="txt_oldpwd">Old Password</label>
        <input required type="password" class="form-control" name="txt_oldpwd" id="txt_oldpwd" type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required  placeholder="Enter Old Password">
      </div>
      <div class="form-group">
        <label for="txt_newpwd">New Password</label>
        <input required type="password" class="form-control" name="txt_newpwd" id="txt_newpwd" type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required placeholder="Enter New Password">
      </div>
      <div class="form-group">
        <label for="txt_repwd">Re-type Password</label>
        <input required type="password" class="form-control" name="txt_repwd" id="txt_repwd" type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required placeholder="Re-enter Password">
      </div>
      <input type="submit" class="btn btn-primary" name="btn_change" id="btn_change" value="Change Password">
      <input type="reset" class="btn btn-secondary" name="btn_cancel" id="btn_cancel" value="Cancel">
    </form>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>