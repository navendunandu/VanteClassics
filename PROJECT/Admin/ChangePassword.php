<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select admin_pwd from tbl_adminreg where admin_id=".$_SESSION['aid'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_oldpwd'];
	$new=$_POST['txt_newpwd'];
	$retype=$_POST['txt_repwd'];
    $dbP=$row['admin_pwd'];
    if($old==$dbP){
        if($new==$retype){
            $UpQry="update tbl_adminreg set admin_pwd='$new' where admin_id=".$_SESSION['aid'];
		if($Con->query($UpQry))
		{
            ?>
            <script>
                alert("Updated")
            </script>
                <?php
			
		}
        else{
            ?>
            <script>
                alert("Failed")
            </script>
            <?php
        }
        }
        else{
            ?>
            <script>
                alert("Retype Password Not Matched")
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
            alert("Old Password Not Matched")
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  
  <!-- Nucleo Icons -->
  <link href="../Assets/Templates/Admin/assets/css/nucleo-icons.css" rel="stylesheet" />
  
  <!-- CSS Files -->
  <link href="../Assets/Templates/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../Assets/Templates/Admin/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  
  <!-- Custom CSS -->
  <style>
    .password-change-container {
      margin-top: 30px;
      background-color: #1e1e2f;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      color: #ffffff;
    }
    .password-change-container h2 {
      font-size: 24px;
      font-weight: 600;
      color: #ffffff;
    }
    .form-group label {
      font-weight: 600;
      color: #d3d3e7;
    }
    .form-control {
      background-color: #2a2a3c;
      border: 1px solid #2a2a3c;
      color: #ffffff;
      border-radius: 4px;
      padding: 12px;
    }
    .form-control:focus {
      border-color: #6c7ae0;
      background-color: #2a2a3c;
      box-shadow: none;
    }
    .btn-custom {
      background-color: #6c7ae0;
      border-color: #6c7ae0;
      color: #ffffff;
      border-radius: 4px;
      padding: 10px 20px;
      font-weight: bold;
    }
    .btn-custom:hover {
      background-color: #5a67d8;
    }
    .btn-secondary {
      background-color: #6c757d;
      color: #ffffff;
      border-radius: 4px;
      padding: 10px 20px;
    }
  </style>
</head>
<body class="">
  <div class="wrapper">
    <div class="main-panel">
      
      <!-- Change Password Form -->
      <div class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="password-change-container">
                <h2>Change Password</h2>
                <form id="form1" name="form1" method="post" class="password-change-form">
                  <div class="form-group">
                    <label for="txt_oldpwd">Old Password</label>
                    <input type="password" class="form-control" name="txt_oldpwd" id="txt_oldpwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="First letter must be uppercase">
                  </div>
                  <div class="form-group">
                    <label for="txt_newpwd">New Password</label>
                    <input type="password" class="form-control" name="txt_newpwd" id="txt_newpwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number, one uppercase, and lowercase letter, and must be 8 characters">
                  </div>
                  <div class="form-group">
                    <label for="txt_repwd">Re-type Password</label>
                    <input type="password" class="form-control" name="txt_repwd" id="txt_repwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must match the new password criteria">
                  </div>
                  <div class="form-group text-right">
                    <button type="submit" name="btn_change" class="btn btn-primary">Change Password</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <!-- JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>