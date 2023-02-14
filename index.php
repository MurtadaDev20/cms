<?php
	include_once("include/header.php");
	include_once("include/sidebar.php");
	
?>
		<article class="col-md-9 col-lg-9 art_bg">
		<!-- start carousel -->
		
		<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 20px; margin-bottom: 30px;">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      <?php
		$sel_slide = mysqli_query($conn , "SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[slide]' ORDER BY `post_id` DESC LIMIT $setting[slide_value]");
		$count_slide = mysqli_num_rows($sel_slide);
		
		$x = 0;
			
		while($slide = mysqli_fetch_assoc($sel_slide)){
		?>
		<div class="item <?php echo ($x == 0 ? 'active' : ''); ?>">
          <img src="<?php echo ($slide['image'] == '' ? 'images/no-img.png' : $slide['image']); ?>" width="100%" style="height: 350px;">
		  <h3 class="carousel_h3"><a href="post.php?id=<?php echo $slide['post_id']; ?>"><?php echo $slide['title']; ?></a></h3>
           <div class="carousel-caption">
            
            <p><?php echo strip_tags(substr($slide['post'],0,350)); ?> ... </p>
          </div>
        </div><!-- End Item -->
		
		<?php
		$x++;
		}
	  ?>
        

                
      </div><!-- End Carousel Inner -->


    	<ul class="nav nav-pills nav-justified sliddd">
		<?php
			for($i=0;$i<$count_slide;$i++){
				echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.($i == 0 ? 'class="active"' : '').'><a href="#"><i class="fa fa-star fa-2x"></i></a></li>';
			}
         ?>
        </ul>


    </div>
	<!-- End Carousel -->
	
	<hr />
	
	<!-- category A -->
	<div class="row">
	<h2 class="tit_cat1"><?php echo $setting['section_a'];?></h2>
	<?php 
	$section_a = mysqli_query($conn , "SELECT * FROM `posts` p INNER JOIN `users` u ON p.author = u.user_id WHERE `status` = 'published' AND `category` = '$setting[section_a]' ORDER BY `post_id` DESC LIMIT $setting[section_a_value]");
	
	while($sec = mysqli_fetch_assoc($section_a)){
	?>
	
	
        <div class="col-sm-4 col-md-4" style="margin-bottom: 20px">
            <div class="post">
                <div class="post-img-content">
                    <img src="<?php echo ($sec['image'] == '' ? 'images/no-img.png' : $sec['image']);?>" class="img-responsive" style="width: 100%;height: 200px;"/>
                    <span class="post-title"><b><?php echo $sec['title'];?></b>
                </div>
                <div class="content">
                    <div class="author">
                        بواسطة <a href="profile.php?user=<?php echo $sec['user_id'];?>"><b><?php echo $sec['username'];?></b></a> |
                        بتاريخ <time datetime="2014-01-20"><?php echo $sec['post_date'];?></time>
                    </div>
                    <div class="text-justify">
						<?php echo strip_tags(substr($sec['post'],0,355));?>
                    </div>
					<hr />
                    <div class="text-left">
                        <a href="post.php?id=<?php echo $sec['post_id'];?>" class="btn btn-warning btn-sm">اقرأ المزيد &larr;</a>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}
	?>
	</div> 
<hr />
	<!-- end category A -->
		<!-- tab -->
			<div class="col-md-12">
			<div class="row">
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#tab_default_1" data-toggle="tab">
								<?php echo $setting['tab_a'];?> </a>
							</li>
							<li>
								<a href="#tab_default_2" data-toggle="tab">
								<?php echo $setting['tab_b'];?> </a>
							</li>
							<li>
								<a href="#tab_default_3" data-toggle="tab">
								<?php echo $setting['tab_c'];?> </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_default_1">
							<?php
						$tab_1 = mysqli_query($conn , "SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_a]' ORDER BY `post_id` DESC LIMIT $setting[tab_a_value]");
							while($tab_a = mysqli_fetch_assoc($tab_1)){
							?>
								<div class="bg_tab_topic">
									<div class="col-md-3">
											<img src="<?php echo ($tab_a['image'] == '' ? 'images/no-img.png' : $tab_a['image']);?>" width="100%" class="img-thumbnail" />
										</div>
										<div class="col-md-9">
										<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
											<a href="post.php?id=<?php echo $tab_a['post_id'];?>" class="a_1"> <?php echo $tab_a['title'];?> </a>
										</h3>
										<p class="col-md-12 text-justify">
											<?php echo strip_tags(substr($tab_a['post'],0,400));?> ...
										</p>
										</div>
									<div class="clearfix"></div>
								</div>
						<?php
							}
						?>
							</div>
							<div class="tab-pane" id="tab_default_2">
								<?php
								$tab_1 = mysqli_query($conn , "SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_b]' ORDER BY `post_id` DESC LIMIT $setting[tab_b_value]");
									while($tab_a = mysqli_fetch_assoc($tab_1)){
									?>
										<div class="bg_tab_topic">
											<div class="col-md-3">
													<img src="<?php echo ($tab_a['image'] == '' ? 'images/no-img.png' : $tab_a['image']);?>" width="100%" class="img-thumbnail" />
												</div>
												<div class="col-md-9">
												<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
													<a href="post.php?id=<?php echo $tab_a['post_id'];?>" class="a_1"> <?php echo $tab_a['title'];?> </a>
												</h3>
												<p class="col-md-12 text-justify">
													<?php echo strip_tags(substr($tab_a['post'],0,400));?> ...
												</p>
												</div>
											<div class="clearfix"></div>
										</div>
								<?php
									}
								?>
							</div>
							<div class="tab-pane" id="tab_default_3">
								<?php
								$tab_1 = mysqli_query($conn , "SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_c]' ORDER BY `post_id` DESC LIMIT $setting[tab_c_value]");
									while($tab_a = mysqli_fetch_assoc($tab_1)){
									?>
										<div class="bg_tab_topic">
											<div class="col-md-3">
													<img src="<?php echo ($tab_a['image'] == '' ? 'images/no-img.png' : $tab_a['image']);?>" width="100%" class="img-thumbnail" />
												</div>
												<div class="col-md-9">
												<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
													<a href="post.php?id=<?php echo $tab_a['post_id'];?>" class="a_1"> <?php echo $tab_a['title'];?> </a>
												</h3>
												<p class="col-md-12 text-justify">
													<?php echo strip_tags(substr($tab_a['post'],0,400));?> ...
												</p>
												</div>
											<div class="clearfix"></div>
										</div>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<!-- end Tabs -->

			<!-- start category B -->
			<div class="col-lg-12">
			<h2 class="tit_cat2"><?php echo $setting['section_b']; ?></h2>
			<div class="row  bg_cat2">
			
			<?php
			$section_b = mysqli_query($conn , "SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[section_b]' ORDER BY `post_id` DESC LIMIT $setting[section_b_value]");
			while($sec2 = mysqli_fetch_assoc($section_b)){
			?>
			
				<div class="bg_tab_topic col-md-6">
					<div class="col-md-4">
						<img src="<?php echo ($sec2['image'] == '' ? 'images/no-img.png' : $sec2['image']);?>" width="100%" class="circle" />
					</div>
					<div class="col-md-8">
						<h3 class="col-md-12 text-justify" style="margin-right: -30px;margin-top: 8px;">
							<a href="post.php?id=<?php echo $sec2['post_id'];?>"> <?php echo $sec2['title'];?> </a>
						</h3>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php
			}
			?>
				
				<div class="clearfix"></div>
			</div>
			</div>
			<!-- end category B -->
		</article>
<?php
	include_once("include/footer.php");
?>