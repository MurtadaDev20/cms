<?php
	include_once("inc/header.php");
	include_once("inc/sidebar.php");
	$msg = '';
	if(isset($_GET['status']) AND isset($_GET['post'])){
		$sql = mysqli_query($conn, "UPDATE `posts` SET `status` = '$_GET[status]' WHERE `post_id` = '$_GET[post]'");
	}
	
	if(isset($_GET['delete'])){
		$sql = mysqli_query($conn, "DELETE FROM `posts` WHERE `post_id` = '$_GET[delete]'");
		if(isset($sql)){
			$msg = '<div class="alert alert-success" role="alert">تم حذف المقال بنجاح</div>';
		}
	}
?>

	<article class="col-lg-9">
	<?php echo $msg; ?>
		<div class="panel panel-info">
		  <div class="panel-heading"><b>المقالات</b></div>
		  <div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>صورة المقال</th>
					<th>عنوان المقال</th>
					<th>الكاتب</th>
					<th>التصنيف</th>
					<th>تاريخ النشر</th>
					<th>مشاهدة</th>
					<th>الحالة</th>
					<th>تعديل</th>
					<th>حذف</th>
				</tr>
			</thead>
			<tbody>
			<?php
				
				$per_page = 5;
				
				if(!isset($_GET['page'])){
					$page = 1;
				}else{
					$page = (int)$_GET['page'];
				}
				
				$start_from = ($page-1) * $per_page;
				
			
				$posts = mysqli_query($conn, "SELECT * FROM `posts` p INNER JOIN `users` u WHERE p.author = u.user_id ORDER BY `post_id` DESC LIMIT $start_from , $per_page");
				$num = 1;
				while($post = mysqli_fetch_assoc($posts)){
					echo '
						<tr>
							<td>'.$num.'</td>
							<td><img src="../'.($post['image'] == '' ? 'images/no-image.png' : $post['image']).'" class="img-rounded" width="70px" /></td>
							<td>'.substr($post['title'],0,40).' ...</td>
							<td>'.$post['username'].'</td>
							<td>'.$post['category'].'</td>
							<td>'.$post['post_date'].'</td>
							<td><a href="../post.php?id='.$post['post_id'].'" class="btn btn-primary btn-xs" target="_blank">مشاهدة المقال</a></td>
							<td>'.($post['status'] == 'dreft' ? '<a href="posts.php?status=published&post='.$post['post_id'].'&page='.$page.'" class="btn btn-success btn-xs">نشر</a>' : '<a href="posts.php?status=dreft&post='.$post['post_id'].'&page='.$page.'" class="btn btn-info btn-xs">تعطيل</a>').'</td>
							<td><a href="edite-post.php?post='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
							<td><a href="posts.php?delete='.$post['post_id'].'&page='.$page.'" class="btn btn-danger btn-xs">حذف</a></td>
						</tr>
					';
				$num++;
				}
			?>

			</tbody>
			</table>
			
			<?php
				$page_sql = mysqli_query($conn , "SELECT * FROM `posts`");
				$count_page = mysqli_num_rows($page_sql);
				
				$total_page = ceil($count_page / $per_page);
			?>
			<nav class="text-center">
				<ul class="pagination">
			<?php
				for($i = 1; $i <= $total_page; $i++){
					echo '<li '.($page == $i ? 'class="active"' : '').'><a href="posts.php?page='.$i.'">'.$i.'</a></li>';
				}
			?>
				</ul>
			</nav>
		  </div>
		</div>
	</article>
<?php
	include_once("inc/footer.php");
?>