<?php
session_start();
session_destroy();
echo "<script>window.open('LOGIN.php','_self');</script>";
?>