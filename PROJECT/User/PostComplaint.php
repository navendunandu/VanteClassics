<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	// $title=$_POST['txt_title'];
	$des=$_POST['txt_des'];
	$file=$_FILES['file_complaint']['name'];
	$tempfile=$_FILES['file_complaint']['tmp_name'];
	move_uploaded_file($tempfile, '../Assets/Files/User/Complaint/'.$file);
	$pid=$_GET['pid'];
	$uid=$_SESSION['uid'];
	$InsQry="insert into tbl_complaint(complaint_content,complaint_date,user_id,product_id,complaint_file) values('$des',curdate(),'$uid','$pid','$file')";
	if($Con->query($InsQry))
  
	{
    ?>
    <script>
window.location="Booking.php";
</script>
    <?php
	}
	else{
		echo "Error";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        /* Body styling */
        body {
            background-color: #f7f9fc; /* Light background color */
           
        }

        /* Card styling */
        .complaint-card {
            max-width: 600px; /* Maximum width for the card */
            margin: 0 auto; /* Center the card */
            padding: 20px;
            background-color: #ffffff; /* White background for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
            border-radius: 8px; /* Rounded corners */
        }

        /* Heading styling */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #574bff;
        }

        /* Textarea styling */
        textarea {
            resize: none; /* Disable resizing */
        }

        /* Button styling */
        .btn-submit {
            width: 100%; /* Full-width button */
            background-color: #6c7ae0;
            color: white;
        }

        .btn-submit:hover {
            background-color: #574bff; 
        }
    </style>
</head>

<body>

<div class="container">
    <div class="complaint-card">
        <h2>Submit Your Complaint</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <label for="txt_des">Complaint</label>
                <textarea required class="form-control" name="txt_des" id="txt_des" cols="45" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="file_complaint">File</label>
                <input type="file" class="form-control-file" name="file_complaint" id="file_complaint" />
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </form>
    </div>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>