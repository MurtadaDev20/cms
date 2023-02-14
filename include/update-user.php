<?php
	include_once("config.php");
	session_start();
	$id = intval($_POST['user']);
	$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
	$user = mysqli_fetch_assoc($get_user);
	
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		if(empty($username)){
			echo '<div class="alert alert-danger" role="alert">الرجاء ادخال اسم المستخدم</div>';
		}elseif(empty($email)){
			echo '<div class="alert alert-danger" role="alert">الرجاء ادخال البريد الالكتروني</div>';
		}elseif(!filter_var($email , FILTER_VALIDATE_EMAIL)){
			echo '<div class="alert alert-danger" role="alert">الرجاء ادخال بريد الكتروني صحيح</div>';
		}else{
			$sql = mysqli_query($conn , "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'");
			if(mysqli_num_rows($sql) > 0 ){
				if($username == $user['username'] AND $email == $user['email']){
					if($_POST['password'] != '' OR $_POST['con_password'] != ''){
						if($_POST['password'] != $_POST['con_password']){
							echo '<div class="alert alert-danger" role="alert">كلمة المرور غير متطابقة</div>';
						}else{
							if(isset($_FILES['image'])){
								$password = md5($_POST['password']);
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
							
								$image_exe = explode('.' , $image_name);
								$image_exe = strtolower(end($image_exe));
								
								$allowd = array('gif','png','jpg','jpej');
								
								if(in_array($image_exe , $allowd)){
									if($image_error === 0){
										if($image_size <= 3000000){
											$new_name = uniqid('user',false) . '.' . $image_exe;
											$image_dir = '../images/avatar/' . $new_name;
											$image_db = 'images/avatar/' . $new_name;
											if(move_uploaded_file($image_tmp , $image_dir)){
												$update_user = "UPDATE `users` SET `password` = '$password' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
												$sql = mysqli_query($conn, $update_user);
												if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
									}
								}else{
									echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
								}
							}else{
								$update_user = "UPDATE `users` SET `password` = '$password' , `gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
								$sql = mysqli_query($conn, $update_user);
									if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
									}
							}
						}
					}else{
						if(isset($_FILES['image'])){
							$image = $_FILES['image'];
							$image_name = $image['name'];
							$image_tmp = $image['tmp_name'];
							$image_size = $image['size'];
							$image_error = $image['error'];
								$image_exe = explode('.' , $image_name);
								$image_exe = strtolower(end($image_exe));
								
								$allowd = array('gif','png','jpg','jpej');
								
								if(in_array($image_exe , $allowd)){
									if($image_error === 0){
										if($image_size <= 3000000){
											$new_name = uniqid('user',false) . '.' . $image_exe;
											$image_dir = '../images/avatar/' . $new_name;
											$image_db = 'images/avatar/' . $new_name;
											if(move_uploaded_file($image_tmp , $image_dir)){
												$update_user = "UPDATE `users` SET `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
												$sql = mysqli_query($conn, $update_user);
												if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
									}
								}else{
									echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
								}
							}else{
								$update_user = "UPDATE `users` SET `gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
								$sql = mysqli_query($conn, $update_user);
									if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
									}
							}
					}
					
				}elseif($username != $user['username'] AND $email == $user['email']){
					$sql = mysqli_query($conn, "SELECT `username` FROM `users` WHERE `username` = '$username'");
					if(mysqli_num_rows($sql) > 0){
						echo '<div class="alert alert-danger" role="alert">عذراً ولكن اسم المستخدم مسجل بالفعل</div>';
					}else{
						if($_POST['password'] != '' OR $_POST['con_password'] != ''){
							if($_POST['password'] != $_POST['con_password']){
								echo '<div class="alert alert-danger" role="alert">كلمة المرور غير متطابقة</div>';
							}else{
								if(isset($_FILES['image'])){
								$password = md5($_POST['password']);
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `username` = '$username' ,`password` = '$password' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `username` = '$username' ,`password` = '$password' , `gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
										}
								}
							}
						}else{
							if(isset($_FILES['image'])){
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `username` = '$username' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `username` = '$username' ,`gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]'  WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
										}
								}
						}
					}
				}elseif($username == $user['username'] AND $email != $user['email']){
					$sql = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email'");
					if(mysqli_num_rows($sql) > 0){
						echo '<div class="alert alert-danger" role="alert">عذراً , ولكن البريد الالكتروني مسجل بالفعل</div>';
					}else{
						if($_POST['password'] != '' OR $_POST['con_password'] != ''){
							if($_POST['password'] != $_POST['con_password']){
								echo '<div class="alert alert-danger" role="alert">كلمة المرور غير متطابقة</div>';
							}else{
								if(isset($_FILES['image'])){
								$password = md5($_POST['password']);
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `email` = '$email' ,`password` = '$password' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `email` = '$email' ,`password` = '$password' , `gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';									}
								}
							}
						}else{
							if(isset($_FILES['image'])){
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `email` = '$email' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `email` = '$email' ,`gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
										}
								}
						}
					}
				}else{
					echo '<div class="alert alert-danger" role="alert">اسم المستخدم او البريد الاكتروني مسجل بالفعل</div>';
				}
			}else{
					if($_POST['password'] != '' OR $_POST['con_password'] != ''){
							if($_POST['password'] != $_POST['con_password']){
								echo '<div class="alert alert-danger" role="alert">كلمة المرور غير متطابقة</div>';
							}else{
								if(isset($_FILES['image'])){
								$password = md5($_POST['password']);
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `username` = '$username' , `email` = '$email' ,`password` = '$password' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `username` = '$username',`email` = '$email' ,`password` = '$password' , `gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]'  WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
										}
								}
							}
						}else{
							if(isset($_FILES['image'])){
								$image = $_FILES['image'];
								$image_name = $image['name'];
								$image_tmp = $image['tmp_name'];
								$image_size = $image['size'];
								$image_error = $image['error'];
									$image_exe = explode('.' , $image_name);
									$image_exe = strtolower(end($image_exe));
									
									$allowd = array('gif','png','jpg','jpej');
									
									if(in_array($image_exe , $allowd)){
										if($image_error === 0){
											if($image_size <= 3000000){
												$new_name = uniqid('user',false) . '.' . $image_exe;
												$image_dir = '../images/avatar/' . $new_name;
												$image_db = 'images/avatar/' . $new_name;
												if(move_uploaded_file($image_tmp , $image_dir)){
													$update_user = "UPDATE `users` SET `username` = '$username' , `email` = '$email' , `gender` = '$_POST[gender]', `avatar` = '$image_db', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
													$sql = mysqli_query($conn, $update_user);
													if(isset($sql)){
														session_unset();
														$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
														$user = mysqli_fetch_assoc($user_info);
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
														echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
														echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
													}
												}else{
													echo '<div class="alert alert-danger" role="alert">حدث خطأ اثناء نقل الملف</div>';
												}
											}else{
												echo '<div class="alert alert-danger" role="alert">حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
											}
										}else{
											echo '<div class="alert alert-danger" role="alert">حدث خطأ غير متوقع اثناء رفع الصورة</div>';
										}
									}else{
										echo '<div class="alert alert-danger" role="alert">عذراً ولكن امتداد الصورة غير صحيح</div>';
									}
								}else{
									$update_user = "UPDATE `users` SET `username` = '$username' , `email` = '$email' ,`gender` = '$_POST[gender]', `about_user` = '$_POST[about]' , `facebook` = '$_POST[facebook]', `twitter` = '$_POST[twitter]', `youtube` = '$_POST[youtube]' WHERE `user_id` = '$id'";
									$sql = mysqli_query($conn, $update_user);
										if(isset($sql)){
													session_unset();
													$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
													$user = mysqli_fetch_assoc($user_info);
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
													echo '<div class="alert alert-success" role="alert">تم تحديث البيانات جاري تحويلك الى الصفحة الشخصية</div>';
													echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$id.'\' " />';
										}
								}
						}
			}
		}
	}else{
		header("Location: index.php");
	}

?>