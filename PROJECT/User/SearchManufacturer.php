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
            border: 1px solid #6c7ae0;
        }
        .btn-search {
            background-color: #6c7ae0;
            color: #6c7ae0;
        }


    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .search-form {
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-row {
            margin-bottom: 15px;
        }

        .form-control {
            width: auto;
        }

        .form-control:focus {
            border-color: #6c7ae0;
            box-shadow: none;
        }

        .btn-search {
            background-color: #6c7ae0;
            color: #fff;
            border: none;
        }

        .btn-search:hover {
            background-color: #5a67d8;
        }

        .btn-search:focus {
            outline: none;
            box-shadow: none;
        }

        label {
            font-weight: 600;
        }

        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #f1f3f5;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }
    </style>
</head>

<body onload="getManufacturer()">

    <div class="container">
        <form id="form1" name="form1" method="post" action="" class="search-form">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="txt_mname">Search</label>
                    <input type="text" class="form-control" name="txt_mname" id="txt_mname" onchange="getManufacturer()" />
                </div>

                <div class="col-auto">
                    <label for="sel_dis">District</label>
                    <select class="form-control" name="sel_dis" id="sel_dis" onchange="getPlace(this.value),getManufacturer()">
                        <option value="">--Select--</option>
                        <?php
                        $SelQry = "select * from tbl_district";
                        $row = $Con->query($SelQry);
                        while ($data = $row->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="col-auto">
                    <label for="sel_place">Place</label>
                    <select class="form-control" name="sel_place" id="sel_place" onchange="getManufacturer()">
                        <option value="">--Select--</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-search" onclick="getManufacturer()" style="margin-top: 30px;">Search</button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-center align-items-center" id="result"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

  function getManufacturer() {
	  var txt = document.getElementById('txt_mname').value.trim();
	  var dis = document.getElementById('sel_dis').value.trim();
	  var place = document.getElementById('sel_place').value.trim();
	  
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSearchMan.php?txt="+txt+"&dis="+dis+"&place="+place,
      success: function (result) {

        $("#result").html(result);
      }
    });
  }
  </script>
</html>
<?php
include("Foot.php");
ob_flush();
?>