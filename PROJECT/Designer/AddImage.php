<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit'])){
$file=$_FILES['file_img']['name'];
$tempfile=$_FILES['file_img']['tmp_name'];
move_uploaded_file($tempfile, '../Assets/Files/Designer/Custom/'.$file);
echo $qry="update tbl_assign set assign_image='".$file."', assign_status=1 where assign_id=".$_GET['aid'];
if($Con->query($qry)){
        ?>
<script>
	alert("Uploaded");
    window.location="Request.php"
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
<title>Add Image</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General container styling */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            padding: 20px;
        }

        /* Card styling */
        .card {
            width: 100%;
            max-width: 400px; /* Limits the card width */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }

        /* Table styling */
        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Collapse borders */
        }

        /* Input styling */
        input[type="file"] {
            padding: 5px;
        }

        /* Button styling */
        input[type="submit"] {
            background-color: #6c7ae0; /* Your preferred color */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5a6ab0; /* Darker shade on hover */
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <div class="card">
            <h2 class="text-center">Add Image</h2>
            <form enctype="multipart/form-data" method="post">
                <table class="table">
                    <tr>
                        <td><label for="file_img">Upload Image:</label></td>
                        <td><input type="file" name="file_img" id="file_img" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>