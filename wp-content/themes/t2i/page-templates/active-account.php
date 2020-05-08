<?php
/*
 * Template Name: active account
 */

get_header(); ?>

<section class="success-sec">
	<div class="container ">
		<div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}
            if(!empty($_REQUEST['userid'])){
            $user_id = $_REQUEST['userid'];
            $meta_value = "yes";
            update_user_meta( $user_id, 'is_activated', $meta_value);
            }
           
            ?>
		</div>
	
		<div class="text-center">
        <div class="alert alert-success">
          <strong>Successfully! </strong> Your account has been activated successfully.
        </div>
		</div>
		
	</div>	
</section>

<?php get_footer();
