<?php
$result='';
if(isset($_POST['btn_large'])){
$num1=$_POST['txt_num1'];
$num2=$_POST['txt_num2'];
$num3=$_POST['txt_num3'];
if($num1>=$num2){
if($num1>=$num3){
	$result=$num1;
}else{
	$result=$num3;
}
}else{
	if($num2>=$num3){
		$result=$num2;
	}else{
		$result=$num3;
	}
}
}
if(isset($_POST['btn_small'])){
$num1=$_POST['txt_num1'];
$num2=$_POST['txt_num2'];
$num3=$_POST['txt_num3'];
if($num1<=$num2){
if($num1<=$num3){
	$result=$num1;
}else{
	$result=$num3;
}
}else{
	if($num2<=$num3){
		$result=$num2;
	}else{
		$result=$num3;
	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Number 1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
      <td>number 2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
      <td>number 3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td colspan="6"><input type="submit" name="btn_large" id="btn_large" value="largest" />
      <input type="submit" name="btn_small" id="btn_small" value="smallest" /></td>
    </tr>
    <tr>
      <td colspan="3">Result</td>
      <td colspan="3"><?php echo $result; ?></td>
    </tr>
  </table>
</form>
</body>
</html>