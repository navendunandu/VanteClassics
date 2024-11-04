
<?php
include('../Connection/connection.php');
if (isset($_GET["action"])) {

   $sqlQry = "SELECT * from tbl_product p inner join tbl_subcategory s on s.subcat_id=p.subcategory_id INNER join tbl_material mt on mt.material_id=p.material_id INNER JOIN tbl_color c on c.color_id=p.color_id inner join tbl_category ct on ct.category_id=s.category_id where TRUE";
   
    if ($_GET["category"]!=null) {

        $category = $_GET["category"];

        $sqlQry = $sqlQry." AND ct.category_id IN(".$category.")";
    }
    if ($_GET["subcategory"]!=null) {

        $subcategory = $_GET["subcategory"];

        $sqlQry = $sqlQry." AND s.subcat_id IN(".$subcategory.")";
    }
    if ($_GET["color"]!=null) {

        $color = $_GET["color"];

        $sqlQry = $sqlQry." AND c.color_id IN(".$color.")";
    }
    if ($_GET["material"]!=null) {

        $material = $_GET["material"];

        $sqlQry = $sqlQry." AND mt.material_id IN(".$material.")";
    }
    if ($_GET["name"]!=null) {

        $name = $_GET["name"];

        $sqlQry = $sqlQry." AND product_name LIKE '%".$name."%'";
    }
    if ($_GET["min"]!=null) {

        $min = $_GET["min"];

        $sqlQry = $sqlQry." AND product_price>='".$min."'";
    }
    if ($_GET["max"]!=null) {

        $max = $_GET["max"];

        $sqlQry = $sqlQry." AND product_price<='".$max."'";
    }
    $resultS = $Con->query($sqlQry);
    $action=TRUE;
    if($_GET['action']=="FALSE"){
        $link="Guest/Login.php";
        $action=FALSE;
       
    }

    if ($resultS->num_rows > 0) {
        while ($data = $resultS->fetch_assoc()) {
            if($action){
                $link="ViewMore.php?pid=".$data['product_id'];
                $path="../Assets/Files/Product/Photo/".$data['product_photo'];
            }
            else{
                $path="Assets/Files/Product/Photo/".$data['product_photo'];

            }
            $query2 = "SELECT SUM(rating_value) as rating, COUNT(*) as count FROM tbl_rating WHERE product_id =".$data['product_id'];
$result3 = $Con->query($query2);

// Check if the query returned a resultS
    $rowS = $result3->fetch_assoc();
    $totalRating = $rowS['rating'];
    $ratingCount = $rowS['count'];

    // Avoid division by zero
    if ($ratingCount > 0) {
        $averageRating = $totalRating / $ratingCount;
    } else {
        $averageRating = 0;
    }
?>
<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?php echo $path ?>" alt="IMG-PRODUCT">

							<a href="<?php echo $link ?>"
								class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?php echo $link ?>"
									class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $data['product_name']; ?>
								</a>

								<span class="stext-105 cl3">
                                ₹<?php echo $data['product_price']; ?>
								</span>
							</div>
                            <div class='star-rating' style="
    color: #DEAD6F;font-size:30px;
">
		<?php
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $averageRating) {
		echo "<span>&#9733;</span>"; // Filled star
	} else {
		echo "<span>&#9734;</span>"; // Empty star
	}
}
		?>
		</div>
                            <?php if($action){?>
							<div class="flex-r p-t-3">
                                <?php
                                    $stock = "select sum(stock_qty) as stock from tbl_stock where product_id = '".$data["product_id"]."'";
                                    $result2 = $Con->query($stock);
                                    $row2=$result2->fetch_assoc();
                                    
                                    $stocka = "select sum(cart_qty) as stock from tbl_cart where product_id = '".$data["product_id"]."'";
                                    $result2a = $Con->query($stocka);
                                    $row2a=$result2a->fetch_assoc();
                                    
                                    $stock = $row2["stock"] - $row2a["stock"];
                                    if($stock>0){
                                    ?>
								<a href="#" onclick="addCart(<?php echo $data['product_id'] ?>)" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <i class="zmdi zmdi-shopping-cart"></i>
								</a>
                                <?php
                                }
                                else{
                                    echo "<p class='text-danger'>Out of stock</p>";
                                }
                                ?>
							</div>
                            <?php } ?>
						</div>
					</div>
				</div>


<?php
}
    }
    else{
        ?>
        <h3 align='center'>No Data Found</h3>
        <?php
    }}
?>
