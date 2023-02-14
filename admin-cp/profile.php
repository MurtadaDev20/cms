<?php
	include_once("inc/header.php");
	include_once("inc/sidebar.php");
	$msg = '';
	$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$_SESSION[id]'");
	$user = mysqli_fetch_object($get_user);
	if(isset($_GET['status']) AND isset($_GET['post'])){
		$sql = mysqli_query($conn, "UPDATE `posts` SET `status` = '$_GET[status]' WHERE `post_id` = '$_GET[post]'");
		if(isset($sql)){
			$msg = '<div class="alert alert-success" role="alert">تم تغيير حالة المنشور بنجاح</div>';
		}
	}
	
	if(isset($_GET['delete'])){
		$sql = mysqli_query($conn, "DELETE FROM `posts` WHERE `post_id` = '$_GET[delete]'");
		if(isset($sql)){
			$msg = '<div class="alert alert-success" role="alert">تم حذف المقال بنجاح</div>';
		}
	}
?>

	<article class="col-lg-9">
		
		<div class="col-md-1"></div>
		<div class="col-md-10">
		<?php echo $msg; ?>
				<div class="panel panel-info">
				  <div class="panel-heading"><b>أهلا وسهلاً بكـ يا <?php echo $user->username; ?></b></div>
				  <div class="panel-body">
					<div class="col-md-9">
						<p><b>اسم المستخدم : <?php echo $user->username; ?></b></p>
						<p><b>البريد الالكتروني : <?php echo $user->email; ?></b></p>
						<p><b>الجنس : <?php if($user->gender == 'male'){echo '<img src="../images/male.png" width="30px" />';}else{echo '<img src="../images/female.png" width="30px" />';} ?></b></p>
						<p><b>تاريخ التسجيل : <?php echo $user->reg_date; ?></b></p>
						<p><b>روابط التواصل : <a href="<?php echo $user->facebook; ?>" target="_blank" class="lo_face"><i class="fa fa-facebook-square fa-lg"></i> </a> |  <a href="<?php echo $user->twitter; ?>" target="_blank" class="lo_twt"><i class="fa fa-twitter-square fa-lg"></i> </a> | <a href="<?php echo $user->youtube; ?>" target="_blank" class="lo_tube"><i class="fa fa-youtube-square fa-lg"></i> </a> </b></p>
					</div>
					<div class="col-md-3">
						<img src="../<?php echo $user->avatar; ?>" class="img-thumbnail" width="100%" />
					</div>
					<div class="col-md-12">
						<hr>
						<p><b>الوصف المختصر : </b></p>
						<p><?php echo strip_tags($user->about_user); ?></p>
						<a href="edite_user.php?user=<?php echo $user->user_id; ?>" class="btn btn-danger pull-left">تعديل البيانات</a>
					</div>
				  </div>
				</div>
		</div>
		<div class="col-md-12">
		<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
		<div class="panel panel-warning">
			<div class="panel-heading"><b>آخر المواضيع التي كتبتها<b></div>
			<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>صورة المقال</th>
					<th>عنوان المقال</th>
					<th>تاريخ النشر</th>
					<th>مشاهدة</th>
					<th>الحالة</th>
					<th>تعديل</th>
					<th>حذف</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$posts = mysqli_query($conn, "SELECT * FROM `posts` WHERE author = '$_SESSION[id]' ORDER BY `post_id` DESC LIMIT 5");
				$num = 1;
				while($post = mysqli_fetch_assoc($posts)){
					echo '
						<tr>
							<td>'.$num.'</td>
							<td><img src="../'.($post['image'] == '' ? 'images/no-image.png' : $post['image']).'" class="img-rounded" width="70px" /></td>
							<td>'.substr($post['title'],0,40).' ...</td>
							<td>'.$post['post_date'].'</td>
							<td><a href="../post.php?id='.$post['post_id'].'" class="btn btn-primary btn-xs" target="_blank">مشاهدة المقال</a></td>
							<td>'.($post['status'] == 'dreft' ? '<a href="profile.php?status=published&post='.$post['post_id'].'" class="btn btn-success btn-xs">نشر</a>' : '<a href="profile.php?status=dreft&post='.$post['post_id'].'" class="btn btn-info btn-xs">تعطيل</a>').'</td>
							<td><a href="edite-post.php?post='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
							<td><a href="profile.php?delete='.$post['post_id'].'" class="btn btn-danger btn-xs">حذف</a></td>
						</tr>
					';
				$num++;
				}
			?>

			</tbody>
		</table>
			</div>
		</div>
		</div>
		</div>
		</div>
	</article>
<?php
	include_once("inc/footer.php");
?>