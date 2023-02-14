
	<?php
	session_start();
	if(isset($_GET['id'])){
		session_destroy();
		header("Location: index.php");
	}