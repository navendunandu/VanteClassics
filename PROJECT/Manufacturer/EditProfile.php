<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select * from tbl_manufacturer where manufacturer_id=".$_SESSION['mid'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_edit']))
{
	$name=$_POST['txt_name'];
	$contact=$_POST['txt_contact'];
	$email=$_POST['txt_email'];
	$address=$_POST['txt_address'];
	$UpQry="update tbl_manufacturer set manufacturer_name='$name',manufacturer_email='$email',manufacturer_contact='$contact',manufacturer_address='$address' where manufacturer_id=".$_SESSION['mid'];
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
<style>
body {
  background-color: #f8f9fa; /* Light background for contrast */
}

.table th {
  background-color: #6c7ae0; /* Header color */
  color: white; /* White text on header */
}

.btn-primary {
  background-color: #6c7ae0; /* Button color */
  border-color: #6c7ae0; /* Button border color */
}

.btn-primary:hover {
  background-color: #5b6bb3; /* Darker shade on hover */
  border-color: #5b6bb3; /* Match border color on hover */
}
</style>
</head>

<body>
  <div class="container mt-5">
    <form id="form1" name="form1" method="post" action="">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Field</th>
            <th>Input</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Name</td>
            <td>
              <input required type="text" name="txt_name" 
                     title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                     pattern="^[A-Z]+[a-zA-Z ]*$" 
                     id="txt_name" 
                     class="form-control" 
                     value="<?php echo $row['manufacturer_name'];?>" />
            </td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
              <input required type="email" name="txt_email" id="txt_email" 
                     class="form-control" 
                     value="<?php echo $row['manufacturer_email'];?>" />
            </td>
          </tr>
          <tr>
            <td>Contact</td>
            <td>
              <input required type="text" name="txt_contact" id="txt_contact" 
                     class="form-control" 
                     value="<?php echo $row['manufacturer_contact'];?>" />
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>
              <textarea required name="txt_address" id="txt_address" 
                        class="form-control" rows="5"><?php echo $row['manufacturer_address'];?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <input type="submit" name="btn_edit" id="btn_edit" value="Edit" 
                     class="btn btn-primary" />
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>