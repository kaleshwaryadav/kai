<?php
/*
 * Template Name: Dashboard
 */

get_header(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } 
    $lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $dashboard = "Dashboard";
      $Myprofile = "My profile";
      $Success ="Success Stories";
      $Reminder ="Reminder";
      $Message = "Message";
      $MyAsset = "My Asset";
      $Favorites = "Favorites";
      $Createasset = "Create asset";
      $Reports ="Reports";
      $SubmitFeedback ="Submit Feedback";
      $LogOut = "Log Out";

    }
    else
    {
       $dashboard = "Instrumententafel";
       $Myprofile = "Mein Profil";
       $Success ="Erfolgsgeschichten";
       $Reminder ="Erinnerung";
       $Message = "Botschaft";
       $MyAsset = "Mein Guthaben";
       $Favorites = "Favoriten";
       $Createasset = "Asset erstellen";
       $Reports ="Berichte";
       $SubmitFeedback ="Feedback einreichen";
       $LogOut = "Ausloggen";
    }
    ?>
<!-- main-body section starts here -->
<div class="template-wrapper">
	<section>
		<div class="container">
			<div class="breadcrumb">
			<?php if(function_exists('bcn_display')) {  bcn_display(); }?>
			</div>
			<div class="dashboard">
				<h3><?php echo $dashboard; ?></h3>
				<div class="dashboard_list">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(106);?>" class="profile">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img1.jpg" alt="img">
								<h4><?php echo $Myprofile; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(339); ?>" class="stories">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img2.jpg" alt="img">
								<h4><?php echo $Success; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(108); ?>" class="reminder">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img3.jpg" alt="img">
								<h4><?php echo $Reminder; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo site_url('private-message'); ?>" class="msg">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img4.jpg" alt="img">
								<h4><?php echo $Message; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(41); ?>" class="asset">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img9.jpg" alt="img">
								<h4><?php echo $MyAsset; ?></h4>
							</a>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(81); ?>" class="fav">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img6.jpg" alt="img">
								<h4><?php echo $Favorites; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(77); ?>" class="cre_assets">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img7.jpg" alt="img">
								<h4><?php echo $Createasset; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(544); ?>" class="reports">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img8.jpg" alt="img">
								<h4><?php echo $Reports; ?></h4>
							</a>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo get_permalink(83); ?>" class="feedback">
								<img src="<?php bloginfo('template_url') ?>/assets/images/img5.jpg" alt="img">
								<h4><?php echo $SubmitFeedback; ?></h4>
							</a>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="<?php echo wp_logout_url(home_url()); ?>" class="logout" >
								<img src="<?php bloginfo('template_url') ?>/assets/images/img10.jpg" alt="img">
								<h4><?php echo $LogOut; ?></h4>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>
</div>	<!-- template wrapper ends here -->

<!-- logout popup -->
<!-- logout popup -->

<div id="logout_pop" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<!--  <h4 class="modal-title">Modal Header</h4> -->
			</div>
			<div class="modal-body text-center">
				<p>Are you sure you want to Logout?</p>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn" >Yes</button>
				<button type="button" class="btn btn_black">No</button>
			</div>
		</div>

	</div>
</div>

<!-- logout popup -->
<!-- logout popup -->


</div>	<!-- template wrapper ends here -->





<?php get_footer();
