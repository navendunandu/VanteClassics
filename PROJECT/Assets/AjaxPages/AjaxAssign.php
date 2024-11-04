<?php
include("../Connection/Connection.php");
$did=$_GET['did'];
$rid=$_GET['rid'];
$insQry="insert into tbl_assign(request_id,assign_date,designer_id,assign_status) values('$rid',curdate(),'$did','1')";
if($Con->query($insQry)){
?>
<script>
	alert("Assigned");
	</script>
    <?php
	
}else{
	?>
	<script>
	alert("Error");
	</script>
    <?php
}

?>