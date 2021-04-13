<?php
unset($_SESSION);
session_destroy();
header("Location: https://augustcollectives.com/index.php");
?>