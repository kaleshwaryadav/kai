<?php
/*
 * Template Name: Profile
 */

get_header(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } 
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$first_name =  get_user_meta($user_id,'first_name',true);
$gender =  get_user_meta($user_id,'gender',true);
$company =  get_user_meta($user_id,'company',true);
$dob = get_user_meta($user_id,'dob',true);
$mobilenum = get_user_meta($user_id,'mobilenum',true);
$address = get_user_meta($user_id,'address',true);
$alternateemail = get_user_meta($user_id,'alternateemail',true);
$user_type = get_user_meta($user_id,'user_type',true);
$comp_vat = get_user_meta($user_id,'comp_vat',true);
$location = get_user_meta($user_id,'location',true);
$lanCode = ICL_LANGUAGE_CODE;
if($lanCode=='en'){
     $logout = "Are you sure you want to Logout?";
     $yes = "Yes";
     $no ="No";
     $thanks="<strong>Thanks!</strong> Your profile has been successfully updated.";
     $myprofile ="My Profile";
     $changeProfile ="Change photo";
     $SaveChanges = "Save Changes";
     $UserType = "User Type";
     $CompanyvatNumber = "Company vat Number";
     $Gender ="Gender";
     $company = "Company";
     $mobile = "Mobile Number";
     $Address ="Address";
     $Location = "Location";
     $AlternateEmail ="Alternate Email";

}
else
{
    $logout = "Möchten Sie sich wirklich abmelden?";
    $yes = "Ja";
    $no ="Nein";
    $thanks="<strong>Vielen Dank!</strong> Dein Profil wurde erfolgreich aktualisiert.";
    $myprofile ="Mein Profil";
    $changeProfile ="Foto ändern";
    $SaveChanges = "Änderungen speichern";
    $UserType = "Benutzertyp";
    $CompanyvatNumber = "Firmensteuer-Nr";
    $Gender ="Geschlecht";
    $company = "Unternehmen";
    $mobile = "Handynummer";
    $Address ="Adresse";
    $Location = "Ort";
    $AlternateEmail ="Alternative E-mail";
}
?>
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
				<p><?php echo $logout; ?></p>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn" ><?php echo $yes; ?></button>
				<button type="button" class="btn btn_black" data-dismiss="modal"><?php echo $no; ?></button>
			</div>
		</div>

	</div>
</div>

<!-- logout popup -->
<!-- logout popup -->


<!-- main-body section starts here -->

<div class="template-wrapper extended">
	<section>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
                <div class="alert alert-success text-center" style="display:none;">
                  <?php echo $thanks; ?>
                </div>

                <div id="error" class="alert alert-danger text-center alert-dismissible" style="display:none;">
			    <!-- <a href="#" class="alert-error close" data-dismiss="alert" aria-label="close">&times;</a> -->
			    <strong>Error!</strong> Invalid email, please enter a valid email address.
			  </div>
			</div>
			<form id="myForm" method="POST">

			<div class="head_ttl">
              <input type="hidden" name="action" value="profile_save">
                <?php if (function_exists('wp_nonce_field')) {
                 wp_nonce_field('rs_user_profile_action', 'rs_user_profile_action_nonce');
                 } ?>
				<h2><?php echo $myprofile; ?></h2>
               
    			</div>

					<div class="progress" style="display: none;">
                        <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                    </div>
				<div class="profile_form">
					<div class="user_picture">
						<div class="rem_dp">
							<div class="profile_dp">
                            <?php  $ImageUrl = get_user_meta($user_id,'user_picImage',true); 
                             if(!empty($ImageUrl)){?>
                             <img src="<?php echo $ImageUrl; ?>" id="blah" alt="profilepic">
                             <?php } else { ?>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/profile-img.jpg" id="blah" alt="profilepic">
                            <?php } ?>
							
								<div class="upload_dp">
									<input type="file" name="profile_pic"  value="" class="form-control img" accept="image/-png,image/gif,image/jpeg" id="uplaod_dp">
									<label for="uplaod_dp"><i></i></label>
								</div>

							</div>
							<div class="blockdiv">
								<a href="#" class="removedp" data-id="8" ><?php echo $changeProfile; ?></a>
							</div>
							<input type="submit" name="profile" id="profile" id="edit_prof" class="btn edit_prof profile-update-button" value="<?php echo $SaveChanges; ?>" >
						</div>

					</div>
					<div class="user_detail">

						<ul>
							<!-- <li>
								<ul>
									<li><span><?php echo $UserType; ?> :</span><input type="text" name="user_type" id="user_type" value="<?php echo $user_type; ?>"></li>
									<li><span><?php echo $CompanyvatNumber; ?>:</span><input type="number" id="comp_vat" name="comp_vat" value="<?php echo $comp_vat; ?>"></li>
								</ul>
							</li> -->
							<li>
								<ul>
									<li><span>Name :</span><input type="text" name="first_name" id="first_name" value="<?php echo $current_user->user_login; ?>"></li>
									<li>
										<span><?php echo $Gender; ?> :</span>
										<!-- <input type="text" name="gender" id="gender" value="<?php echo $gender; ?>">  -->										
										<!-- <input type="radio" name="gender" value="male" <?php echo ( $gender == 'male' ) ? 'checked' : '' ?> style="display: block;"> Male 
										<input type="radio" name="gender" value="female" <?php echo ( $gender == 'female' ) ? 'checked' : '' ?> style="display: block;"> Female -->
										<label class="gender-lbl">Male
										  <input type="radio" name="gender" value="male" <?php echo ( $gender == 'male' ) ? 'checked' : '' ?> >
										  <span class="checkmark"></span>
										</label>
										<label class="gender-lbl">Female
										  <input type="radio" name="gender" value="female" <?php echo ( $gender == 'female' ) ? 'checked' : '' ?> >
										  <span class="checkmark"></span>
										</label>
									</li>
								</ul>
							</li>
							<li>
								<ul>
									<li><span>Email :</span><input type="email" id="email" name="email" value="<?php echo $current_user->user_email; ?>" required> </li>
									<li><span>DOB :</span><input type="date" id="dob" name="dob" value="<?php if(!empty($dob)){ echo $dob; } ?>"></li>
								</ul>
							</li>
							<li>
								<ul>
									<li><span><?php echo $company; ?> :</span><input type="text" name="company" id="company" value="<?php echo $company; ?>"></li>
									
								</ul>
							</li>
							<li>
								<ul>
									<li><span><?php echo $mobile; ?> :</span><input type="text" name="mobilenum" id="mobilenum" value="<?php echo $mobilenum; ?>"></li>									
								</ul>
							</li>
							<li>
								<ul>									
									<li><span><?php echo $Address; ?> :</span>
                                    <textarea name="address" id="address" style="width:222px;"><?php echo $address; ?></textarea>
                                 </li>           
								</ul>
							</li>
							<li>
								<ul>
                                    <li><span><?php echo $Location; ?> :</span><input type="text" name="location" id="location" value="<?php echo $location; ?>"></li>
								</ul>
							</li>
							<li>
								<ul>
									<li><span><?php echo $AlternateEmail; ?>:</span><input type="email" id="alternateemail" name="alternateemail" value="<?php echo $alternateemail; ?>"> </li>
								</ul>
							</li>
							
						</ul>
						<separator></separator>
						
					</div>
				</div>
			</form>
		</div>	
	</section>
</div>
<style type="text/css">
	
</style>
	<!-- template wrapper ends here -->
<script type="text/javascript">
	jQuery(function () {		
		jQuery('#datetimepicker1').datetimepicker();
        jQuery('.alert-success').hide();


	});


$('#myForm').submit(function() {
	$('.progress').show();
    var email = jQuery('#email').val();
    var alternateemail = jQuery('#alternateemail').val();
    if( email != '' ){
	    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(email);
	    if(!re) {
	        jQuery('#error').fadeIn();
	        setTimeout(function(){
	        	jQuery('#error').fadeOut();
	        },3000);
	        return false;
	    } else {
	        jQuery('#error').fadeOut();
	    }

	}

	if( alternateemail != '' ){
	    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(alternateemail);
	    if(!re) {
            $('.alert-danger').html('<strong>Error!</strong> Invalid email, please enter a valid email address.');
            $('.alert-danger').fadeIn("slow");
            $('html, body').animate({scrollTop: '0px'}, 800);
            setTimeout(function(){ $('.alert-danger').hide(); }, 4000);
	        return false;
	    } else {
	        jQuery('#error').fadeOut();
	    }

	}
    $('#profile').val('processing..');

     $.ajax({            
            type: "POST", 
            action : "profile_save",
            url: theme_ajax.url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false, 
	     // this part is progress bar
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);

                        $('.myprogress').text(percentComplete + '%');
                        $('.myprogress').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (response) {
            //console.log(response);	
            $('.progress').hide();
            // alert(response.data.status);
	            if(response.data.status == 'success' ){
		            $('#profile').val('Save profile');
		            $('.alert-success').html(response.data.message);
		            $('.alert-success').fadeIn("slow");
		            $('html, body').animate({scrollTop: '0px'}, 800);
		            setTimeout(function(){ $('.alert-success').hide(); }, 4000);
	            }else{
	            	$('#profile').val('Save profile');
		            $('.alert-danger').html(response.data.message);
		            $('.alert-danger').fadeIn("slow");
		            $('html, body').animate({scrollTop: '0px'}, 800);
		            setTimeout(function(){ $('.alert-danger').hide(); }, 4000);
	            }
            },
            error: function (responseData) {
                console.log('Ajax request not recieved!');
            }
        });
     return false;

});

 function readURL(input) {
     if(getLangCode=='en'){
      var msg ="Please select only images";
     }
     else{
     var msg ="Bitte wählen Sie nur Bilder aus";
     }
     var filename = $('input[type=file]').val();
     var extn = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") { 
        if (input.files && input.files[0]) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);
            oFReader.onload = function(oFREvent) {
                console.log(oFREvent.target.result);
                //$('#blah').html('<img src="'+oFREvent.target.result+'">');
                $('#blah').attr('src', oFREvent.target.result);
             };  
           }
        }
        else
       {
       alert(msg);
      }
    }
    
    $('input[type=file]').change(function(){
     readURL(this);
     var filename = $('input[type=file]').val();
     var extn = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") { 
     }
    });

</script>
<?php get_footer();
