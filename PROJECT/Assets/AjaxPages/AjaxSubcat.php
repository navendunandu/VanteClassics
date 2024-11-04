<option value="">Select Subcategory</option>
<?php
include('../Connection/Connection.php');
$selQry="select * from tbl_subcategory where category_id=".$_GET['did'];
$result=$Con->query($selQry);
while($data=$result->fetch_assoc())
		{
		
        ?>
        <option value="<?php echo $data['subcat_id']?>"><?php echo $data['subcat_name'];?></option>
        <?php
		}
?>