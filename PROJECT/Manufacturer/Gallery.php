<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$id=$_GET['pid'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Gallery/'.$photo);
	$InsQry="insert into tbl_gallery(gallery_image,product_id) values('$photo','$id')";
	if($Con->query($InsQry))
		{
			?>
			<script>
			alert("Picture successfully added");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("ErrSomething went wrongor");
			</script>
            <?php
		}
}

if(isset($_GET['did']))
{
	$DelQry="delete from tbl_gallery where gallery_id=".$_GET['did'];
	if($Con->query($DelQry))
	{
			?>
			<script>
			window.location="Gallery.php";
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
body {
  background-color: #f8f9fa; /* Light background for contrast */
}

.card-header {
  background-color: #6c7ae0; /* Card header color */
  color: white; /* White text on header */
}

.table th {
  background-color: #6c7ae0; /* Table header color */
  color: white; /* White text on table header */
}

.btn-primary {
  background-color: #6c7ae0; /* Button color */
  border-color: #6c7ae0; /* Button border color */
}

.btn-primary:hover {
  background-color: #5b6bb3; /* Darker shade on hover */
  border-color: #5b6bb3; /* Match border color on hover */
}

.btn-danger {
  background-color: #b33a45; /* Delete button color */
  border-color: #b33a45; /* Delete button border color */
}

.btn-danger:hover {
  background-color: #a52e3d; /* Darker shade on hover */
  border-color: #a52e3d; /* Match border color on hover */
}
</style>
</head>

<body>
  <div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Upload Gallery Image</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="file_photo">Gallery Image</label>
            <input required type="file" name="file_photo" id="file_photo" class="form-control-file" />
          </div>
          <div class="text-center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
          </div>
        </div>
      </div>
    </form>

    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Gallery</h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sl No.</th>
              <th>Product Name</th>
              <th>Gallery Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 0;
              $SelQry = "SELECT * FROM tbl_gallery g INNER JOIN tbl_product p ON g.product_id = p.product_id";
              $result = $Con->query($SelQry);
              while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><img src="../Assets/Files/Gallery/<?php echo $row['gallery_image']; ?>" width="200" height="200" alt="Gallery Image" /></td>
              <td><a href="Gallery.php?did=<?php echo $row['gallery_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>