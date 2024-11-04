<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$col=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	if(isset($_POST['btn_submit']))
	{
		$selCol="select * from tbl_color where color_name='".$col."'";
	$rescol=$Con->query($selCol);
	if($resCol->num_rows>0){
		?>
			  <script>
		    alert("Color Already Exists");
		  </script>
		  <?php	
	}
	else{
		if($id!='')
		{
			$UpQry="update tbl_color set color_name='$col' where color_id='$id'";
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
		$InsQry="insert into tbl_color(color_name) values('$col')";
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
	}
	}
}


if(isset($_GET['cid']))
{
	$DelQry="delete from tbl_color where color_id=".$_GET['cid'];
	if($Con->query($DelQry))
	{
			?>
			<script>
			window.location="Color.php";
			</script>
           <?php
	}
}
$cid='';
$cname='';
if(isset($_GET['eid']))
{
	$SelQry="select * from tbl_color where color_id=".$_GET['eid'];
	$result=$Con->query($SelQry);
	$row=$result->fetch_assoc();
	$cname=$row['color_name'];
	$cid=$row['color_id'];
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
                        <h4 class="card-title">Manage Colors</h4>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="form-group">
                                <label for="txt_name">Color Name</label>
                                <input type="text" required name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($cname); ?>" />
                                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($cid); ?>" />
                            </div>
                            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Color List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Color Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SelQry = "SELECT * FROM tbl_color";
                                $result = $Con->query($SelQry);
                                $i = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($row['color_name']); ?></td>
                                        <td class="action-links">
                                            <a href="Color.php?cid=<?php echo $row['color_id']; ?>"  class="btn btn-neutral btn-sm">Delete</a>
                                            <a href="Color.php?eid=<?php echo $row['color_id']; ?>"  class="btn btn-neutral btn-sm">Edit</a>
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