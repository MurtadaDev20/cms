<?php
	include_once("inc/header.php");
	include_once("inc/sidebar.php");
	$msg = '';
	if(isset($_POST['add_post'])){
		$title = strip_tags($_POST['title']);
		$post = $_POST['post'];
		$category = $_POST['category'];
		$status = $_POST['status'];
		if(empty($title)){
			$msg = '<div class="alert alert-danger" role="alert">الرجاء ادخال عنوان المقال</div>';
		}elseif(empty($post)){
			$msg = '<div class="alert alert-danger" role="alert">الرجاء ادخال المقال</div>';
		}elseif(empty($category)){
			$msg = '<div class="alert alert-danger" role="alert">الرجاء اختيار التصنيف</div>';
		}else{
			
			$image = $_FILES['image'];
			$image_name = $image['name'];
			$image_tmp = $image['tmp_name'];
			$image_size = $image['size'];
			$image_error = $image['error'];
			if($image_name != ''){
					$image_exe = explode('.' , $image_name);
					$image_exe = strtolower(end($image_exe));
					
					$allowd = array('png','gif','jpg','jpeg');
					
					if(in_array($image_exe , $allowd)){
						 if($image_error === 0){
							if($image_size <= 3000000){
								$new_name = uniqid('post',false) . '.' . $image_exe;
								$image_dir = '../images/posts/' . $new_name;
								$image_db = 'images/posts/' . $new_name;
								if(move_uploaded_file($image_tmp , $image_dir)){
									$insert = mysqli_query($conn, "UPDATE `posts` SET `title` = '$title', `post` = '$post', `category` = '$category' , `image` = '$image_db', `status` = '$status' WHERE `post_id` = '$_GET[post]'");
									if(isset($insert)){
										$msg =  '<div class="alert alert-success" role="alert">تم تحديث المقال , جاري تحويلك الى المقالات</div>';
										echo '<meta http-equiv="refresh" content="3; \'posts.php\' " />';
									}
								}else{
									$msg =  '<div class="alert alert-danger" role="alert">عذراً , حدث خطأ اثناء رفع الصورة</div>';
								}
							}else{
								$msg =  '<div class="alert alert-danger" role="alert">عذراً , ولكن حجم الصورة كبير جداً يجب ان لا يتعدى 2 MB</div>';
							}
						 }else{
							$msg =  '<div class="alert alert-danger" role="alert">عذراً , حديث خطأ غير متوقع اثناء رفع الصورة</div>';
						 }
					}else{
						$msg =  '<div class="alert alert-danger" role="alert">الرجاء اختيار صورة صحيحية</div>';
					}
			}else{
				$insert = mysqli_query($conn, "UPDATE `posts` SET `title` = '$title', `post` = '$post', `category` = '$category' , `status` = '$status' WHERE `post_id` = '$_GET[post]'");
					if(isset($insert)){
						$msg =  '<div class="alert alert-success" role="alert">تم تحديث المقال , جاري تحويلك الى المقالات</div>';
						echo '<meta http-equiv="refresh" content="3; \'posts.php\' " />';
					}
			}
		}
	}
?>
<article class="col-lg-9">
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-10">
		<?php
		echo $msg; 
		$get_post = mysqli_query($conn,"SELECT * FROM `posts` WHERE `post_id` = '$_GET[post]'");
		$post = mysqli_fetch_assoc($get_post);
		?>
			<div class="panel panel-info">
			  <div class="panel-heading"><b>تعديل مقال : </b><?php echo $post['title']; ?></div>
			  <div class="panel-body">
				<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">عنوان المقال</label>
					<div class="col-sm-5">
					  <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>" id="title" placeholder="ادخل عنوان المقال">
					</div>
				  </div>

				  <div class="form-group">
					<label for="post" class="col-sm-2 control-label">المقال</label>
					<div class="col-sm-10">
					  <textarea rows="8" class="form-control" name="post" id="post"><?php echo $post['post']; ?></textarea>
					</div>
				  </div>

				  <div class="form-group">
					<label for="category" class="col-sm-2 control-label">اختر التصنيف</label>
					<div class="col-sm-4">
					  <select class="form-control" name="category" id="category">
					  <option value="">اختر التصنيف</option>
					  <?php
						$cat = mysqli_query($conn, "SELECT * FROM `category`");
						while($cate = mysqli_fetch_assoc($cat)){
							echo '<option value="'.$cate['category'].'" '.($post['category'] == $cate['category'] ? 'selected' : '').'>'.$cate['category'].'</option>';
						}
						?>
					  </select>
					</div>
				  </div>

				  <div class="form-group">
					<label for="image" class="col-sm-2 control-label">عنوان المقال</label>
					<div class="col-sm-5">
					  <input type="file" class="form-control" name="image" id="image">
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="status" class="col-sm-2 control-label">حالة المقال</label>
					<div class="col-sm-3">
					  <select class="form-control" name="status" id="status">
						<option value="published" <?php if($post['status'] == 'published'){ echo 'selected';} ?>>نشر</option>
						<option value="dreft" <?php if($post['status'] == 'dreft'){ echo 'selected';} ?>>تعطيل</option>
					  </select>
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" name="add_post" class="btn btn-danger">تحديث المقال</button>
					</div>
				  </div>
				</form>
			  </div>
			</div>
		</div>
	</div>
		
</article>

<?php
	include_once("inc/footer.php");
?>