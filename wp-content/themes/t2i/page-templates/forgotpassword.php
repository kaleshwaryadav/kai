<?php
/*
 * Template Name: Forgot Password
 */

get_header(); ?>

<!-- main-body section starts here -->

<section class="success-sec">
	<div class="container ">
		<div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
		<h1 class="text-center">Forgot Password</h1>

		<div>
			<form method="POST"  novalidate="">
				<div class="form_div">
					<div class="img_bx text-center">
						<img src="<?php bloginfo('template_url') ?>/assets/images/fgt_pwd.jpg" alt="" >
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group group">
								<input type="email" placeholder="" class="form-control" id="email" name="email" required="" >
								<label for="email">Email:<span>*</span></label>
								<span class="bar"></span>
							</div>                                           
						</div><!--col-sm-6-->
					</div><!--row-->
					<p class="note"><label><span>*</span>Please enter your mail id to receive your credentials</label></p>
				</div>
				<div class=" slider_cont text-center">
					<button type="submit" class="btn" name="contact_query">Log In<span></span></button>
					<button type="submit" class="btn btn_black" name="contact_query">cancel<span></span>
					</button>
				</div>
			</form>

		</div>
		
	</div>	
</section>
<?php get_footer();
