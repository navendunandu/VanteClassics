<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_add']))
{
	$sub=$_POST['txt_subcat'];
	$id=$_POST['txt_subid'];
	$catid=$_POST['sel_cat'];
	$selSubcat="select * from tbl_subcategory where subcat_name='".$sub."'";
	$resSubat=$Con->query($selSubat);
	if($resSubat->num_rows>0){
		?>
			  <script>
		    alert("Subcategory Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$UpQry="update tbl_subcategory set subcat_name='$sub' where subcat_id='$id'";
		if($Con->query($UpQry))
		{
			echo "Updated";
		}
		else
		{
			echo "Error";
		}
	}
	else
	{
	$InsQry="insert into tbl_subcategory(subcat_name,category_id) values('$sub','$catid')";
	if($Con->query($InsQry))
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

if(isset($_GET['sid']))
{
	$DelQry="delete from tbl_subcategory where subcat_id=".$_GET['sid'];
	if($Con->query($DelQry))
	{
	?>
    <script>
	window.location="Subcategory.php";
	</script>
    <?php	
	}
}
$sname='';
$sid='';
if(isset($_GET['eid']))
{
 $SelQry="select * from tbl_subcategory where subcat_id=".$_GET['eid'];
 $result=$Con->query($SelQry);
 $row=$result->fetch_assoc();
 $sname=$row['subcat_name'];
 $sid=$row['subcat_id'];	
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
                <!-- Form Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Subcategory</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="Subcategory.php">
                                <div class="form-group">
                                    <label for="sel_cat">Select Category</label>
                                    <select required name="sel_cat" id="sel_cat" class="form-control">
                                        <option>--Select--</option>
                                        <?php 
                                        $SelQry = "SELECT * FROM tbl_category";
                                        $result = $Con->query($SelQry);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo htmlspecialchars($row['category_id']); ?>"><?php echo htmlspecialchars($row['category_name']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="txt_subcat">Subcategory Name</label>
                                    <input type="text" required name="txt_subcat" id="txt_subcat" class="form-control" value="<?php echo htmlspecialchars($sname); ?>" />
                                    <input type="hidden" name="txt_subid" id="txt_subid" value="<?php echo htmlspecialchars($sid); ?>" />
                                </div>

                                <button type="submit" name="btn_add" id="btn_add" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Subcategory List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $SelQry = "SELECT tbl_subcategory.*, tbl_category.category_name FROM tbl_subcategory 
                                                   INNER JOIN tbl_category ON tbl_subcategory.category_id = tbl_category.category_id";
                                        $result = $Con->query($SelQry);
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['subcat_name']); ?></td>
                                            <td>
                                                <a href="Subcategory.php?sid=<?php echo $row['subcat_id']; ?>" class="btn btn-neutral btn-sm">Delete</a>
                                                <a href="Subcategory.php?eid=<?php echo $row['subcat_id']; ?>" class="btn btn-neutral btn-sm">Edit</a>
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