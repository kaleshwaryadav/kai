<?php
ob_start();
session_start();
/*
 * Template Name: Login
 */
get_header(); 
if(is_user_logged_in()) {
$url = get_permalink(79);?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } ?>

<script type='text/javascript'>
function refreshCaptcha(){
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<?php $lang= ICL_LANGUAGE_CODE;
if($lang == 'en')
{
    $username ='Username or Email :';
    $password = 'Password :';
    $Captcha = 'Enter Captcha :';
    $remember = 'Remember Me';
    $forgot_pass= 'Forgot Password';
    $signup = "Sign Up Now";
}
else
{
    $username = 'Benutzername oder E-Mail-Adresse :';
    $password = 'Passwort :';
    $Captcha = 'Captcha eingeben :';
    $remember = 'Erinnere dich an mich';
    $forgot_pass= 'Passwort vergessen';
    $signup = "Jetzt registrieren";
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
		<h1 class="text-center">Log In</h1>
		<div>
		<form method="POST" id="rsUserLoginform">
				<div class="form_div">
                 <div class="alert fade in status" style="text-align:center;"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group group">
								<input type="text" placeholder="" class="form-control" id="username" name="username" required>
                                <label class="label_for" for="Username"><?php echo $username;?><span>*</span></label>
								<span class="bar"></span> 
							</div>
							
							<div class="form-group group">
								
								<input type="password" placeholder="" class="form-control" id="password" name="password" required>
								<label class="label_for" for="password"><?php echo $password;?><span>*</span></label>
								<span class="bar"></span>
							</div>
							<span class="tag">Captcha:</span>
							<div class="form-group group captcha">
								<div class="dis_table">
									<div class="dis_cell">
										<input type="text" placeholder="" class="form-control" id="captcha_code" name="captcha_code" value=""  required="" >
										<label class="label_for"  for="captcha_val"><?php echo $Captcha;?></label>
										<span class="bar"></span>
									</div>
									<div class="dis_cell captcha_img"><img src="<?php echo get_template_directory_uri(); ?>/template-captcha.php?rand=<?php echo rand();?>" id='captchaimg'></div>
								</div>
							</div>
							<div class="checkbox ">
								<div class=" pos-rel">
                                  <input type="hidden" id="redirect_page_url" name="redirect_page_url" value="<?php echo get_permalink(79); ?>">   
									<input type="checkbox" id="iagree" required>
									<label for="iagree"><?php echo $remember; ?></label>
									<span class="signup_user"><a href="<?php echo site_url()."/sign-up"; ?>" title="Register"><?php echo $signup; ?></a></span>
									<span class="fgt_pwd"><a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password""><?php echo $forgot_pass;?></a></span>
								</div>
							</div>
						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
				<div class=" slider_cont text-center">
					<input type="submit" class="btn" name="submit" id="submit" value="Log In">
				</div>
			</form>

		</div>
		
	</div>	
</section>
<?php get_footer();
