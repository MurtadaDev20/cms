<?php
	session_start();
	
	include_once("config.php");
	
	if(isset($_POST['submit'])){
		$title = strip_tags($_POST['title']);
		$comment = strip_tags($_POST['comment']);
		$post = (int) $_POST['id'];
		$date = date("Y-m-d : h-i-sa");
		if(empty($title)){
			echo '<div class="alert alert-danger" role="alert">الرجاء ادخال عنوان التعليق</div>';
		}elseif(empty($comment)){
			echo '<div class="alert alert-danger" role="alert">الرجاء ادخال التعليق</div>';
		}else{
			$insert = mysqli_query($conn, "INSERT INTO `comments` (
																`post_id`,
																`user_id`,
																`title`,
																`comment`,
																`status`,
																`com_date`
																  ) VALUES (
																'$post',
																'$_SESSION[id]',
																'$title',
																'$comment',
																'dreft',
																'$date'
																  )");
				if(isset($insert)){
					echo '<div class="alert alert-success" role="alert">تم اضافة التعليق بنجاح ، سيتم نشره حال الموافقة عليه</div>';
				}
		}
	}
?>