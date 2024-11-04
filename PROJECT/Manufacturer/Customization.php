<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_GET['rid'])){
	$UpQry="update tbl_request set request_status='".$_GET['st']."', request_amount=".$_GET['amt']." where request_id=".$_GET['rid'];
	if($Con->query($UpQry)){
		?>
		<script>
		alert("Rejected");
		window.location="Customization.php"
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
if(isset($_GET['aid'])){
$UpQry="update tbl_request set request_status='".$_GET['st']."' where request_id=".$_GET['aid'];
if($Con->query($UpQry)){
	?>
	<script>
	alert("Accepted");
	window.location="Customization.php"
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
        /* Custom styles for the table */
        body {
            background-color: #f8f9fa; /* Light gray background for the body */
        }

        .table-container {
            margin: 20px auto;
            max-width: 900px; /* Set a max width for the table */
            background: white; /* White background for the table */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Rounded corners effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }

        table {
            border-collapse: collapse; /* Collapse table borders */
        }

        th, td {
            text-align: center; /* Center text in table cells */
            vertical-align: middle; /* Center align vertically */
        }

        th {
            background-color: #6c7ae0; /* Header background color */
            color: white; /* Header text color */
        }
		a{
            color: #6c7ae0;
        }

        img {
            width: 100px; /* Fixed width for images */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>

<div class="table-container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Date</th>
                <th>Material</th>
                <th>Color</th>
                <th>Category</th>
                <th>Message</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_request r 
                        INNER JOIN tbl_material m ON r.material_id = m.material_id 
                        INNER JOIN tbl_color c ON r.color_id = c.color_id 
                        INNER JOIN tbl_category ct ON r.category_id = ct.category_id 
                        WHERE r.manufacturer_id = " . $_SESSION['mid'];
            $result = $Con->query($selQry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['request_date']; ?></td>
                    <td><?php echo $row['material_name']; ?></td>
                    <td><?php echo $row['color_name']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['request_content']; ?></td>
                    <td><a href="../Assets/Files/User/CustomDesign/<?php echo $row['request_file']; ?>" target="_blank" rel="noopener noreferrer">File</a></td>
                    <td><?php
                        if ($row['request_status'] == 0) {
                            echo "NEW ORDER";
                        } else if ($row['request_status'] == 1) {
                            echo "Order Accepted. Waiting for Payment";
                        } else if ($row['request_status'] == 2) {
                            echo "Order Rejected.";
                        } else if ($row['request_status'] == 3) {
                            echo "Advance Payment Successful. Assign a Designer";
                        } else if ($row['request_status'] == 4) {
                            // Designer information query
                            $selDes = "SELECT * FROM tbl_assign a 
                                        INNER JOIN tbl_designer d ON d.designer_id = a.designer_id 
                                        WHERE request_id = " . $row['request_id'];
                            $resDes = $Con->query($selDes);
                            $datDes = $resDes->fetch_assoc();
                            echo "<br>Designer: " . $datDes['designer_name'];
                            if ($datDes['assign_status'] == 1) {
                                echo "Design Submitted";
                            } else if ($datDes['assign_status'] == 2) {
                                echo "Design Accepted by the Client";
                            } else if ($datDes['assign_status'] == 3) {
                                echo "Client requested for revising the design";
                            }
                        } else if ($row['request_status'] == 5) {
                            echo "Product Manufacturing Completed";
                        } else if ($row['request_status'] == 6) {
                            echo "Payment Complete";
                        } else if ($row['request_status'] == 7) {
                            echo "Product Delivered";
                        }
                        ?></td>
                    <td><?php
                        if ($row['request_status'] == 0) {
                            echo '<a href="#" onclick="acceptReq(\'' . $row['request_id'] . '\')">Accept</a><br>';
                            echo '<a href="Customization.php?rid=' . $row['request_id'] . '&st=2">Reject</a>';
                        }
                        if ($row['request_status'] == 3) {
                            echo '<a href="AssignDesigner.php?aid=' . $row['request_id'] . '">Assign Designer</a>';
                        } else if ($row['request_status'] == 4) {
                            $selDes = "SELECT * FROM tbl_assign a 
                                        INNER JOIN tbl_designer d ON d.designer_id = a.designer_id 
                                        WHERE request_id = " . $row['request_id'];
                            $resDes = $Con->query($selDes);
                            $datDes = $resDes->fetch_assoc();
                            if ($datDes['assign_status'] == 2) {
                                echo '<a href="Customization.php?aid=' . $row['request_id'] . '&st=5">Complete</a>';
                            }
                        } else if ($row['request_status'] == 6) {
                            echo '<a href="Customization.php?aid=' . $row['request_id'] . '&st=7">Deliver</a>';
                        }
                        ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</body>
<script>
function acceptReq(id){
	var amt = prompt("Enter Payable Charge")
	console.log(amt)
	window.location="Customization.php?aid=" + id + "&amt=" + amt + "&st=1"
	
}


</html>
<?php
include("Foot.php");
ob_flush();
?>