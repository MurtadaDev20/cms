<?php
	include_once("include/header.php");
	include_once("include/sidebar.php");
	
	$id = $_GET['cate'];
	$per_page = 3;
				
	if(!isset($_GET['page'])){
		$page = 1;
	}else{
		$page = (int)$_GET['page'];
	}
				
	$start_from = ($page-1) * $per_page;
	$select_category = mysqli_query($conn, "SELECT * FROM `posts` p INNER JOIN `users` u ON p.author = u.user_id WHERE `category` = '$id' AND `status` = 'published' ORDER BY `post_id` DESC LIMIT $start_from , $per_page");
?>
<article class="col-md-9 col-lg-9">
<ol class="breadcrumb">
  <li><a href="index.php">الرئيسية</a></li>
  <li class="active"><?php echo $id; ?></li>
</ol>
	<div class="col-lg-12 art_bg">

		<?php
		while($post = mysqli_fetch_assoc($select_category)){
		?>
	
			<div class="cate_post">
				<div class="col-md-3">
					<img src="<?php echo ($post['image'] == '' ? 'images/no-img.png' : $post['image']); ?>" width="100%" />
				</div>
				<div class="col-md-9">
					<h2 class="cat_h2"><?php echo strip_tags($post['title']);?></h2>
					<p>
				<?php echo strip_tags(substr($post['post'] , 0 , 500)); ?> ...
					</p>
				</div>
				<div class="col-md-12">
					<hr style="margin-bottom: 8px;margin-top: 0px;"/>
					<a href="post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-warning pull-left">اقرأ المزيد</a>
					<p class="pull-right"><i class="fa fa-user"></i> : <a href="profile.php?user=<?php echo $post['user_id']; ?>"><?php echo $post['username']; ?></a>  |  <i class="fa fa-clock-o"></i> <?php echo $post['post_date']; ?></p>
				</div>
			<div class="clearfix"></div>
			</div>
		<?php
		}
		?>
		<?php
				$page_sql = mysqli_query($conn , "SELECT * FROM `posts` WHERE `category` = '$id'");
				$count_page = mysqli_num_rows($page_sql);
				
				$total_page = ceil($count_page / $per_page);
			?>
			<nav class="text-center">
				<ul class="pagination">
			<?php
				for($i = 1; $i <= $total_page; $i++){
					echo '<li '.($page == $i ? 'class="active"' : '').'><a href="category.php?cate='.$id.'&page='.$i.'">'.$i.'</a></li>';
				}
			?>
				</ul>
			</nav>
	</div>
<article>

<?php
	include_once("include/footer.php");
?>