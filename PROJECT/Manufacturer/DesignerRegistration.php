<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_register']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txt_address'];
	$place=$_POST['sel_place'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Designer/Photo/'.$photo);
	$pwd=$_POST['txt_pwd'];
	$cpwd=$_POST['txt_cpwd'];
	$mid=$_SESSION['mid'];
	$selUser="select * from tbl_user where user_email='".$email."'";
	$selAdmin="select * from tbl_adminreg where admin_email='".$email."'";
	$selMan="select * from tbl_manufacturer where manufacturer_email='".$email."'";
	$selDes="select * from tbl_designer where designer_email='".$email."'";
	$resUser=$Con->query($selUser);
	$resAdmin=$Con->query($selAdmin);
	$resMan=$Con->query($selMan);
	$resDes=$Con->query($selDes);
	
	if($resUser->num_rows>0 || $resAdmin->num_rows>0 || $resMan->num_rows>0||$resDes->num_rows>0){
		?>
		  <script>
		    alert("Email Already Exists");
		  </script>
		  <?php	
	}
	else{
	$InsQry="insert into tbl_designer(designer_name,designer_email,designer_password,designer_address,designer_photo,designer_contact,place_id,manufacturer_id) values('$name','$email','$pwd','$address','$photo','$contact','$place','$mid')";
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
.table-container {
            margin: 20px auto;
            max-width: 900px; /* Set a max width for the table */
            background: white; /* White background for the table */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Rounded corners effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }
.table th {
  background-color: #6c7ae0; /* Your preferred shade for header */
  color: white; /* White text on header */
}

.btn-primary {
  background-color: #6c7ae0; /* Your preferred shade for the button */
  border-color: #6c7ae0; /* Match border color */
}

.btn-primary:hover {
  background-color: #5b6bb3; /* Darker shade on hover */
  border-color: #5b6bb3; /* Match border color on hover */
}

  </style>
</head>
<body>
  <div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
                     id="txt_name" class="form-control" />
            </td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
              <input required type="email" name="txt_email" id="txt_email" class="form-control" />
            </td>
          </tr>
          <tr>
            <td>Contact</td>
            <td>
              <input required type="text" name="txt_contact" pattern="[6-9]{1}[0-9]{9}" 
                     title="Phone number with 6-9 and remaining 9 digits with 0-9" 
                     id="txt_contact" class="form-control" />
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>
              <textarea required name="txt_address" id="txt_address" 
                        class="form-control" rows="5"></textarea>
            </td>
          </tr>
          <tr>
            <td>District</td>
            <td>
              <select required name="sel_dis" id="sel_dis" 
                      class="form-control" onChange="getPlace(this.value)">
                <option value="">--Select--</option>
                <?php
                  $SelQry="select * from tbl_district";
                  $row=$Con->query($SelQry);
                  while($data=$row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name'];?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Place</td>
            <td>
              <select required name="sel_place" id="sel_place" class="form-control">
              </select>
            </td>
          </tr>
          <tr>
            <td>Photo</td>
            <td>
              <input type="file" name="file_photo" id="file_photo" class="form-control-file" />
            </td>
          </tr>
          <tr>
            <td>Password</td>
            <td>
              <input type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" 
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 characters" 
                     id="txt_pwd" class="form-control" />
            </td>
          </tr>
          <tr>
            <td>Confirm Password</td>
            <td>
              <input type="password" name="txt_cpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" 
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 characters" 
                     id="txt_cpwd" class="form-control" />
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <input type="submit" name="btn_register" id="btn_register" value="Register" class="btn btn-primary" />
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</body>

 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

</script>
</html>
<?php
include("Foot.php");
ob_flush();
?>