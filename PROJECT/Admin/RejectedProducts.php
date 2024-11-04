<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_GET['aid']))
	{
		$UpQry="update tbl_product set product_vstatus=1 where product_vstatus=2 and product_id=".$_GET['aid'];
		if($Con->query($UpQry))
	{
		echo "Updated";
	}
	else
	{
		echo "Error";
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                         <th>Sl No.</th>
                                         <th>Product Photo</th>
                                         <th>Product Name</th>
                                         <th>Product Description</th>
                                         <th>Product Price</th>
                                         <th>Category</th>
                                         <th>Subcategory</th>
                                         <th>Material</th>
                                         <th>Color</th>
                                         <th>Manufacturer</th>
                                         <th>Action</th>
                                        </tr>
</thead>
    <?php
    $i = 0;
    $SelQry = "SELECT * FROM tbl_product p 
                INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcat_id 
                INNER JOIN tbl_category c ON s.category_id = c.category_id 
                INNER JOIN tbl_manufacturer m ON p.manufacturer_id = m.manufacturer_id 
                INNER JOIN tbl_material mt ON p.material_id = mt.material_id 
                INNER JOIN tbl_color cl ON p.color_id = cl.color_id 
                WHERE p.product_vstatus = 2";
    $result = $Con->query($SelQry);
    while ($row = $result->fetch_assoc()) {
      $i++;
    ?>
                                               <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><img src="../Assets/Files/Product/Photo/<?php echo $row['product_photo'];?>" width="100" height="100" /></td>
                                                <td><?php echo htmlspecialchars($row['product_name']);?></td>
                                                <td><?php echo htmlspecialchars($row['product_description']);?></td>
                                                <td><?php echo htmlspecialchars($row['product_price']);?></td>
                                                <td><?php echo htmlspecialchars($row['category_name']);?></td>
                                                <td><?php echo htmlspecialchars($row['subcat_name']);?></td>
                                                <td><?php echo htmlspecialchars($row['material_name']);?></td>
                                                <td><?php echo htmlspecialchars($row['color_name']);?></td>
                                                <td><?php echo htmlspecialchars($row['manufacturer_name']);?></td>
                                                <td>
                                                <a href="NewProducts.php?aid=<?php echo $row['product_id']; ?>" class="btn btn-custom-accept btn-sm">Accept</a>
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
<?php
            include("Foot.php");
            ob_flush();
            ?>