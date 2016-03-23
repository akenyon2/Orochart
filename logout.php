<?php
session_start();
session_destroy();
header("Location: http://localhost/Orochart/index.php");
?>