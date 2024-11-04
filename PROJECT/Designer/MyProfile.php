<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$SelQry="select * from tbl_designer ds inner join tbl_place p on ds.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where designer_id=".$_SESSION['did'];
$result=$Con->query($SelQry);
$row=$result->fetch_assoc()

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Designer Profile</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .profile-container {
      max-width: 400px;
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-links {
      text-align: center;
      margin-top: 20px;
    }

    .profile-links a {
      text-decoration: none;
      color: #6c7ae0; /* Bootstrap primary color */
      font-weight: bold;
      margin: 0 10px;
    }

    .profile-links a:hover {
      color: #2956d5; /* Darker shade on hover */
      text-decoration: underline;
    }

    .profile-image {
      width: 100%;
      height: auto;
      border-radius: 50%; /* Circular image */
      margin-bottom: 20px;
    }

    .profile-info label {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="profile-container">
    <div class="profile-header">
      <img src="../Assets/Files/designer/Photo/<?php echo $row['designer_photo'];?>" class="profile-image" alt="Designer Photo">
    </div>

    <div class="profile-info">
      <p><label>Name:</label> <?php echo $row['designer_name'];?></p>
      <p><label>Email:</label> <?php echo $row['designer_email'];?></p>
      <p><label>Contact:</label> <?php echo $row['designer_contact'];?></p>
      <p><label>Address:</label> <?php echo $row['designer_address'];?></p>
      <p><label>District:</label> <?php echo $row['district_name'];?></p>
      <p><label>Place:</label> <?php echo $row['place_name'];?></p>
    </div>

    <div class="profile-links">
      <a href="EditProfile.php">Edit Profile</a>
      <a href="ChangePassword.php">Change Password</a>
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