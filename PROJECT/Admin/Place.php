<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$pname=$_POST['txt_place'];
	$did=$_POST['sel_dis'];
	$selPlace="select * from tbl_place where place_name='".$pname."'";
	$resPlace=$Con->query($selPlace);
	if($resPlace->num_rows>0){
		?>
			  <script>
		    alert("Place Already Exists");
		  </script>
		  <?php	
	}
	else{
	$InsQry="insert into tbl_place(place_name,district_id) values('$pname','$did')";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
  .btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
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
                            <h4 class="card-title">Add Place</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="">
                                <div class="form-group">
                                    <label for="sel_dis">Select District</label>
                                    <select name="sel_dis" required id="sel_dis" class="form-control">
                                        <option>--Select--</option>
                                        <?php
                                        $SelQry="select * from tbl_district";
                                        $row=$Con->query($SelQry);
                                        while($data=$row->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo htmlspecialchars($data['district_id']); ?>"><?php echo htmlspecialchars($data['district_name']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="txt_place">Place Name</label>
                                    <input required type="text" name="txt_place" id="txt_place" class="form-control" />
                                </div>

                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                                <button type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Place List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>District Name</th>
                                            <th>Place Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $SelQry = "SELECT tbl_place.*, tbl_district.district_name FROM tbl_place 
                                                   INNER JOIN tbl_district ON tbl_place.district_id = tbl_district.district_id";
                                        $result = $Con->query($SelQry);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['place_name']); ?></td>
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