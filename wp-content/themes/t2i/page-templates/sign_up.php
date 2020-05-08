<?php
/*
 * Template Name: Sign Up
 */

get_header(); ?>

<!-- main-body div starts here -->
<script type='text/javascript'>
function refreshCaptcha(){
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<?php 
$lang= ICL_LANGUAGE_CODE;
if($lang == 'en')
{
    $user = 'Username:';
    $email = 'Email:';
    $pass = 'Password:';
    $con_pass = 'Confirm password:';
    $captha = 'Enter Captcha:';
    $privacy_pol = 'By signing up, you agree to our <a href="'. get_permalink(45) .'"> T&C </a> and<a href="'. get_permalink(43) .'">Privacy Policy</a>';
    $already_mem = 'Already a member? <a href="'. get_permalink(32) .'">Login Now!</a>';
    $signup ="Sign Up";
    $erro_validation ="This Field Is Required";
}
else
{
    $user = 'Nutzername:';
    $email = 'Email:';
    $pass = 'Passwort:';
    $con_pass = 'Bestätige das Passwort:';
    $captha = 'Captcha eingeben:';
    $privacy_pol = 'Mit Ihrer Anmeldung stimmen Sie unseren Bedingungen zu <a href="'. get_permalink(45) .'"> AGB </a> und<a href="'. get_permalink(43) .'"> Datenschutz-Bestimmungen</a>';
    $already_mem = 'Schon ein Mitglied? <a href="'. get_permalink(32) .'">Jetzt einloggen!</a>';
    $signup ="Anmelden";
    $erro_validation ="Dieses Feld wird benötigt";
}
?>
<div class="success-sec">
	<div class="container ">
		<div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
		<h1 class="text-center"><?php echo $signup; ?></h1>
        <div class="status"></div>
		<div>
			<form method="POST" id="rsUserRegistration">
				<div class="form_div">

					<div class="row">
						<div class="col-sm-12">
                            <div class="form-group group">
                            <input type="hidden" name="action" value="user_registration">
                             <input type="hidden" name="lang_code" value="<?php echo ICL_LANGUAGE_CODE; ?>">
                            <?php if (function_exists('wp_nonce_field')) {
                             wp_nonce_field('rs_user_registration_action', 'rs_user_registration_nonce');
                             } ?>

                                <input type="text" placeholder="" class="form-control" id="username" name="username" required>
                                <label class="label_for" ><?php echo $user; ?><span>*</span></label>
                                <span class="bar"></span>
                            </div>
							<div class="form-group group">

								<input type="email" placeholder="" class="form-control" id="email" name="email" required>
								<label class="label_for" ><?php echo $email;?><span>*</span></label>
								<span class="bar"></span>
							</div>
							
							<div class="form-group group">

								<input type="password" placeholder="" class="form-control" id="user_password" name="user_password" required>
								<label class="label_for" ><?php echo $pass; ?><span>*</span></label>
								<span class="bar"></span>
							</div>
							<div class="form-group group">

								<input type="password" placeholder="" class="form-control" id="user_confrm_password" name="user_confrm_password" required>
								<label class="label_for"><?php echo $con_pass; ?><span>*</span></label>
								<span class="bar"></span>
							</div>
							<span class="tag">Captcha:</span>
							<div class="form-group group captcha">
								<div class="dis_table">
									<div class="dis_cell">
										<input type="text" placeholder="" class="form-control" id="captcha_code" name="captcha_code" required>
										<label class="label_for" for="captcha_code"><?php echo $captha; ?></label>
										<span class="bar"></span>
									</div>
									<div class="dis_cell captcha_img"><img src="<?php echo get_template_directory_uri(); ?>/template-captcha.php?rand=<?php echo rand();?>" id='captchaimg'></div>
								</div>
							</div>
							<div class="form_group">
								<div class="checkbox">
									<div class=" pos-rel">
										<input type="checkbox" id="iagree" name="iagree" onclick="termchek();">
										<label class="label_for" for="iagree"><?php echo $privacy_pol; ?></label>
                                        <span id="erro_validation" style="color:red; display: none;"><?php echo $erro_validation; ?></span>
									</div>
								</div>
							</div>


						</div><!--col-sm-6-->
					</div><!--row-->
				</div>
				<div class=" slider_cont text-center ">
					<input type="submit" class="btn" id="signup" name="signup" value="<?php echo $signup; ?>" onclick="term();">
					<p><?php echo $already_mem; ?></p>
				</div>
			</form>

		</div>
	</div>	
</div>
<script type="text/javascript">
function term(){
    if(document.getElementById('iagree').checked==false){
     document.getElementById('erro_validation').style.display='block';
     return false
    }
}
function termchek(){
    document.getElementById('erro_validation').style.display='none';
}
</script>
<?php get_footer();
