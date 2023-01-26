<?php
session_start();
session_unset();
unset($_SESSION['log']);
unset($_SESSION['rol']);
session_destroy();

header('Location:index.php');
?>