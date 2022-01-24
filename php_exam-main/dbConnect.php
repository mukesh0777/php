<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$_SESSION['mysqli'] = new mysqli("localhost", "admin", "PassWord!", "php_exam_db");  
?>