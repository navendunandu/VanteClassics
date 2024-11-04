<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
$SelQry="select * from tbl_manufacturer";
$Result=$Con->query($SelQry);
$row=$Result->fetch_assoc();

	if(isset($_GET['aid']))
	{
		$UpQry="update tbl_manufacturer set manufacturer_vstatus=1 where manufacturer_vstatus=0 and manufacturer_id=".$_GET['aid'];
		if($Con->query($UpQry))
	{
	?>
<script>
    alert("Manufacturer Accepted")
    window.location="MailMessage.php?aid=<?php echo $_GET['aid']?>"
</script>
<?php
	}
	else
	{
		?>
<script>
    alert("Something went wrong")
</script>
<?php
	}
	}
	
	if(isset($_GET['rid']))
	{
		$UpQry="update tbl_manufacturer set manufacturer_vstatus=2 where manufacturer_vstatus=0 and manufacturer_id=".$_GET['rid'];
		if($Con->query($UpQry))
	{
		?>
<script>
    alert("Manufacturer Rejected")
    window.location="MailMessage.php?rid=<?php echo $_GET['rid']?>"
</script>
<?php
	}
	else
	{
        ?>
        <script>
            alert("Something went wrong")
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
  .btn-custom-accept {
    background-color: #28a745; 
    color: #28a745;
}

.btn-custom-reject {
    background-color: #dc3545; 
    color: #dc3545;
}
</style>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manufacturer List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Place</th>
                                            <th>District</th>
                                            <th>Logo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $SelQry = "SELECT * FROM tbl_manufacturer m
                                                       INNER JOIN tbl_place p ON m.place_id=p.place_id
                                                       INNER JOIN tbl_district d ON p.district_id=d.district_id
                                                       WHERE manufacturer_vstatus=0";
                                            $result = $Con->query($SelQry);
                                            $i = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['manufacturer_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['manufacturer_email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['manufacturer_contact']); ?></td>
                                            <td><?php echo htmlspecialchars($row['manufacturer_address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                                            <td>
                                                <img src="../Assets/Files/Manufacturer/Logo/<?php echo $row['manufacturer_logo']; ?>"
                                                     alt="Manufacturer Logo" class="img-fluid" style="max-width: 100px;"/>
                                            </td>
                                            <td class="action-links">
                                                <a href="ManufacturerList.php?aid=<?php echo $row['manufacturer_id']; ?>" class="btn btn-custom-accept btn-sm">Accept</a>
                                                <a href="ManufacturerList.php?rid=<?php echo $row['manufacturer_id']; ?>" class="btn btn-custom-reject btn-sm">Reject</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>