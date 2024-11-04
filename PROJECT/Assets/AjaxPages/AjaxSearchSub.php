<?php
include('../Connection/Connection.php');
$selCat = "SELECT * from tbl_subcategory where category_id IN(".$_GET["data"].")";
									$result = $Con->query($selCat);
									while ($row=$result->fetch_assoc()) {
								?>
								<li class="p-b-6 d-flex" style=" color: #aeaeae;gap: .5rem;">
											<input type="checkbox" onclick="productCheck()" class="form-check-input" value="<?php echo $row["subcat_id"]; ?>" id="subcategory"><?php echo $row["subcat_name"]; ?>
										
								</li>
								<?php
									}
?>