<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select * from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where user_id=".$_SESSION['uid'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc()

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .profile-container {
            max-width: 400px; /* Limit width */
            margin: auto; /* Center the container */
            padding: 20px; /* Padding around */
            background-color: #fff; /* White background for the card */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .profile-header {
            text-align: center; /* Center text */
            margin-bottom: 20px; /* Space below */
        }
        .profile-links {
            text-align: center; /* Center links */
            margin-top: 20px; /* Space above */
        }
        .profile-links a {
            text-decoration: none; /* Remove underline */
            color: #6c7ae0; 
            font-weight: bold; /* Bold text */
            margin: 0 10px; /* Space between links */
        }
        .profile-links a:hover {
            color: #2956d5; /* Darker shade on hover */
            text-decoration: underline; /* Underline on hover */
        }
        .profile-image {
            width: 100%;
            height: auto;
            border-radius: 50%; /* Circular image */
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="profile-container">
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-borderless">
            <tr>
                <td colspan="2" class="text-center">
                    <img src="../Assets/Files/User/Photo/<?php echo $row['user_photo'];?>" class="profile-image" height="200" alt="User Photo" />
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $row['user_name'];?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $row['user_email'];?></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><?php echo $row['user_contact'];?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $row['user_address'];?></td>
            </tr>
            <tr>
                <td>District</td>
                <td><?php echo $row['district_name'];?></td>
            </tr>
            <tr>
                <td>Place</td>
                <td><?php echo $row['place_name'];?></td>
            </tr>
        </table>
        <div class="profile-links">
            <a href="EditProfile.php">Edit Profile</a>
            <a href="ChangePassword.php">Change Password</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>