<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$des=$_POST['txt_des'];
	$price=$_POST['txt_price'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Product/Photo/'.$photo);
	$subcat=$_POST['sel_subcat'];
	$manufacturer=$_SESSION['mid'];
	$mat=$_POST['sel_mat'];
	$color=$_POST['sel_col'];
	
	$InsQry="insert into tbl_product(product_name,product_description,product_price,product_photo,subcategory_id,manufacturer_id,material_id,color_id) values('$name','$des','$price','$photo','$subcat','$manufacturer','$mat','$color')";
	if($Con->query($InsQry))
	{
		echo "Inserted";
	}
	else
	{
		echo "Error";	
	}
}

if(isset($_GET['did']))
{
	$DelQry="delete from tbl_product where product_id=".$_GET['did'];
	if($Con->query($DelQry))
	{
			?>
			<script>
			window.location="Product.php";
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
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .form-container {
            max-width: 800px; /* Limit form width */
            margin: auto; /* Center the container */
            padding: 20px; /* Padding around */
            background-color: #fff; /* White background for the form */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .table-container {
            margin: 20px auto;
            max-width: 900px; /* Set a max width for the table */
            background: white; /* White background for the table */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Rounded corners effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }
        .table {
            margin: 20px auto; /* Center table */
        }
        .table th{
            text-align: center; /* Center text in table */
            background-color: #6c7ae0; /* Your preferred shade for header */
        }
        .table td {
            text-align: center; /* Center text in table */
        }
        .btn-custom {
            background-color: #6c7ae0; /* Custom button color */
            color: white; /* Button text color */
        }
        .btn-custom:hover {
            background-color: #2956d5; /* Darker shade on hover */
        }
        .profile-links a {
            color: #6c7ae0; /* Link color */
            margin: 0 10px; /* Space between links */
        }
        .profile-links a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
<div class="form-container">
<h2 style="text-decoration:bold;color:#6c7ae0;text-align:center;">Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form-group">
            <label for="txt_name">Product Name</label>
            <input required type="text" class="form-control" name="txt_name" id="txt_name" />
        </div>
        <div class="form-group">
            <label for="txt_des">Product Description</label>
            <textarea required class="form-control" name="txt_des" id="txt_des" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="txt_price">Product Price</label>
            <input required type="text" class="form-control" name="txt_price" id="txt_price" />
        </div>
        <div class="form-group">
            <label for="file_photo">Product Photo</label>
            <input required type="file" class="form-control-file" name="file_photo" id="file_photo" />
        </div>
        <div class="form-group">
            <label for="sel_cat">Category</label>
            <select required class="form-control" name="sel_cat" id="sel_cat" onChange="getSubcat(this.value)">
                <option value="">--Select--</option>
                <?php
                $SelQry="select * from tbl_category";
                $row=$Con->query($SelQry);
                while($data=$row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sel_subcat">Subcategory</label>
            <select required class="form-control" name="sel_subcat" id="sel_subcat">
                <option>--Select--</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sel_mat">Material</label>
            <select required class="form-control" name="sel_mat" id="sel_mat">
                <option>--Select--</option>
                <?php
                $SelQry="select * from tbl_material";
                $row=$Con->query($SelQry);
                while($data=$row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['material_id']?>"><?php echo $data['material_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sel_col">Color</label>
            <select required class="form-control" name="sel_col" id="sel_col">
                <option>--Select--</option>
                <?php
                $SelQry="select * from tbl_color";
                $row=$Con->query($SelQry);
                while($data=$row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['color_id']?>"><?php echo $data['color_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-custom">Submit</button>
    </form>
</div>

<div class="container">
    <table class="table table-container">
        <thead class="th">
            <tr>
                <th>Sl No.</th>
                <th>Product Photo</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Manufacturer</th>
                <th>Material</th>
                <th>Color</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        $SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcat_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_manufacturer m on p.manufacturer_id=m.manufacturer_id inner join tbl_material mt on p.material_id=mt.material_id inner join tbl_color cl on p.color_id=cl.color_id where m.manufacturer_id=".$_SESSION['mid'];
        $result=$Con->query($SelQry);
        while($row=$result->fetch_assoc()) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo'];?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Product Photo" /></td>
                <td><?php echo $row['product_name'];?></td>
                <td><?php echo $row['product_description'];?></td>
                <td><?php echo $row['product_price'];?></td>
                <td><?php echo $row['category_name'];?></td>
                <td><?php echo $row['subcat_name'];?></td>
                <td><?php echo $row['manufacturer_name'];?></td>
                <td><?php echo $row['material_name'];?></td>
                <td><?php echo $row['color_name'];?></td>
                <td>
                    <a href="Product.php?did=<?php echo $row['product_id'];?>" class="btn btn-link" style="color: #6c7ae0;">Delete</a><br>
                    <a href="Stock.php?pid=<?php echo $row['product_id'];?>" class="btn btn-link" style="color: #6c7ae0;">Add Stock</a><br>
                    <a href="Gallery.php?pid=<?php echo $row['product_id'];?>" class="btn btn-link" style="color: #6c7ae0;">Add Pictures</a><br>
                    <a href="Rating.php?pid=<?php echo $row['product_id'];?>" class="btn btn-link" style="color: #6c7ae0;">View Rating</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubcat(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcat.php?did=" + did,
      success: function (result) {

        $("#sel_subcat").html(result);
      }
    });
  }

</script>

</html>
<?php
include("Foot.php");
ob_flush();
?>