<?php
/*
 * Template Name: Product Detail Extended
 */

get_header(); ?>

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
				<button type="button" class="btn btn_black" data-dismiss="modal">No</button>
			</div>
		</div>

	</div>
</div>

<!-- logout popup -->
<!-- logout popup -->


<!-- main-body div starts here -->

<div class="template-wrapper extended">
	<div>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>

			<div class="head_ttl">
				<h2>Headline Goes Here!</h2>
				<a href="#target" class="print"></a>
			</div>
			
			<div class="product_details ">
				<div class="row">
					<div class="col-sm-6">
						<div class="demo">
							<div class="item">            
								<div class="clearfix" >
									<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb1.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg" alt="slider_img" />
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb2.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg"  alt="slider_img"/>
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb3.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg" alt="slider_img" />
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb4.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg"  alt="slider_img"/>
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb1.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg" alt="slider_img" />
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb2.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg"  alt="slider_img"/>
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb3.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg" alt="slider_img" />
										</li>
										<li data-thumb="<?php bloginfo('template_url') ?>/assets/images/thumb4.jpg"> 
											<img src="<?php bloginfo('template_url') ?>/assets/images/slider1.jpg" alt="slider_img" />
										</li>
									</ul>
								</div>
							</div>
						</div>  
					</div>
					<div class="col-sm-6">
						<div class="product_dtl">
							<h4>The Bertschi Home In Washington</h4>
							<ul>
								<li>Neque porro quisquam</li>
								<li>Maecenas egestas eu justo ut dignissim. </li>
								<li>Donec congue hendrerit est </li>
							</ul>
							<p>Maecenas egestas eu justo ut dignissim. In id nunc lacus. Aliquam erat volutpat. Integer cursus molestie eros, eu pellentesque eros ulla corper quis. Etiam vel nibh tellus. Ut convallis dolor porta pharetra semper. Fusce vel ex ut velit sodales viverra id non nulla. Fusce eleif end tortor quis nibh mattis.</p>
							<div class="features">
								<span><a href="#">www.apaxbuilding project.com</a></span>
								<span class="aset_price">Asset Price : <span class="">$23</span></span>
								<a href="#" class="btn  ">download pdf</a>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="row no-margin">
				<h3>Detail</h3>
				<div class="col-md-5 col-sm-5 col-xs-12 no-padding">
					<div class="uploader-user">
						<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/user-icon.png" alt="">
						<div class="details_owner ">
							<div class="media-body">
								<ul class="first_not">
									<li>
										<ul>
											<li>Contact Name :</li>
											<li>Sunny Mann</li>
										</ul>
									</li>
									<li>
										<ul>
											<li>Location :</li>
											<li>New Delhi</li>
										</ul>
									</li>
								</ul>
								<a href="#" class="btn" data-toggle="modal" data-target="#moredetail"  >more detail</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12 no-padding">
					<div class="contact-form">
						<form method="post">
							<ul class="list-unstyled">
								<li>
									<input type="text" class="form-control" placeholder="Name">
									<input class="form-control ml" type="number" placeholder="Mobile Number">
								</li>
								<li>
									<input class="form-control w-100" type="text" placeholder="Address">
								</li>
								<li>
									<input class="form-control w-75" type="text" placeholder="Message">
									<button class="btn">SEND</button>
								</li>
							</ul>
						</form>
					</div>
				</div>		
			</div>
		</div>	
	</div>

	<div class="partner-list">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_1.png" alt=""></a></div>
				<div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_2.png" alt=""></a></div>
				<div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_3.png" alt=""></a></div>
				<div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_4.png" alt=""></a></div>
			</div>
		</div>	
	</div>

	<div>
		<div class="container">
			<div class="activity-list" id="target">
				<ul class="list-unstyled list-inline text-center">
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_1.png" alt="activity">
							<p>Report</p>
						</a>
					</li>
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_2.png" alt="activity">
							<p>Report</p>
						</a>
					</li>
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_3.png" alt="activity">
							<p>Report</p>
						</a>
					</li>
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="activity">
							<p>Report</p>
						</a>
					</li>
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_5.png" alt="activity">
							<p>Report</p>
						</a>
					</li>
					<li>
						<a href="">
							<img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_6.png" alt="activity">
							<p>Message</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>	<!-- template wrapper ends here -->

<!-- share product popup -->
<!-- share product popup -->
<div id="share_product" class="modal fade reminder_popup" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Share this assest via</h4>
			</div>
			<div class="modal-body">
				<div class="form_div feedback">
					<div class="row">
						<div class="col-sm-12">
							<form method="post" >
								<div class="form-group group">
									<input type="email" name="email_product" class="form-control">
									<label >Email Address</label>
									<span class="bar"></span>
								</div>
								<div class="form-group group">
									<textarea class="form-control" ></textarea>
									<label >Message</label>
									<span class="bar"></span>
								</div>
								<div class="form-group">
									<ul class="social_list">
										<li class="fb"><a href="#"><span><i class="fa fa-facebook" aria-hidden="true"></i></span>Facebook</a></li>
										<li class="twt"><a href="#"><span><i class="fa fa-twitter" aria-hidden="true"></i></span>twitter</a></li>
										<li class="gp"><a href="#"><span><i class="fa fa-google-plus" aria-hidden="true"></i></span>google +</a></li>
									</ul>
								</div>

								<div class=" slider_cont text-center">
									<button type="submit" class="btn">submit
									</button>

								</div>
							</form>
						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
			</div>

		</div>

	</div>
</div>

<!-- share product popup -->
<!-- share product popup -->


<!-- reminder popup -->
<!-- reminder popup -->
<div id="reminder_popup" class="modal fade reminder_popup" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Set Reminder</h4>
			</div>
			<div class="modal-body">
				<div class="form_div feedback">
					<div class="row">
						<div class="col-sm-12">
							<form method="post">
								<div class="form-group group">
									<textarea class="form-control"  ></textarea>
									<label >Message</label>
									<span class="bar"></span>
								</div>
								<span class="tag">Select Date & Time:</span>         
								<div class="row form-group">
									<div class='col-xs-6'>
										<div class="form-group ">
											<div class='input-group date' id='datetimepicker1'>
												<input type='text' class="form-control" placeholder="Date & Time" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
												<span class="bar"></span>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<select>
												<option>daily</option>
												<option selected="selected">weekly</option>
												<option>monthly</option>
												<option>quarterly</option>
												<option>yearly</option>

											</select>
											<i class="fa fa-sort-desc" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class=" slider_cont text-center">
									<button type="submit" class="btn">save
									</button>
									<button type="submit" class="btn btn_black" data-dismiss="modal">cancel</button>
								</div>
							</form>
						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
			</div>

		</div>

	</div>
</div>

<!-- reminder popup -->
<!-- reminder popup -->

<!-- more detail popup -->
<div id="moredetail" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>
			<div class="modal-body">
				<div class="form_div feedback">
					<div class="row">
						<div class="col-sm-12">
							<form method="post">
								<div class="form-group group">
									<input type="text" placeholder="" class="form-control" id="user_priv" name="user_priv">
									<label >User Private</label>
									<span class="bar"></span>
								</div>

								<div class="form-group group">
									<input type="text" placeholder="" class="form-control" id="user_owner" name="user_owner">
									<label >User to Owner</label>
									<span class="bar"></span>
								</div>
								<div class="form-group group">
									<input type="text" placeholder="" class="form-control" id="owner_priv" name="owner_priv">
									<label >Owner Private</label>
									<span class="bar"></span>
								</div>
								<div class=" slider_cont text-center">
									<button type="submit" class="btn" name="contact_query">send<span></span>
									</button>
								</div>
							</form>
						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
			</div>

		</div>

	</div>
</div>

<!-- more detail popup end -->



<!-- more detail popup end -->
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/lightslider.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#image-gallery').lightSlider({
			gallery:true,
			item:1,
			thumbItem:4,
			slideMargin: 0,
			speed:500,
			auto:false,
			loop:true,
			onSliderLoad: function() {
				$('#image-gallery').removeClass('cS-hidden');
			}  
		});
	});
</script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
         var url = "<?php echo get_template_directory_uri(); ?>";
		new nicEditor({iconsPath : +url'/nicEditorIcons.gif'}).panelInstance('area3');
	});
</script>
<script type="text/javascript">
	jQuery(function () {
		jQuery('#datetimepicker1').datetimepicker();

	});
</script>
<script type="text/javascript">

	$('.head_ttl .print').on('click', function(e) {
		e.preventDefault();
		$link = $(this).attr('href');

		$('html, body').animate({
			scrollTop: $($link).offset().top - 10
		}, 800 );
	});

</script>
<?php get_footer();
