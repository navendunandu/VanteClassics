<?php
include("../Assets/Connection/connection.php");
session_start();

if(isset($_POST['btn_submit']))
{
	$Email = $_POST['txt_mail'];
	$Password = $_POST['txt_pwd'];
	
	$selAdmin = "select * from tbl_adminreg where admin_email = '$Email' and admin_pwd = '$Password'";
	$ResultAdmin = $Con -> query($selAdmin);
	$selMan = "select * from tbl_manufacturer where manufacturer_email = '$Email' and manufacturer_password = '$Password'";
	$ResultMan = $Con -> query($selMan);
	$selUser = "select * from tbl_user where user_email = '$Email' and user_password = '$Password'";
	$ResultUser = $Con -> query($selUser);
	$selDes = "select * from tbl_designer where designer_email = '$Email' and designer_password = '$Password'";
	$ResultDes = $Con -> query($selDes);
	if($data = $ResultAdmin -> fetch_assoc())
	{
		$_SESSION['aid'] = $data['admin_id'];
		header("location:../Admin/HomePage.php");
	}
	else if($data = $ResultMan -> fetch_assoc())
	{
		if($data['manufacturer_vstatus']==1)
		{
		$_SESSION['mid']=$data['manufacturer_id'];
    $_SESSION['mname']=$data['manufacturer_name'];
		header("location:../Manufacturer/HomePage.php");
		}
		else if($data['manufacturer_vstatus']==2)
		{
			?>
			<script>
			alert("Rejected");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Pending");
			</script>
            <?php
		}
	}
	else if($data = $ResultUser -> fetch_assoc())
	{
		$_SESSION['uid']=$data['user_id'];
		header("location:../User/HomePage.php");
	}
	else if($data = $ResultDes -> fetch_assoc())
	{
		$_SESSION['did']=$data['designer_id'];
		header("location:../Designer/HomePage.php");
	}
	else{
		?>
			<script>
			alert("Invalid Credentials")
			</script>
		<?php	
		}
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - CSS/SVG Lines App Concept</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../Assets/Templates/Login/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="route" id="welcome"></div>
<form method="post" id="app">
  <div class="app-view">  
    <header class="app-header">
      <h1>Vante Classics</h1>
      Welcome back,<br/>
      <span class="app-subheading">
        sign in to continue<br/>
        to Vante Classics.
      </span>
    </header>
    <input class="app-input" name="txt_mail" type="email" required pattern=".*\.\w{2,}" placeholder="Email Address" />
    <input class="app-input" type="password" name="txt_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters,maximum 10 character" required id="txt_cpass" id=""placeholder="Password" />
    <input type="submit" name="btn_submit" value="Login" class="app-button">
    <div class="app-register">
    <a href="ForgotPassword.php">Forgot Password? </a>
    </div>
    <svg id="svg-lines" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 284.2 152.7" xml:space="preserve">
      <path class="st0" d="M37.7,107.3h222.6c12,0,21.8,9.7,21.8,21.7s-9.7,21.8-21.8,21.8c0,0-203.6,0-222.6,0S2.2,138.6,2.2,103.3   c0-52,113.5-101.5,141-101.5c13.5,0,21.8,9.7,21.8,21.8s-9.7,21.7-21.8,21.7s-21.8-9.7-21.8-21.7s9.7-21.8,21.8-21.8"/>
      <path class="st1" d="M260.2,76.3L250,87.8l-9-9c-6.2-6.2,2-24.7,17.2-24.7c15.2,0,23.9,17.7,23.9,29.7s-11.7,23.5-23.9,23.5h-10.2"></path>
      <g class="svg-loader" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-loader-segment -cal" d="M164.7,23.5c0-12-9.7-21.8-21.8-21.8"/>
        <path class="svg-loader-segment -heart" d="M143,45.2c12,0,21.8-9.7,21.8-21.7"/>
        <path class="svg-loader-segment -steps" d="M121.2,23.5c0,12,9.7,21.7,21.8,21.7"/>
        <path class="svg-loader-segment -temp" d="M143,1.7c-12,0-21.8,9.7-21.8,21.8"/>
      </g>
    </svg>
  </div>
  <div class="app-view">
    <header class="app-header">
      <div class="app-bar">      
        <div class="app-menu-icon"></div>
        <img class="app-avatar" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/181794/Screen_Shot_2016-03-18_at_12.52.15_AM.png"/>
      </div>
      <h2>
        Welcome back Jana,<br/>
        Things look <em>alright</em>.
      </h2>
    </header>
    <section class="app-content">
      <div class="app-item">
        <div class="app-data">36.75&deg;</div>
        <div class="app-label">Temperature</div>
        <div class="app-graphic">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 102.7 21.4"  xml:space="preserve">
            <path class="svg-data -temp" d="M2,15.2c0,0,8.3-11.3,18.7-11.3s12.7,13.7,22,13.7S52,8.2,57,8.2s8.3,5,11.3,5s9.3-2.5,13-2.5   c3.7,0,5.3,4.2,9.7,4.2c4.3,0,9.7-9.7,9.7-9.7"/>
          </svg>
        </div>
      </div>
      <div class="app-item">
        <div class="app-data">537<span class="app-unit">cal</span></div>
        <div class="app-label">Calories Burned</div>
        <div class="app-graphic">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 102.7 21.4"  xml:space="preserve">
            <path class="svg-data -cal" d="M2,6.7c0,0,9.7,6.7,18.3,6.7s12.3-6.7,23.3-6.7c4.9,0,4-3.7,8.7-3.7c7,0,12,15.3,18.7,15.3   c6.7,0,8.7-6.8,13.3-6.8c4.7,0,5,4.5,8.7,4.5c3.7,0,7.7-4.5,7.7-4.5"/>
          </svg>
        </div>
      </div>
      <div class="app-item">
        <div class="app-data">7342</div>
        <div class="app-label">Steps</div>
        <div class="app-graphic">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 102.7 21.4"  xml:space="preserve">
            <line class="svg-data -steps-bg" x1="2" y1="10.7" x2="100.7" y2="10.7"/>
            <line class="svg-data -steps" x1="2" y1="10.7" x2="75" y2="10.7"/>
          </svg>
        </div>
      </div>
      <div class="app-item">
        <div class="app-data">87<span class="app-unit">bpm</span></div>
        <div class="app-label">Heart Rate</div>
        <div class="app-graphic">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 102.7 21.4"  xml:space="preserve">
            <path class="svg-data -heart" d="M101.3,18.1c-9.3,0-5-17.8-14-16.3c-6.3,1,5,18-11,18c-9.3,0-5-19.4-14-18c-6.3,1,5,18-11,18   c-9.3,0-5-19.4-14-18c-6.3,1,5,18-11,18c-9.3,0-5-19.4-14-18c-6.3,1,5,18-11,18"/>
          </svg>
        </div>
      </div>
    </section>
    <section class="app-activity">
      <header class="app-header">
        <h2>Moving activity</h2>
        <span class="app-tag -active">Today</span>
        <span class="app-tag">Avg</span>        
      </header>
      <div class="app-graph">
        <svg id="svg-graph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 382.3 141.8" xml:space="preserve">
          <path class="svg-activity-fill" d="M263.4,56.5c-17,7.7-22.7,48.7-45.3,48.7s-23-104.7-52-104.7c-20.7,0-32.3,33.3-39.3,41.7    c-7,8.3-10.3,7.7-25.7,13.7s-26.3,33-43.3,33S5.8,14.5,0.3,14.5v127.3h263.2V56.5z"/>
          <path class="svg-activity-line" d="M0.3,14.5c5.5,0,40.5,74.3,57.5,74.3s28-27,43.3-33s18.7-5.3,25.7-13.7c7-8.3,18.7-41.7,39.3-41.7    c29,0,29.3,104.7,52,104.7s28.3-41,45.3-48.7"/>
          <path class="svg-activity-avg" d="M0.3,98.5c0,0,32.5,21.5,46.5,21.5s28.7-19.5,54.3-19.5s40,25,60.7,25s25.3-48,47.7-48s32,14,45.7,20.7    c13.7,6.7,17.3,2.3,27,5.7c9.7,3.3,25.3,14.7,34.7,14.7c9.3,0,24-2.3,30.3-2.3c6.3,0,29.3,2.3,35.2,2.3"/>
          <line class="svg-activity-indicator" x1="263.4" y1="141.8" x2="263.4" y2="0.5"/>
        </svg>
      </div>
    </section>
  </div>
</form>
<aside class="meta">

<span class="app-subheading">
    Don't have an account?
</span>
  <p>
    <a href="UserRegistration.php" style="font-weight: bold; color: #6c7ae0; text-decoration: none;">New User Registration</a><br>
    <a href="ManufacturerRegistration.php" style="font-weight: bold; color: #6c7ae0; text-decoration: none;">Manufacturer Registration</a><br>
</p>
</aside>
<!-- partial -->
  
</body>
</html>
