<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_register']))
{
	$name=$_POST['txt_name'];
	$contact=$_POST['txt_contact'];
	$email=$_POST['txt_email'];
	$pwd=$_POST['txt_pwd'];
	$id=$_POST['txt_id'];
	$selUser="select * from tbl_user where user_email='".$email."'";
	$selAdmin="select * from tbl_adminreg where admin_email='".$email."'";
	$selMan="select * from tbl_manufacturer where manufacturer_email='".$email."'";
	$selDes="select * from tbl_designer where designer_email='".$email."'";
	$resUser=$con->query($selUser);
	$resAdmin=$con->query($selAdmin);
	$resMan=$con->query($selMan);
	$resDes=$con->query($selDes);
	
	if($resUser->num_rows>0 || $resAdmin->num_rows>0 || $resTeacher->num_rows>0){
		?>
		  <script>
		    alert("Email Already Exists");
		  </script>
		  <?php	
	}
	else{

	if($id!='')
	{
		$UpQry="update tbl_adminreg set admin_name='$name',admin_contact='$contact',admin_email='$email',admin_pwd='$pwd' where admin_id='$id'";
		if($Con->query($UpQry))
		{
			echo "Updated";	
		}
		else
		{
			echo "Error";
		}
	}else
	{
	$InsQry="insert into tbl_adminreg(admin_name,admin_contact,admin_email,admin_pwd) values('$name','$contact','$email','$pwd')";
	if($Con->query($InsQry))
	{
		echo "Inserted";
	}
	else
	{
		echo "Error";	
	}
}
	}
}
$aname='';
$aid='';
$acontact='';
$amail='';
$apwd='';
if(isset($_GET['did']))
{
	$DelQry="delete from tbl_adminreg where admin_id=".$_GET['did'];
	if($Con->query($DelQry))?>
    <script>
	window.location="AdminRegistration.php";
	</script>
    <?php	
}
if(isset($_GET['eid']))
{
	$selQry="select * from tbl_adminreg where admin_id=".$_GET['eid'];
	$data=$Con->query($selQry);
	$row=$data->fetch_assoc();
	$aid=$row['admin_id'];
	$aname=$row['admin_name'];
	$acontact=$row['admin_contact'];
	$amail=$row['admin_email'];
	$apwd=$row['admin_pwd'];
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
      <td>Name</td>
      <td><label for="txt_name"></label>
        <label for="txt_name"></label>
        <input required type="text" name="txt_name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" value="<?php echo $aname;?>" /></td>
       <td> <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $aid;?>"/></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input required type="text" name="txt_contact"  pattern="[7-9]{1}[0-9]{9}" 
                title="Phone number with 7-9 and remaing 9 digit with 0-9" id="txt_contact" value="<?php echo $acontact;?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" required id="txt_email" value="<?php echo $amail;?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pwd"></label>
      <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_pwd" id="txt_pwd" value="<?php echo $apwd;?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_register" id="btn_register" value="Register" /></td>
    </tr>
  </table>
</form>
<br>
<table>
<tr>
<td>Sl No.</td>
<td>Name</td>
<td>Contact</td>
<td>E Mail</td>
<td>Action</td>
</tr>
   <?php
	$i = 0;
    $selQry = "select * from tbl_adminreg ";
	$result = $Con->query($selQry);
	while($row = $result->fetch_assoc())
	{
		$i++;
	?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['admin_name'];?></td>
<td><?php echo $row['admin_contact'];?></td>
<td><?php echo $row['admin_email'];?></td>
<td><a href="AdminRegistration.php?did=<?php echo $row['admin_id'];?>">Delete</a>
<a href="AdminRegistration.php?eid=<?php echo $row['admin_id'];?>">Edit</a></td>
</tr>
<?php
	}
	?>
</table>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>