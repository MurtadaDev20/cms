<?php
	include_once("inc/header.php");
	include_once("inc/sidebar.php");
	
	$get_user = mysqli_query($conn, "SELECT `username` ,`email` , `avatar` , `role` FROM `users` WHERE `user_id` = '$_SESSION[id]'");
	$user = mysqli_fetch_assoc($get_user);
	
	$posts = mysqli_query($conn , "SELECT * FROM `posts`");
	$post = mysqli_num_rows($posts);
	
	$users = mysqli_query($conn , "SELECT * FROM `users`");
	$count_user = mysqli_num_rows($users);
	
	$comments = mysqli_query($conn , "SELECT * FROM `comments`");
	$count_comments = mysqli_num_rows($comments);
?>

	<article class="col-lg-9">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-primary">
					  <div class="panel-heading">أهلا وسهلاً بكـ يا <?php echo ucwords($user['username']); ?></div>
					  <div class="panel-body">
						<div class="text-center">
							<img src="../<?php echo $user['avatar']; ?>" width="40%" style="max-width: 150px;"/>
							<hr>
						</div>
						<div class="text-right">
							<p>البريد : <?php echo $user['email']; ?></p>
							<p>الصلاحية : <?php echo ($user['role'] == 'admin' ? 'المدير العام' : 'كاتب'); ?></p>
							<p class="text-left"><a href="" class="btn btn-warning btn-xs">تعديل البيانات</a></p>
						</div>
					  </div>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="panel panel-success">
					  <div class="panel-heading">المقالات</div>
					  <div class="panel-body">
						<div class="col-md-8">
							<i class="fa fa-list-alt fa-5x" style="color: #3C763D;"></i>
						</div>
						<div class="col-md-4">
							<p><b><?php echo $post; ?></b></p>
						</div>
					  </div>
					  <div class="panel-footer text-center"><i class="fa fa-eye"></i>  <a href=""><b>مشاهدة</b></a></div>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="panel panel-danger">
					  <div class="panel-heading">التعليقات</div>
					  <div class="panel-body">
						<div class="col-md-8">
							<i class="fa fa-comments-o fa-5x" style="color: #A94442;"></i>
						</div>
						<div class="col-md-4">
							<p><b><?php echo $count_comments; ?></b></p>
						</div>
					  </div>
					  <div class="panel-footer text-center"><i class="fa fa-eye"></i>  <a href="comment.php"><b>مشاهدة</b></a></div>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="panel panel-info">
					  <div class="panel-heading">الأعضاء</div>
					  <div class="panel-body">
						<div class="col-md-8">
							<i class="fa fa-users fa-5x" style="color: #31708F;"></i>
						</div>
						<div class="col-md-4">
							<p><b><?php echo $count_user; ?></b></p>
						</div>
					  </div>
					  <div class="panel-footer text-center"><i class="fa fa-eye"></i>  <a href=""><b>مشاهدة</b></a></div>
					</div>
				</div>
				
				<div class="col-md-12">
				<div class="panel panel-info">
				  <div class="panel-heading"><b>جديد المقالات</b></div>
				  <div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>صورة المقال</th>
							<th>عنوان المقال</th>
							<th>الكاتب</th>
							<th>تاريخ النشر</th>
							<th>مشاهدة</th>
							<th>الحالة</th>
							<th>تعديل</th>
							<th>حذف</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$posts = mysqli_query($conn, "SELECT * FROM `posts` p INNER JOIN `users` u WHERE p.author = u.user_id ORDER BY `post_id` DESC LIMIT 5");
						$num = 1;
						while($post = mysqli_fetch_assoc($posts)){
							echo '
								<tr>
									<td>'.$num.'</td>
									<td><img src="../'.($post['image'] == '' ? 'images/no-image.png' : $post['image']).'" class="img-rounded" width="70px" /></td>
									<td>'.substr($post['title'],0,40).' ...</td>
									<td>'.$post['username'].'</td>
									<td>'.$post['post_date'].'</td>
									<td><a href="../post.php?id='.$post['post_id'].'" class="btn btn-primary btn-xs" target="_blank">مشاهدة المقال</a></td>
									<td>'.($post['status'] == 'dreft' ? '<a href="posts.php?status=published&post='.$post['post_id'].'" class="btn btn-success btn-xs">نشر</a>' : '<a href="posts.php?status=dreft&post='.$post['post_id'].'" class="btn btn-info btn-xs">تعطيل</a>').'</td>
									<td><a href="edite-post.php?post='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
									<td><a href="posts.php?delete='.$post['post_id'].'" class="btn btn-danger btn-xs">حذف</a></td>
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
				
				
				<div class="col-md-12">
				<div class="panel panel-warning">
				  <div class="panel-heading"><b>جديد الاعضاء</b></div>
				  <div class="panel-body">
				<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>الصورة الرمزية</th>
						<th>اسم العضو</th>
						<th>البريد الإلكتروني</th>
						<th>الجنس</th>
						<th>الصفحة الشخصية</th>
						<th>تعديل البيانات</th>
						<th>حذف</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$users = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `user_id` DESC LIMIT 5");
					$num = 1;
					while($user = mysqli_fetch_assoc($users)){
						echo '
							<tr>
								<td>'.$num.'</td>
								<td><img src="../'.$user['avatar'].'" width="50px" /></td>
								<td>'.$user['username'].'</td>
								<td>'.$user['email'].'</td>
								<td>'.($user['gender'] == 'male' ? '<img src="../images/male.png" width="30px" />' : '<img src="../images/female.png" width="30px" />').'</td>
								<td><a href="../profile.php?user='.$user['user_id'].'" class="btn btn-info btn-xs" target="_blank">مشاهدة</a></td>
								<td><a href="edite_user.php?user='.$user['user_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
								<td><a href="users.php?delete='.$user['user_id'].'" class="btn btn-danger btn-xs">حذف</a></td>
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