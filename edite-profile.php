<?php
	include_once("include/header.php");
	include_once("include/sidebar.php");
	$id = (int)$_GET['user'];
	if($_SESSION['id'] != $id){
		header("Location: index.php");
	}
	$user_info = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$id'");
	if(mysqli_num_rows($user_info) != 1){
		header("Location: index.php");
	}
	$user = mysqli_fetch_assoc($user_info);
?>
<article class="col-md-9 col-lg-9">
<ol class="breadcrumb">
  <li><a href="index.php">الرئيسية</a></li>
  <li class="active">تعديل الصفحة الشخصية للعضو <?php echo ucwords($user['username']); ?></li>
</ol>
	<div class="col-lg-12 art_bg">
			<form action="include/update-user.php" id="update-user" method="post" class="form-horizontal col-md-9" enctype="multipart/form-data" style="margin-top: 20px;">
			<input type="hidden" value="<?php echo $user['user_id']; ?>" name="user" />
			  <div class="form-group">
				<label for="username" class="col-sm-2 control-label"><span style="color: red;">*</span> اسم المستخدم : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" id="username" placeholder="ادخل اسم المستخدم">
				</div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-2 control-label"><span style="color: red;">*</span> البريد الالكتروني : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email']; ?>" placeholder="ادخل البريد الالكتروني">
				</div>
			  </div>
			  <div class="form-group">
				<label for="password" class="col-sm-2 control-label"> كلمة المرور : </label>
				<div class="col-sm-5">
				  <input type="password" class="form-control" name="password" id="password" placeholder="ادخل كلمة المرور">
				</div>
			  </div>
			  <div class="form-group">
				<label for="con-password" class="col-sm-2 control-label"> تأكيد كلمة المرور :</label>
				<div class="col-sm-5">
				  <input type="password" class="form-control" name="con_password" id="con-password" placeholder="إعاداة كتابة كلمة المرور">
				</div>
			  </div>
			  <div class="form-group">
				<label for="gender" class="col-sm-2 control-label">الجنس : </label>
				<div class="col-sm-3">
				  <select name="gender" class="form-control" id="gender">
					<option value="">اختر الجنس</option>
					<option value="male" <?php echo ($user['gender'] == 'male' ? 'selected' : '');?>>ذكر</option>
					<option value="female" <?php echo ($user['gender'] == 'female' ? 'selected' : '');?>>انثى</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="avatar" class="col-sm-2 control-label">الصورة الرمزية : </label>
				<div class="col-sm-9">
				  <input type="file" name="image" class="form-control" id="avatar">
				</div>
			  </div>
			  <div class="form-group">
				<label for="about-you" class="col-sm-2 control-label">الوصف :</label>
				<div class="col-sm-9">
				  <textarea class="form-control" name="about" id="about-you" rows="4"><?php echo strip_tags($user['about_user']); ?></textarea>
				</div>
			  </div>
			<div class="form-group">
				<label for="facebook" class="col-sm-2 control-label"><i class="fa fa-facebook-square"></i> </label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="facebook" value="<?php echo $user['facebook']; ?>" id="facebook" placeholder="ادخل رابط صفحتك على الفيس بوك">
				</div>
			  </div>
			  <div class="form-group">
				<label for="twitter" class="col-sm-2 control-label"><i class="fa fa-twitter-square"></i></label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="twitter" value="<?php echo $user['twitter']; ?>" id="twitter" placeholder="ادخل رابط صفحتك على تويتر">
				</div>
			  </div>
			  <div class="form-group">
				<label for="youtube" class="col-sm-2 control-label"><i class="fa fa-youtube-square"></i> </label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="youtube" value="<?php echo $user['youtube']; ?>" id="youtube" placeholder="ادخل رابط قناتك على اليوتيوب">
				</div>
			  </div>
			  <div id="up_result"></div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-9">
				  <button type="submit" name="submit" class="btn btn-danger btn-block"><i class="fa fa-pencil"></i>  تعديل البيانات</button>
				</div>
			  </div>
			</form>
	</div>
<article>

<?php
	include_once("include/footer.php");
?>