<?php
	include("config.php");
	session_start();
	if(isset($_POST['login'])){
		$user = stripcslashes(mysqli_real_escape_string($conn,$_POST['user']));
		$password = md5($_POST['password']);
		if(empty($user)){
			echo '<div class="alert alert-danger" role="alert">ادخل اسم المستخدم او البريد الالكتروني</div>';
		}elseif(empty($_POST['password'])){
			echo '<div class="alert alert-danger" role="alert">ادخل كلمة المرور</div>';
		}else{
			$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE (`username` = '$user' OR `email` = '$user') AND `password` = '$password'");
			if(mysqli_num_rows($sql) != 1){
				echo '<div class="alert alert-danger" role="alert">اسم الدخول او كلمة المرور غير صحيحة</div>';
			}else{
				$user = mysqli_fetch_assoc($sql);
				$_SESSION['id'] = $user['user_id'];
				$_SESSION['user'] = $user['username'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['gender'] = $user['gender'];
				$_SESSION['avatar'] = $user['avatar'];
				$_SESSION['about'] = $user['about_user'];
				$_SESSION['facebook'] = $user['facebook'];
				$_SESSION['twitter'] = $user['twitter'];
				$_SESSION['youtube'] = $user['youtube'];
				$_SESSION['date'] = $user['reg_date'];
				$_SESSION['role'] = $user['role'];
				echo '<div class="alert alert-success" role="alert">تم تسجيلك دخولك , جاري تحدث الصفحة</div>';
				echo '<meta http-equiv="refresh" content="3; \'index.php\' " />';
			}
		}
	}

?>