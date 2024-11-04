<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select * from tbl_designer where designer_id=".$_SESSION['did'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_edit']))
{
	$name=$_POST['txt_name'];
	$contact=$_POST['txt_contact'];
	$email=$_POST['txt_email'];
	$address=$_POST['txt_address'];
	$UpQry="update tbl_designer set designer_name='$name',designer_email='$email',designer_contact='$contact',designer_address='$address' where designer_id=".$_SESSION['did'];
	if($Con->query($UpQry))
	{
		?>
		<script>
		alert("Updated")
		window.location="EditProfile.php";
		</script>
        <?php
	}
		else
	{
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
    <!-- Bootstrap CSS -->
    <link rel="icon" type="image/png" href="../Assets/Templates/Main/images/icons/favicon.png">
    <link rel="stylesheet" type="text/css" href="../Assets/Templates/Main/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Assets/Templates/Main/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Assets/Templates/Main/css/main.css">
    <style>
    .btn-primary {
  background-color: #6c7ae0;
  border-color: #6c7ae0;
}
input[type="submit"]:hover {
            background-color: #5a6ab0; /* Darker shade on hover */
        }
</style>
</head>

<body>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-4">Edit Designer Profile</h2>
        <form id="form1" name="form1" method="post" action="">

            <!-- Name Field -->
            <div class="form-group row mb-3">
                <label for="txt_name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_name" title="Name allows only alphabets, spaces, and the first letter must be capital." pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" value="<?php echo $row['designer_name'];?>" required />
                </div>
            </div>

            <!-- Email Field -->
            <div class="form-group row mb-3">
                <label for="txt_email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $row['designer_email'];?>" required />
                </div>
            </div>

            <!-- Contact Field -->
            <div class="form-group row mb-3">
                <label for="txt_contact" class="col-sm-2 col-form-label">Contact</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_contact" pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 and the remaining 9 digits should be 0-9." id="txt_contact" value="<?php echo $row['designer_contact'];?>" required />
                </div>
            </div>

            <!-- Address Field -->
            <div class="form-group row mb-3">
                <label for="txt_address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <textarea name="txt_address" class="form-control" id="txt_address" rows="4" required><?php echo $row['designer_address'];?></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <input type="submit" name="btn_edit" id="btn_edit" class="btn btn-primary" value="Edit" />
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