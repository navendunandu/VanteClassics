<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$mat=$_POST['sel_mat'];
	$col=$_POST['sel_col'];
	$cat=$_POST['sel_cat'];
	$message=$_POST['txt_mes'];
	$file=$_FILES['file_rfile']['name'];
	$tempfile=$_FILES['file_rfile']['tmp_name'];
	move_uploaded_file($tempfile, '../Assets/Files/User/CustomDesign/'.$file);
	$uid=$_SESSION['uid'];
	$mid=$_GET['mid'];
	$insQry="insert into tbl_request(material_id,category_id,color_id,request_content,request_date,user_id,manufacturer_id,request_file) values ('$mat','$cat','$col','$message',curdate(),'$uid','$mid','$file')";
	if($Con->query($insQry))
	{
    ?>
<script>
  alert("Request Send")
  window.location="MyCustomizations.php"
</script>
    <?php
	}
	else{
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
    .card {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      background-color: #fff;
    }
    .card h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .form-group label {
      font-weight: bold;
      color: #555;
    }
    input, select, textarea {
      border-radius: 10px;
      border: 1px solid #ddd;
      padding: 10px;
      width: 100%;
    }
    input[type="file"] {
      padding: 3px;
    }
    textarea {
      resize: none;
    }
    input[type="submit"] {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      border-radius: 10px;
      background-color: #6c7ae0;
      color: white;
      border: none;
      font-weight: bold;
    }
    input[type="submit"]:hover {
      background-color: #574bff;
    }
  </style>
</head>

<body>

<div class="container">
  <div class="card">
    <h3>Submit Your Design</h3>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      
      <!-- Material Dropdown -->
      <div class="form-group">
        <label for="sel_mat">Material</label>
        <select required class="form-control" name="sel_mat" id="sel_mat">
          <option value="">--Select--</option>
          <?php
            $SelQry="select * from tbl_material";
            $row=$Con->query($SelQry);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['material_id']?>"><?php echo $data['material_name'];?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Colour Dropdown -->
      <div class="form-group">
        <label for="sel_col">Colour</label>
        <select required class="form-control" name="sel_col" id="sel_col">
          <option value="">--Select--</option>
          <?php
            $SelQry="select * from tbl_color";
            $row=$Con->query($SelQry);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['color_id']?>"><?php echo $data['color_name'];?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Category Dropdown -->
      <div class="form-group">
        <label for="sel_cat">Category</label>
        <select required class="form-control" name="sel_cat" id="sel_cat">
          <option value="">--Select--</option>
          <?php
            $SelQry="select * from tbl_category";
            $row=$Con->query($SelQry);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name'];?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Message Textarea -->
      <div class="form-group">
        <label for="txt_mes">Message</label>
        <textarea class="form-control" name="txt_mes" id="txt_mes" cols="45" rows="5" placeholder="Enter your message"></textarea>
      </div>

      <!-- File Upload -->
      <div class="form-group">
        <label for="file_rfile">Design Image</label>
        <input type="file" class="form-control-file" name="file_rfile" id="file_rfile" />
      </div>

      <!-- Submit Button -->
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit">

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