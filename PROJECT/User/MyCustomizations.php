<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_GET['cid'])){
$UpQry="update tbl_request set request_status=4 where request_id=".$_GET['cid'];

if($Con->query($UpQry)){}
else{
  ?>
    <script>
		alert("Error");
	</script>
    <?php
}
}

if(isset($_GET['aid'])){
  $UpQry="update tbl_assign set assign_status='".$_GET['st']."' where assign_id=".$_GET['aid'];
  if($Con->query($UpQry)){
    ?>
    <script>
    alert("Accepted");
    window.location="MyCustomizations.php";
    </script>
      <?php
  }else{
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
        /* General form container styling */
        .request-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            min-height: 80vh;
        }
        th {
            background-color: #6c7ae0; /* Header background color */
            color: white; /* Header text color */
        }
        /* Card styling */
        .card {
            width: 100%;
            max-width: 1000px; /* Limits the table width */
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }

        /* Table styling */
        .table-responsive {
            margin-top: 20px;
        }

        .table img {
            width: 100px;
            height: auto;
        }

        /* Heading styling */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        a{
            color: #6c7ae0;
        }

        /* Custom styling for specific status text */
        .status {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container request-container">
    <div class="card">
        <h2>My Custom Requests</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl No.</th>
                            <th>Date</th>
                            <th>Material</th>
                            <th>Colour</th>
                            <th>Category</th>
                            <th>Message</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>More</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "select * from tbl_request r inner join tbl_material m on r.material_id=m.material_id inner join tbl_color c on r.color_id=c.color_id inner join tbl_category ct on r.category_id=ct.category_id  where r.user_id=" . $_SESSION['uid'];
                        $result = $Con->query($selQry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['request_date'] ?></td>
                                <td><?php echo $row['material_name'] ?></td>
                                <td><?php echo $row['color_name'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['request_content'] ?></td>
                                <td>₹<?php echo $row['request_amount'] ?></td>
                                <td>
                                    <a href="../Assets/Files/User/CustomDesign/<?php echo $row['request_file'] ?>" target="_blank" rel="noopener noreferrer">View File</a>
                                </td>
                                <td class="status">
                                    <?php
                                    if ($row['request_status'] == 0) {
                                        echo "Request Sent";
                                    } else if ($row['request_status'] == 1) {
                                        echo "Order Accepted.<br>";
                                        $amt = $row['request_amount'] / 2;
                                    ?>
                                        <a href="Payment.php?rid=<?php echo $row['request_id'] ?>&amt=<?php echo $row['request_amount'] / 2 ?>&st=3">Click to Pay Now</a>
                                    <?php
                                    } else if ($row['request_status'] == 2) {
                                        echo "Order Rejected.";
                                    } else if ($row['request_status'] == 3) {
                                        echo "Advance Payment Successful.";
                                    } else if ($row['request_status'] == 4) {
                                        $selDes = "SELECT * from tbl_assign a inner join tbl_designer d on d.designer_id=a.designer_id where request_id=" . $row['request_id'];
                                        $resDes = $Con->query($selDes);
                                        $datDes = $resDes->fetch_assoc();
                                        echo "<br>Designer: " . $datDes['designer_name'];
                                        if ($datDes['assign_status'] == 1) {
                                            echo " <br>Design Submitted<br>";
                                    ?>
                                            <a href="../Assets/Files/Designer/Custom/<?php echo $datDes['assign_image'] ?>" target="_blank" rel="noopener noreferrer">View Design</a><br>
                                            <a href="MyCustomizations.php?aid=<?php echo $datDes['assign_id'] ?>&st=2">Accept</a><br>
                                            <a href="#" onClick="rejDes(<?php echo $datDes['assign_id'] ?>)">Reject</a>
                                    <?php
                                        } else if ($datDes['assign_status'] == 2) {
                                            echo "<br>Design Accepted";
                                        } else if ($datDes['assign_status'] == 3) {
                                            echo "<br>Requested for revising the design";
                                        }
                                    } else if ($row['request_status'] == 5) {
                                        echo "Product Manufacturing Completed<br>";
                                    ?>
                                        <a href="Payment.php?rid=<?php echo $row['request_id'] ?>&amt=<?php echo $row['request_amount'] / 2 ?>&st=6">Click to Pay Remaining: ₹<?php echo $row['request_amount'] / 2 ?></a>
                                    <?php
                                    } else if ($row['request_status'] == 6) {
                                        echo "Payment Completed";
                                    } else if ($row['request_status'] == 7) {
                                        echo "Product Delivered";
                                    }
                                    ?>
                                </td>
                                
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<script>
  function rejDes(id){
	var amt = prompt("Reason and What to Improve")
	console.log(amt)
	window.location="MyCustomization.php?aid=" + id + "&st=2"
	
}
</script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>