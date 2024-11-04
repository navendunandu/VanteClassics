<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa;
        }
        .search-form {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #fff;
        }
        .form-row {
            margin-bottom: 15px;
        }
        .form-control {
            width: auto;
        }
        .form-control:focus {
            width: auto;
            border: 1px solid #6c7ae0;
        }
        .btn-search {
            background-color: #6c7ae0;
            color: #ffff;
        }
        
    </style>
</head>

<body onload="productCheck()">
<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Product Overview
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">

				<div class="flex-w flex-c-m m-tb-10">
					<div
						class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
							id="txt_name" onkeyup="productCheck()" placeholder="Search">
					</div>
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Category
							</div>
							<ul>
								<?php                           
								 $selCat = "SELECT * from tbl_category";
									$result = $Con->query($selCat);
									while ($row=$result->fetch_assoc()) {
								?>
								<li class="p-b-6 d-flex" style=" color: #aeaeae;gap: .5rem;">
									<input type="checkbox" onclick="changeSub(),productCheck()" class="form-check-input"
										value="<?php echo $row["category_id"]; ?>" id="category">
									<?php echo $row["category_name"]; ?>

								</li>
								<?php
									}
								?>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sub-Category
							</div>

							<ul id="subcat">

							</ul>
						</div>

						<div class="filter-col3 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Color
							</div>

							<ul>
								<?php                           
								 $selColr = "SELECT * from tbl_color";
								 
									$resultClr = $Con->query($selColr);
									while ($rowClr=$resultClr->fetch_assoc()) {
								?>
								<li class="p-b-6 d-flex" style=" color: #aeaeae;gap: .5rem;">
									<input type="checkbox" onclick="productCheck()" class="form-check-input"
										value="<?php echo $rowClr["color_id"]; ?>" id="color">
									<?php echo $rowClr["color_name"]; ?>

								</li>
								<?php
									}
								?>
							</ul>
						</div>

						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Materials
							</div>

							<ul>
								<?php                           
								 $selMat = "SELECT * from tbl_material";
									$resultMat = $Con->query($selMat);
									while ($rowMat=$resultMat->fetch_assoc()) {
								?>
								<li class="p-b-6 d-flex" style=" color: #aeaeae;gap: .5rem;">
									<input type="checkbox" onclick="productCheck()" class="form-check-input"
										value="<?php echo $rowMat["material_id"]; ?>" id="material">
									<?php echo $rowMat["material_name"]; ?>

								</li>
								<?php
									}
								?>
							</ul>
						</div>

                        <div class="filter-col5 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Price
							</div>

							<ul>
                                <label for="txt_min">Minimum</label>
								<input class="form-control" type="number" name="txt_min" id="txt_min" onkeyup="productCheck()">
                                <br>
                                <label for="txt_max">Maximum</label>
								<input class="form-control" type="number" name="txt_max" id="txt_max" onkeyup="productCheck()">
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row isotope-grid" id="result">
				<!-- Search Result Goes Here -->
			</div>

		</div>
	</section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
        function changeSub() {
			var cat = get_filter_text('category');
			if (cat.length !== 0) {
				$.ajax({
					url: "../Assets/AjaxPages/AjaxSearchSub.php?data=" + cat,
					success: function (response) {
						$("#subcat").html(response);
					}
				});

			}
			else {
				$("#subcat").html("");
			}


			function get_filter_text(text_id) {
				var filterData = [];

				$('#' + text_id + ':checked').each(function () {
					filterData.push("\'" + $(this).val() + "\'");
				});
				return filterData;
			}
		}

		function productCheck() {
			// $("#loder").show();

			var action = 'data';
			var category = get_filter_text('category');
			var subcategory = get_filter_text('subcategory');
			var color = get_filter_text('color');
			var material = get_filter_text('material');
			var name = document.getElementById('txt_name').value;
			var max = document.getElementById('txt_max').value;
			var min = document.getElementById('txt_min').value;

			$.ajax({
				url: "../Assets/AjaxPages/AjaxSearch.php?action=" + action + "&category=" + category + "&color=" + color + "&material=" + material + "&subcategory=" + subcategory + "&min=" + min+ "&max=" + max+ "&name=" + name,
				success: function (response) {
					$("#result").html(response);
					// $("#loder").hide();
					// $("#textChange").text("Filtered Products");
				}
			});


		}



		function get_filter_text(text_id) {
			var filterData = [];

			$('#' + text_id + ':checked').each(function () {
				filterData.push($(this).val());
			});
			return filterData;
		}
        function addCart(pid){
            $.ajax({
                url: '../Assets/AjaxPages/AjaxAddCart.php?pid=' + pid,
                success: function(response) {
                    alert(response);
                }
            });
        }
</script>
</html>
<?php
include("Foot.php");
ob_flush();
?>