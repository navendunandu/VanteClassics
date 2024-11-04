<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$mat=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	if(isset($_POST['btn_submit']))
	$selMat="select * from tbl_material where material_name='".$mat."'";
	$resMat=$Con->query($selMat);
	if($resMat->num_rows>0){
		?>
			  <script>
		    alert("Material Already Exists");
		  </script>
		  <?php	
	}
	else{
	{
		if($id!='')
		{
			$UpQry="update tbl_material set material_name='$mat' where material_id='$id'";
			if($Con->query($UpQry))
			{
				?>
			<script>
			alert("Updated");
			</script>
            <?php
			}
			else
			{
				?>
            <script>
			alert("Error");
			</script>
            <?php
			}
		}
		else
		{
		$InsQry="insert into tbl_material(material_name) values('$mat')";
		if($Con->query($InsQry))
		{
			?>
			<script>
			alert("Inserted");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Error");
			</script>
            <?php
		}
		}
	}}
}


if(isset($_GET['mid']))
{
	$DelQry="delete from tbl_material where material_id=".$_GET['mid'];
	if($Con->query($DelQry))
	{
			?>
			<script>
			window.location="Material.php";
			</script>
           <?php
	}
}
$mid='';
$mname='';
if(isset($_GET['eid']))
{
	$SelQry="select * from tbl_material where material_id=".$_GET['eid'];
	$result=$Con->query($SelQry);
	$row=$result->fetch_assoc();
	$mname=$row['material_name'];
	$mid=$row['material_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
	.btn-neutral {
    background-color: #f4f4f4;
    color: #333;
    border: 1px solid #ddd;
}

.btn-neutral:hover {
    background-color: #e2e2e2;
    color: #333;
}
</style>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Form Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Materials</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="">
                                <div class="form-group">
                                    <label for="txt_name">Material Name</label>
                                    <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($mname); ?>" />
                                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($mid); ?>" />
                                </div>
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Material List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Material Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $SelQry = "SELECT * FROM tbl_material";
                                        $result = $Con->query($SelQry);
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['material_name']); ?></td>
                                            <td class="action-links">
                                                <a href="Material.php?mid=<?php echo $row['material_id']; ?>" class="btn btn-neutral btn-sm">Delete</a>
                                                <a href="Material.php?eid=<?php echo $row['material_id']; ?>" class="btn btn-neutral btn-sm">Edit</a>
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