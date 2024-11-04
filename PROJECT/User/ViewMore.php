<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$id=$_GET['pid'];
$selQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcat_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_manufacturer m on p.manufacturer_id=m.manufacturer_id inner join tbl_material mt on p.material_id=mt.material_id inner join tbl_color cl on p.color_id=cl.color_id where p.product_id='$id'";
  $result=$Con->query($selQry);
  $row=$result->fetch_assoc();
 ?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            /* padding: 20px; */
        }
        .product-details {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }
        .gallery {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .thumbnail {
            cursor: pointer;
            border-radius: 8px;
            margin: 5px;
            transition: transform 0.2s;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .enlarged-image {
            border-radius: 8px;
            width: 100%; /* Ensures responsiveness */
        }
        .image-row {
            display: flex;
            justify-content: flex-start; /* Align images to the left */
            flex-wrap: wrap; /* Allows wrapping to the next line */
        }
        .image-row img {
            width: 80px; /* Fixed size for thumbnails */
            height: 80px; /* Fixed size for thumbnails */
            margin: 5px; /* Space between images */
        }
    </style>
    <title>Product Details</title>
      </head>

      <body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="gallery">
                    <img id="mainImage" src="../Assets/Files/Product/Photo/<?php echo $row['product_photo']?>" 
                         alt="Main Product Image" 
                         class="img-fluid enlarged-image" />
                    <div class="image-row">
                        <?php
                        $SelGal = "select * from tbl_gallery where product_id='$id'";
                        $Gresult = $Con->query($SelGal);
                        while ($pic = $Gresult->fetch_assoc()) {
                        ?>
                            <img src="../Assets/Files/Gallery/<?php echo $pic['gallery_image']?>" 
                                 alt="Gallery Image" 
                                 class="thumbnail" 
                                 onclick="changeImage(this.src)" />
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="product-details">
                    <table class="table">
                        <tr>
                            <td><strong>Product Name</strong></td>
                            <td><?php echo $row['product_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Product Description</strong></td>
                            <td><?php echo $row['product_description']?></td>
                        </tr>
                        <tr>
                            <td><strong>Price</strong></td>
                            <td><?php echo $row['product_price']?></td>
                        </tr>
                        <tr>
                            <td><strong>Subcategory</strong></td>
                            <td><?php echo $row['subcat_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Category</strong></td>
                            <td><?php echo $row['category_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Material</strong></td>
                            <td><?php echo $row['material_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Color</strong></td>
                            <td><?php echo $row['color_name']?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
include("Foot.php");
ob_flush();
?>