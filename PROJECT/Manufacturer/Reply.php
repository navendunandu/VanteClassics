<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_reply']))
{
	$reply=$_POST['txt_reply'];
	$insQry="update tbl_complaint set complaint_reply='$reply',complaint_status='1' where complaint_id=".$_GET['cid'];
	if($Con->query($insQry))
	{
	}
	else
	{
		echo "Error";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .reply-container {
            max-width: 400px; /* Limit width */
            margin: auto; /* Center the container */
            margin-top: 50px; /* Space above */
            padding: 20px; /* Padding around */
            background-color: #fff; /* White background for the card */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .reply-container .btn {
            background-color: #6c7ae0; /* Button color */
            color: white; /* Text color */
        }
        .reply-container .btn:hover {
            background-color: #5a6fb2; /* Darker shade on hover */
        }
    </style>
</head>
<body>
<div class="reply-container">
    <div class="text-center mb-4">
        <h5>Reply</h5>
    </div>
    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3">
            <label for="txt_reply" class="form-label">Your Reply</label>
            <input required type="text" class="form-control" name="txt_reply" id="txt_reply" />
        </div>
        <div class="text-center">
            <button type="submit" name="btn_reply" id="btn_reply" class="btn">Reply</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<br>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>