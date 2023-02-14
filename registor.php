<?php
	include_once("include/header.php");
	include_once("include/sidebar.php");
	
?>
<div class="col-lg-9">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php">الرئيسية</a></li>
			<li class="active">تسجيل عضوية جديدة</li>
		</ol>
	</div>
</div>
<article class="col-md-9 col-lg-9 art_bg">
	<div class="page-header">
	  <h1><i class="fa fa-user"></i> تسجيل عضوية جديدة <small>الحقول المؤشر عليها بـ (<span style="color: red;">*</span>) مطلوبة</small></h1>
	</div>
	
	<div class="col-md-12">
		<?php register(); ?>
	</div>
	
<article>

<?php
	include_once("include/footer.php");
?>