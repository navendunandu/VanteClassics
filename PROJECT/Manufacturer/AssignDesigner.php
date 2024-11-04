<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit'])){
    $did=$_POST['sel_des'];
$rid=$_GET['aid'];
$insQry="insert into tbl_assign(request_id,assign_date,designer_id) values('$rid',curdate(),'$did')";
$updQry="update tbl_request set request_status='4' where request_id=".$rid;
if($Con->query($insQry) && $Con->query($updQry)){
?>
<script>
	alert("Assigned successfully");
    window.location="Customization.php"
	</script>
    <?php
	
}else{
	?>
	<script>
	alert("Something went wrong");
	</script>
    <?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!-- Bootstrap CSS -->
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

<style>
    /* Center the form */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Form card styling */
    .form-card {
        padding: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        max-width: 600px;
        width: 100%;
    }

    /* Submit button styling */
    .submit-btn {
        width: 100%;
           background-color: #6c7ae0; /* Your preferred color */
            color: white;
           
        }

        .submit-btn:hover {
            background-color: #5a6ab0; /* Darker shade on hover */
        }
    
</style>
</head>

<body>

<div class="container form-container">
    <div class="card form-card">
        <div class="card-body">
            <h4 class="text-center mb-4">Assign Designer</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="sel_des">Designer</label>
                    <select name="sel_des" id="sel_des" class="form-control" onchange="desAssign(this.value, '<?php echo $row['request_id']?>')">
                        <option>--Select--</option>
                        <?php
                        $SelDes = "SELECT * FROM tbl_designer WHERE manufacturer_id=" . $_SESSION['mid'];
                        $result = $Con->query($SelDes);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['designer_id'] ?>"><?php echo $data['designer_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="btn_submit" class="btn btn-primary submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
function desAssign(did,rid){
	console.log(did)
	console.log(rid)
	window.location="../Assets/AjaxPages/AjaxAssign.php?did=" + did + "&rid=" + rid
}
</script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>