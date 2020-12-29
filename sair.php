<?php
	session_start();
	session_unset();
	session_destroy();
	echo "<script type='text/javascript'> alert('Você foi deslogado!')</script>";                 
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
?>