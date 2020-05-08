<?php
/*
 * Template Name: Feedback
 */

get_header(); ?>
<?php  
    $lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
    $submitFeedback ="Submit Feedback to the T2i Team";
    $yourEmail = "your Email";
    $Subject="Subject";
    $Message ="Message";
    $send="send";
    }
    else
    {
    $submitFeedback ="Senden Sie Feedback an das T2i-Team";
    $yourEmail = "deine E-Mail";
    $Subject="Gegenstand";
    $Message ="Botschaft";
    $send="senden";
    }
    ?>
<section class="success-sec">
	<div class="container ">
		<div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
		<h2 class="text-center"><?php echo $submitFeedback; ?></h2>
		<div>
           <div class="msg_status"></div>
			<form method="POST" id="admin_msg">
				<input type="hidden" name="email_tpl_id" value="<?php echo $feedback_email_templ = icl_object_id(2547,'page',false,ICL_LANGUAGE_CODE); ?>">
				<div class="form_div feedback">

					<div class="row">

						<div class="col-sm-12">
							<div class="form-group group">
                                <input type="hidden" name="action" value="send_msg">
								<input type="email" placeholder="" class="form-control" id="email" name="email" >
								<label  class="label_for" ><?php echo $yourEmail; ?></label>
								<span class="bar"></span>
							</div>

							<div class="form-group group">
								<input type="text" placeholder="" class="form-control" id="subject" name="subject"  >
								<label class="label_for" ><?php echo $Subject; ?></label>
								<span class="bar"></span>
							</div>

							<div class="form-group group">
								<textarea name="message" id="message" class="form-control" ></textarea>
								<label class="label_for" <?php echo $Message; ?></label>
								<span class="bar"></span>
							</div>
							<div class=" slider_cont text-center">
								<button type="submit" class="btn contact_query" name="contact_query"><?php echo $send; ?><span></span>
								</button>
							</div>
						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
			</form>
		</div>
		
	</div>	
</section>
<?php get_footer(); ?>
