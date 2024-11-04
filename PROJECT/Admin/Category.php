<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$cat = $_POST["txt_cat"];
	$id = $_POST['txt_id'];
	$selCat="select * from tbl_category where category_name='".$cat."'";
	$resCat=$Con->query($selCat);
	if($resCat->num_rows>0){
		?>
			  <script>
		    alert("Category Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$UpQry="update tbl_category set category_name='$cat' where category_id='$id'";
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
	$insQry = "insert into tbl_category(category_name) values('".$cat."')";
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
if(isset($_GET['cid']))
{
	$delQry="delete from tbl_category where category_id=".$_GET['cid'];
	if($Con->query($delQry))
	{
		?>
        <script>
		window.location="Category.php";
		</script>
        <?php
	}
}

$cid='';
$cname='';
if(isset($_GET['eid']))
{
	$SelQry="select * from tbl_category";
	$row=$Con->query($SelQry);
	$data=$row->fetch_assoc();
	$cid=$data['category_id'];
	$cname=$data['category_name'];	
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
                            <h4 class="card-title">Manage Categories</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="">
                                <div class="form-group">
                                    <label for="txt_cat">Category Name</label>
                                    <input required type="text" name="txt_cat" id="txt_cat" class="form-control" value="<?php echo htmlspecialchars($cname); ?>" />
                                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($cid); ?>" />
                                </div>
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                                <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=0;
                                        $selQry = "SELECT * FROM tbl_category";
                                        $result = $Con->query($selQry);
                                        while($row = $result->fetch_assoc()) {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                            <td class="action-links">
                                                <a href="Category.php?cid=<?php echo $row['category_id']; ?>" class="btn btn-neutral btn-sm">Delete</a>
                                                <a href="Category.php?eid=<?php echo $row['category_id']; ?>" class="btn btn-neutral btn-sm">Edit</a>
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