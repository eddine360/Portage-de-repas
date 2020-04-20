<?php
    if (!empty($_SESSION['id'])){
		$_SESSION['confirm_deconnect']=1;
		session_unset($_SESSION['id']);
		session_unset($_SESSION['type']);
    }
    header('Location: ./index.php');
?>