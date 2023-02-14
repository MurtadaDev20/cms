<?php
	include_once("inc/header.php");
	include_once("inc/sidebar.php");
	$msg = '';
	if($_SESSION['role'] != 'admin'){
		header("Location: index.php");
	}
	
	if(isset($_POST['submit'])){
		$sel_setting = mysqli_query($conn, "SELECT * FROM `setting`");
		if(mysqli_num_rows($sel_setting) != 1){
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
								$new_name = uniqid('logo',false) . '.' . $image_exe;
								$image_dir = '../images/' . $new_name;
								$image_db = 'images/' . $new_name;
								if(move_uploaded_file($image_tmp , $image_dir)){
									$insert = mysqli_query($conn, "INSERT INTO `setting` (
																					`site_name`,
																					`logo`,
																					`slide`,
																					`slide_value`,
																					`section_a`,
																					`section_a_value`,
																					`section_b`,
																					`section_b_value`,
																					`tab_a`,
																					`tab_a_value`,
																					`tab_b`,
																					`tab_b_value`,
																					`tab_c`,
																					`tab_c_value`,
																					`facebook`,
																					`twitter`,
																					`google`,
																					`instegram`
																) VALUES (
																					'$_POST[site_name]',
																					'$image_db',
																					'$_POST[slide]',
																					'$_POST[slide_num]',
																					'$_POST[section1]',
																					'$_POST[section_1_num]',
																					'$_POST[section2]',
																					'$_POST[section_2_num]',
																					'$_POST[tab1]',
																					'$_POST[tab_1_num]',
																					'$_POST[tab2]',
																					'$_POST[tab_2_num]',
																					'$_POST[tab3]',
																					'$_POST[tab_3_num]',
																					'$_POST[facebook]',
																					'$_POST[twitter]',
																					'$_POST[google]',
																					'$_POST[instegram]'
																)");
									if(isset($insert)){
										$msg =  '<div class="alert alert-success" role="alert">تم تحديث الاعدادات بنجاح</div>';
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
									$insert = mysqli_query($conn, "INSERT INTO `setting` (
																					`site_name`,
																					`slide`,
																					`slide_value`,
																					`section_a`,
																					`section_a_value`,
																					`section_b`,
																					`section_b_value`,
																					`tab_a`,
																					`tab_a_value`,
																					`tab_b`,
																					`tab_b_value`,
																					`tab_c`,
																					`tab_c_value`,
																					`facebook`,
																					`twitter`,
																					`google`,
																					`instegram`
																) VALUES (
																					'$_POST[site_name]',
																					'$_POST[slide]',
																					'$_POST[slide_num]',
																					'$_POST[section1]',
																					'$_POST[section_1_num]',
																					'$_POST[section2]',
																					'$_POST[section_2_num]',
																					'$_POST[tab1]',
																					'$_POST[tab_1_num]',
																					'$_POST[tab2]',
																					'$_POST[tab_2_num]',
																					'$_POST[tab3]',
																					'$_POST[tab_3_num]',
																					'$_POST[facebook]',
																					'$_POST[twitter]',
																					'$_POST[google]',
																					'$_POST[instegram]'
																)");
									if(isset($insert)){
										$msg =  '<div class="alert alert-success" role="alert">تم تحديث الاعدادات بنجاح</div>';
									}
			}
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
								$new_name = uniqid('logo',false) . '.' . $image_exe;
								$image_dir = '../images/' . $new_name;
								$image_db = 'images/' . $new_name;
								if(move_uploaded_file($image_tmp , $image_dir)){
									$insert = mysqli_query($conn, "UPDATE `setting` SET 
																					`site_name` = '$_POST[site_name]',
																					`logo` = '$image_db',
																					`slide` = '$_POST[slide]',
																					`slide_value` = '$_POST[slide_num]',
																					`section_a` = '$_POST[section1]',
																					`section_a_value` = '$_POST[section_1_num]',
																					`section_b` = '$_POST[section2]',
																					`section_b_value` = '$_POST[section_2_num]',
																					`tab_a` = '$_POST[tab1]',
																					`tab_a_value` = '$_POST[tab_1_num]',
																					`tab_b` = '$_POST[tab2]',
																					`tab_b_value` = '$_POST[tab_2_num]',
																					`tab_c` = '$_POST[tab3]',
																					`tab_c_value` = '$_POST[tab_3_num]',
																					`facebook` = '$_POST[facebook]',
																					`twitter` = '$_POST[twitter]',
																					`google` = '$_POST[google]',
																					`instegram` = '$_POST[instegram]'
																");
									if(isset($insert)){
										$msg =  '<div class="alert alert-success" role="alert">تم تحديث الاعدادات بنجاح</div>';
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
									$insert = mysqli_query($conn, "UPDATE `setting` SET 
																					`site_name` = '$_POST[site_name]',
																					`slide` = '$_POST[slide]',
																					`slide_value` = '$_POST[slide_num]',
																					`section_a` = '$_POST[section1]',
																					`section_a_value` = '$_POST[section_1_num]',
																					`section_b` = '$_POST[section2]',
																					`section_b_value` = '$_POST[section_2_num]',
																					`tab_a` = '$_POST[tab1]',
																					`tab_a_value` = '$_POST[tab_1_num]',
																					`tab_b` = '$_POST[tab2]',
																					`tab_b_value` = '$_POST[tab_2_num]',
																					`tab_c` = '$_POST[tab3]',
																					`tab_c_value` = '$_POST[tab_3_num]',
																					`facebook` = '$_POST[facebook]',
																					`twitter` = '$_POST[twitter]',
																					`google` = '$_POST[google]',
																					`instegram` = '$_POST[instegram]'
																");
									if(isset($insert)){
										$msg =  '<div class="alert alert-success" role="alert">تم تحديث الاعدادات بنجاح</div>';
									}
			}
		}
	}
	
	$select_setting = mysqli_query($conn , "SELECT * FROM `setting`");
	$setting = mysqli_fetch_assoc($select_setting);
	
	function category($x){
		global $conn;
		$category = mysqli_query($conn, "SELECT * FROM `category`");
		while($cate = mysqli_fetch_assoc($category)){
			echo '<option value="'.$cate['category'].'" '.($x == $cate['category'] ? 'selected' : '').'>'.$cate['category'].'</option>';
		}
	}
?>

	<article class="col-lg-9">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
	<?php echo $msg; ?>
		<div class="panel panel-info">
		  <div class="panel-heading"><b>إعدادات الموقع</b></div>
		  <div class="panel-body">
			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
			  <div class="form-group">
				<label for="site_name" class="col-sm-2 control-label">اسم الموقع : </label>
				<div class="col-sm-5">
				  <input type="text" class="form-control" name="site_name" value="<?php echo ($setting['site_name'] == '' ? '' : $setting['site_name']); ?>" id="site_name" placeholder="ادخل اسم الموقع هنا">
				</div>
			  </div>
			  <div class="form-group">
				<label for="image" class="col-sm-2 control-label">شعار الموقع : </label>
				<div class="col-sm-5">
				  <input type="file" class="form-control" name="image" id="image">
				</div>
			  </div>
			  <div class="form-group">
				<label for="slide" class="col-sm-2 control-label">السلايد شو : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="slide" id="slide">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['slide']); ?>
				  </select>
				</div>
				<label for="slide_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['slide_value'] == '' ? '3' : $setting['slide_value']); ?>" name="slide_num" id="slide_num" min="3" max="9">
				</div>
			  </div>
				<div class="form-group">
				<label for="section1" class="col-sm-2 control-label">القسم الأول : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="section1" id="section1">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['section_a']); ?>
				  </select>
				</div>
				<label for="section_1_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['section_a_value'] == '' ? '3' : $setting['section_a_value']); ?>" name="section_1_num" id="section_1_num" min="3" max="9">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="section2" class="col-sm-2 control-label">القسم الثاني : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="section2" id="section2">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['section_b']); ?>
				  </select>
				</div>
				<label for="section_2_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['section_b_value'] == '' ? '3' : $setting['section_b_value']); ?>" name="section_2_num" id="section_2_num" min="3" max="9">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="tab1" class="col-sm-2 control-label">التاب الأول : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="tab1" id="tab1">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['tab_a']); ?>
				  </select>
				</div>
				<label for="tab_1_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['tab_a_value'] == '' ? '3' : $setting['tab_a_value']); ?>" name="tab_1_num" id="tab_1_num" min="3" max="9">
				</div>
			  </div>
			  <div class="form-group">
				<label for="tab2" class="col-sm-2 control-label">التاب الثاني : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="tab2" id="tab2">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['tab_b']); ?>
				  </select>
				</div>
				<label for="tab_2_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['tab_b_value'] == '' ? '3' : $setting['tab_b_value']); ?>" name="tab_2_num" id="tab_2_num" min="3" max="9">
				</div>
			  </div>
			  <div class="form-group">
				<label for="tab3" class="col-sm-2 control-label">التاب الثالث : </label>
				<div class="col-sm-3">
				  <select class="form-control" name="tab3" id="tab3">
				  <option value="">اختر التصنيف</option>
					<?php category($setting['tab_c']); ?>
				  </select>
				</div>
				<label for="tab_3_num" class="col-sm-2 control-label">عدد المقالات : </label>
				<div class="col-sm-2">
				  <input type="number" class="form-control" value="<?php echo ($setting['tab_c_value'] == '' ? '3' : $setting['tab_c_value']); ?>" name="tab_3_num" id="tab_3_num" min="3" max="9">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="facebook" class="col-sm-2 control-label"> Facebook : </label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="facebook" value="<?php echo ($setting['facebook'] == '' ? '' : $setting['facebook']); ?>" id="facebook" placeholder="أدخل رابط الفيس بوك هنا">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="twitter" class="col-sm-2 control-label">Twitter : </label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="twitter" value="<?php echo ($setting['twitter'] == '' ? '' : $setting['twitter']); ?>" id="twitter" placeholder="ادخل رابط تويتر هنا">
				</div>
			  </div>
			  <div class="form-group">
				<label for="google" class="col-sm-2 control-label">Google+ : </label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="google" value="<?php echo ($setting['google'] == '' ? '' : $setting['google']); ?>" id="google" placeholder="ادخل رابط القوقل بلاس هنا">
				</div>
			  </div>
			  <div class="form-group">
				<label for="instegram" class="col-sm-2 control-label">Instegram : </label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="instegram" value="<?php echo ($setting['instegram'] == '' ? '' : $setting['instegram']); ?>" id="instegram" placeholder="ادخل رابط الانستقرام هنا">
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-6">
				  <button type="submit" name="submit" class="btn btn-danger">تحديث الإعدادات</button>
				</div>
			  </div>
			</form>
		  </div>
		</div>
	</div>
	</article>
<?php
	include_once("inc/footer.php");
?>