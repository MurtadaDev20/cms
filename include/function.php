<?php
	
	function register(){
		if(isset($_SESSION['id'])){
			echo '<div class="alert alert-danger" role="alert">عذراً يا '.$_SESSION['user'].' ولكنك مسجل لدينا بالفعل</div>';
		}else{
			echo '
		<form action="include/registor.php" method="post" class="form-horizontal" id="registor" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="username" class="col-sm-2 control-label"><span style="color: red;">*</span> اسم المستخدم : </label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="username" id="username" placeholder="ادخل اسم المستخدم">
			</div>
		  </div>
		  <div class="form-group">
			<label for="email" class="col-sm-2 control-label"><span style="color: red;">*</span> البريد الالكتروني : </label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="email" id="email" placeholder="ادخل البريد الالكتروني">
			</div>
		  </div>
		  <div class="form-group">
			<label for="password" class="col-sm-2 control-label"><span style="color: red;">*</span> كلمة المرور : </label>
			<div class="col-sm-5">
			  <input type="password" class="form-control" name="password" id="password" placeholder="ادخل كلمة المرور">
			</div>
		  </div>
		  <div class="form-group">
			<label for="con-password" class="col-sm-2 control-label"><span style="color: red;">*</span> تأكيد كلمة المرور :</label>
			<div class="col-sm-5">
			  <input type="password" class="form-control" name="con_password" id="con-password" placeholder="إعاداة كتابة كلمة المرور">
			</div>
		  </div>
		  <div class="form-group">
			<label for="gender" class="col-sm-2 control-label">الجنس : </label>
			<div class="col-sm-3">
			  <select name="gender" class="form-control" id="gender">
				<option value="">اختر الجنس</option>
				<option value="male">ذكر</option>
				<option value="female">انثى</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="avatar" class="col-sm-2 control-label">الصورة الرمزية : </label>
			<div class="col-sm-5">
			  <input type="file" name="image" class="form-control" id="avatar">
			</div>
		  </div>
		  <div class="form-group">
			<label for="about-you" class="col-sm-2 control-label">وصف مختصر عنك : </label>
			<div class="col-sm-6">
			  <textarea class="form-control" name="about" id="about-you" rows="4"></textarea>
			</div>
		  </div>
		<div class="form-group">
			<label for="facebook" class="col-sm-2 control-label"><i class="fa fa-facebook-square"></i> </label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" name="facebook" id="facebook" placeholder="ادخل رابط صفحتك على الفيس بوك">
			</div>
		  </div>
		  <div class="form-group">
			<label for="twitter" class="col-sm-2 control-label"><i class="fa fa-twitter-square"></i></label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" name="twitter" id="twitter" placeholder="ادخل رابط صفحتك على تويتر">
			</div>
		  </div>
		  <div class="form-group">
			<label for="youtube" class="col-sm-2 control-label"><i class="fa fa-youtube-square"></i> </label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" name="youtube" id="youtube" placeholder="ادخل رابط قناتك على اليوتيوب">
			</div>
		  </div>
		  <div class="col-md-1"></div>
		  <div class="col-md-7 text-center">
			<div id="result"></div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-5">
			  <button type="submit" name="submit" class="btn btn-danger btn-block"><i class="fa fa-pencil"></i>  تسجيل</button>
			</div>
		  </div>
		</form>
			';
		}
	}

	
	
	function login_area(){
		if(isset($_SESSION['id'])){
			echo '
					<div class="panel panel-default">
					  <div class="panel-heading text-center"><b>أهلا وسهلاً بك يا  '.ucwords($_SESSION['user']).'</b></div>
					  <div class="panel-body">
					  <div class="text-center" style="margin-bottom: 20px;">
					  
						<img src="'.$_SESSION['avatar'].'" width="85px" />
					  </div>
					  <hr />
						<div class="col-md-12">
							<div class="row">
								<p><b>البريد الالكتروني : </b> '.$_SESSION['email'].'</p>
								<p><b>روابط التواصل لديك : </b>
									<a href="'.$_SESSION['facebook'].'" target="_blank" class="lo_face"><i class="fa fa-facebook-square  fa-lg"></i></a>
									<a href="'.$_SESSION['twitter'].'" target="_blank" class="lo_twt"><i class="fa fa-twitter-square  fa-lg"></i></a>
									<a href="'.$_SESSION['youtube'].'" target="_blank" class="lo_tube"><i class="fa fa-youtube-square  fa-lg"></i></a>
								</p>
							</div>
						</div>
					  </div>
					  <div class="panel-footer">
						<div class="col-md-12">
							<div class="row">
							<div class="col-md-6">
							';
							if($_SESSION['role'] == 'admin' OR $_SESSION['role'] == 'writer'){
								echo '<a href="admin-cp/index.php" class="btn btn-danger btn-sm pull-left">لوحة التحكم</a>';
							}
							echo '
							</div>
							<div class="col-md-6">
							<a href="profile.php?user='.$_SESSION['id'].'" class="btn btn-info btn-sm pull-right">الصفحة الشخصية</a>
							</div>
								
							</div>
						</div>
						<div class="clearfix"></div>
					  </div>
					</div>
			';
		}else{
			echo '
			<div class="panel panel-default">
					<div class="panel-heading text-center"><b>تسجيل الدخول</b></div>
					<div class="panel-body">
					<div class="text-center" style="margin-bottom: 20px;">
					
					<img src="images/non-avatar.png" width="85px" />
					</div>
					<hr />
					<form action="include/login.php" method="post" class="form-horizontal" id="login">
						<div class="form-group">
						<label for="username" class="col-sm-2 control-label text-center"><i class="fa fa-user fa-2x"></i></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="username" name="user" placeholder="ادخل اسم المستخدم او البريد الالكتروني">
						</div>
						</div>
						<div class="form-group">
						<label for="Password" class="col-sm-2 control-label text-center"><i class="fa fa-lock fa-2x"></i></label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="Password" placeholder="ادخل كلمة المرور">
						</div>
						</div>
						<div id="log_result" style="text-align: center;"></div>
						<div class="form-group">
						<div class="col-sm-10 pull-left">
							<button type="submit" name="login" class="btn btn-info">تسجيل الدخول</button>
						</div>
						</div>
					</form>
					</div>
					<div class="panel-footer"><i class="fa fa-exclamation-triangle" style="color: red;"></i> اذا لم تكن مسجل لدينا <a href="registor.php">اضغط هنا</a></div>
					</div>
			';
		}
	}
	
	function comment_area(){
		global $_SESSION;
		global $id;
		if(!isset($_SESSION['id'])){
			echo '<center><h4>لإضافة التعليقات يرجى تسجيل الدخول في البداية <small>اذا لم تكن تملك حساب ، <a href="registor.php">اضغط هنا</a></small></h4></center>';
		}else{
			echo '
			<form action="include/comment.php" method="post" class="form-horizontal" id="comments">
			  <div class="form-group">
			  <div class="col-md-2"></div>
				<label for="inputEmail3" class="col-sm-2 control-label">عنوان التعليق : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="title" id="inputEmail3" placeholder="ادخل عنوان للتعليق">
				</div>
			  </div>
			  
			  <div class="form-group">
			  <div class="col-md-2"></div>
				<label for="inputEmail3" class="col-sm-2 control-label">التعليق : </label>
				<div class="col-sm-6">
				  <textarea type="text" class="form-control" name="comment" id="inputEmail3" rows="4"></textarea>
				</div>
			  </div>
			  <input type="hidden" value="'.$id.'" name="id" />
			  <div class="form-group">
			  <div class="col-md-4"></div>
				<div class="col-sm-6">
				<div id="com_result"></div>
				  <button type="submit" name="submit" class="btn btn-danger">اضافة التعليق</button>
				</div>
			  </div>
			</form>
			';
		}
	}
?>