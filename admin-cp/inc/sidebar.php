	<aside class="col-lg-3">
		<div class="list-group">
		  <a href="#" class="list-group-item disabled">
			الوصول السريع
		  </a>
		  <?php
			if($_SESSION['role'] == 'admin'){
			?>

		  <a href="index.php" class="list-group-item"><i class="fa fa-tachometer"></i> لوحة التحكم</a>
		  <a href="setting.php" class="list-group-item"><i class="fa fa-cog"></i> إعدادات الموقع</a>
		  <a href="category.php" class="list-group-item"><i class="fa fa-list"></i> التصنيفات</a>
		  <a href="new-post.php" class="list-group-item"><i class="fa fa-pencil"></i> اضافة مقال جديد</a>
		  <a href="posts.php" class="list-group-item"><i class="fa fa-file-o"></i> المقالات</a>
		  <a href="users.php" class="list-group-item"><i class="fa fa-user"></i> الأعضاء</a>
		  <a href="comment.php" class="list-group-item"><i class="fa fa-comments-o"></i> التعليقات</a>
		  <a href="profile.php" class="list-group-item"><i class="fa fa-star"></i> الصفحة الشخصية</a>
		 <?php
		 	}else{
		?>
			<a href="index.php" class="list-group-item"><i class="fa fa-tachometer"></i> لوحة التحكم</a>
		  <a href="category.php" class="list-group-item"><i class="fa fa-list"></i> التصنيفات</a>
		  <a href="new-post.php" class="list-group-item"><i class="fa fa-pencil"></i> اضافة مقال جديد</a>
		  <a href="posts.php" class="list-group-item"><i class="fa fa-file-o"></i> المقالات</a>
		  <a href="comment.php" class="list-group-item"><i class="fa fa-comments-o"></i> التعليقات</a>
		  <a href="profile.php" class="list-group-item"><i class="fa fa-star"></i> الصفحة الشخصية</a>
		
		<?php
			}
		  ?>
		  
		</div>
	</aside>