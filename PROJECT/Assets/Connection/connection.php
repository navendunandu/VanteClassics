<?php 
$server="localhost";
$username="root";
$password="";
$db="db_bagstore";

$Con = mysqli_connect($server,$username,$password,$db);

if(!$Con)
{
	echo("Error");	
}
?>