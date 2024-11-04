<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select designer_password from tbl_designer where designer_id=".$_SESSION['did'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_oldpwd'];
	$new=$_POST['txt_newpwd'];
	$retype=$_POST['txt_repwd'];
	if($old!=$row['designer_password'])
	{
		echo "Incorrect Password";
	}
	else if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$UpQry="update tbl_designer set designer_password='$new' where designer_id=".$_SESSION['did'];
		if($Con->query($UpQry))
		{
			echo "Updated";
			
		}
		else
		{
			echo "Error";
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

    .btn-primary {
      background-color: #6c7ae0;
      border-color: #6c7ae0;
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
    <div class="form-container shadow">
      <h3 class="text-center">Change Password</h3>
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_oldpwd">Old Password</label>
          <input type="password" class="form-control" name="txt_oldpwd" id="txt_oldpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        </div>

        <div class="form-group">
          <label for="txt_newpwd">New Password</label>
          <input type="password" class="form-control" name="txt_newpwd" id="txt_newpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        </div>

        <div class="form-group">
          <label for="txt_repwd">Re-type Password</label>
          <input type="password" class="form-control" name="txt_repwd" id="txt_repwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary">Change Password</button>
          <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>