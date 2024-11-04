<?php
session_start();
if(!isset($_SESSION['mid'])){
    header("location:../Guest/Login.php");
}
?>