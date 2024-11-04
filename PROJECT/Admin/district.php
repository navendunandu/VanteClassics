<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$dis = $_POST["txt_dist"];
	$id=$_POST['txt_id'];
	$selDis="select * from tbl_district where district_name='".$dis."'";
	$resDis=$Con->query($selDis);
	if($resDis->num_rows>0){
		?>
			  <script>
		    alert("District Already Exists");
		  </script>
		  <?php	
	}
	else{

	if($id!='')
	{
		$UpQry="update tbl_district set district_name='$dis' where district_id='$id'";
		if($Con->query($UpQry))
		{
			echo "Updated";	
		}
		else
		{
			echo "Error";
		}
	}else
	{
	$insQry = "insert into tbl_district(district_name) values('".$dis."')";
	if($Con->query($insQry))
	{
		echo "Inserted";	
	}
	else
	{
		echo "Error";	
	}
	}
	}
}


if(isset($_GET["did"]))
{
	$delQry = "delete from tbl_district where district_id=".$_GET["did"];
	if($Con->query($delQry))
	{
		?>
		<script>
        window.location = "district.php";
        </script>
		<?php
	}
}
$did='';
$dname='';

if(isset($_GET["eid"]))
{
	$SelQry="select * from tbl_district where district_id=".$_GET['eid'];
	$row=$Con->query($SelQry);
	$data=$row->fetch_assoc();
	$did=$data['district_id'];
	$dname=$data['district_name'];	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Districts</h4>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="form-group">
                                <label for="txt_dist">District Name</label>
                                <input type="text" required name="txt_dist" id="txt_dist" class="form-control" value="<?php echo htmlspecialchars($dname); ?>" />
                                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($did); ?>" />
                            </div>
                            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                            <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">Clear</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">District List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>District</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                $selQry = "SELECT * FROM tbl_district";
                                $result = $Con->query($selQry);
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($row["district_name"]); ?></td>
                                        <td class="action-links">
                                            <a href="district.php?did=<?php echo $row["district_id"]; ?>" class="btn btn-neutral btn-sm">Delete</a>
                                            <a href="district.php?eid=<?php echo $row["district_id"]; ?>" class="btn btn-neutral btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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