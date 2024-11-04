<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select manufacturer_password from tbl_manufacturer where manufacturer_id=".$_SESSION['mid'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_oldpwd'];
	$new=$_POST['txt_newpwd'];
	$retype=$_POST['txt_repwd'];
	if($old!=$row['manufacturer_password'])
	{
    ?>
		<script>
		alert("Incorrect Password");
		</script>
        <?php
	}
	else if($new!=$retype)
	{
    ?>
		<script>
		alert("Password doesn't match");
		</script>
        <?php
	}
	else
	{
		$UpQry="update tbl_manufacturer set manufacturer_password='$new' where manufacturer_id=".$_SESSION['mid'];
		if($Con->query($UpQry))
		{
      ?>
      <script>
      alert("Updated");
      window.location="MyProfile.php";
      </script>
          <?php
			
		}
		else
		{
      ?>
      <script>
      alert("Something went wrong");
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
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
  <style>
    /* Styling the form container */
    .password-change-form {
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    /* Custom button styling */
    .btn-custom {
      background-color: #6c7ae0;
      color: white;
    }

    /* Input styling */
    .form-control {
      border-radius: 5px;
    }

    /* Form heading */
    .form-heading {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <form id="form1" name="form1" method="post" class="password-change-form">
    <h2 class="form-heading">Change Password</h2>
    <div class="form-group">
      <label for="txt_oldpwd">Old Password</label>
      <input type="password" class="form-control" name="txt_oldpwd" id="txt_oldpwd" type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required placeholder="Enter Old Password" >
    </div>
    <div class="form-group">
      <label for="txt_newpwd">New Password</label>
      <input type="password" class="form-control" name="txt_newpwd" id="txt_newpwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number, one uppercase, and lowercase letter, and be at least 8 characters,maximum 10 characters" placeholder="Enter new Password">
    </div>
    <div class="form-group">
      <label for="txt_repwd">Re-type Password</label>
      <input type="password" class="form-control" name="txt_repwd" id="txt_repwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number, one uppercase, and lowercase letter, and be at least 8 characters,maximum 10 characters" placeholder="Re-enter Password">
    </div>
    <div class="form-group text-right">
      <button type="submit" class="btn btn-custom">Change Password</button>
      <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>